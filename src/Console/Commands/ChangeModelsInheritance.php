<?php

namespace DominikStyp\LaravelModelAbstractor\Console\Commands;

use DominikStyp\LaravelModelAbstractor\DirectoryRecursiveIteratorCallback;
use DominikStyp\LaravelModelAbstractor\ReflectionHelper;
use Illuminate\Console\Command;
use SplFileInfo;
use function app_path;

class ChangeModelsInheritance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-model-abstractor:change-models-inheritance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all your models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dir = app_path();
        $this->createModelsDirectoryIfNotExists();
        DirectoryRecursiveIteratorCallback::iterateOverFilesInDir($dir, 
                function(SplFileInfo $info){
                    $path = $info->getPathname();
                    if(preg_match("#\.php#",$path)){
                        $this->processOneFile($info);
                    }
                }
         );
    }
    
    protected function processOneFile(SplFileInfo $info){
        $reflectionHelper = new ReflectionHelper($info);
        if($reflectionHelper->isOriginalLaravelModel()){
            $classFullName = $reflectionHelper->getClassFullName();
            if($reflectionHelper->isChildOfEloquentModel()){
                $this->changeInheritanceAndNamespace($info);
                $this->moveModelToModelsDirectory($info);
                echo "\nModel {$classFullName} has been changed";
            }
        }
    }
    
    protected function createModelsDirectoryIfNotExists() {
        $modelsDir = app_path().DIRECTORY_SEPARATOR.'Models';
        if(!is_dir($modelsDir)){
            if(!mkdir($modelsDir, 0777, true)){
                throw new \Exception("Directory $modelsDir can't be created!");
            }   
        }
    }
    
    
    protected function moveModelToModelsDirectory(SplFileInfo $info) {
        $source = $info->getPathname();
        $ds = DIRECTORY_SEPARATOR;
        $destination = str_replace("app{$ds}","app{$ds}Models{$ds}",$source);
        echo "\nMoving file: $source to $destination";
        if(!rename($source, $destination)){
            throw new \Exception("$source file can't be moved to: $destination");
        }
        
    }
    
    protected function changeInheritanceAndNamespace(SplFileInfo $info){
        $filename = $info->getPathname();
        $fileContents = file_get_contents($filename);
        // change namespace
        $fileContents = str_replace("namespace App;",'namespace App\Models;',$fileContents);
        // change inheritance
        $fileContents = str_replace('extends Model','extends AbstractModel',$fileContents);
        // remove useless "use Illuminate\Database\Eloquent\Model;" clause
        $fileContents = preg_replace('#\r?\nuse Illuminate\\\Database\\\Eloquent\\\Model;\r?\n#si',"",$fileContents);
        file_put_contents($filename, $fileContents);
    }

}
