<?php

namespace DominikStyp\LaravelModelAbstractor\Console\Commands;

use DominikStyp\LaravelModelAbstractor\DirectoryRecursiveIteratorCallback;
use DominikStyp\LaravelModelAbstractor\ReflectionHelper;
use Illuminate\Console\Command;
use SplFileInfo;
use function app_path;

class ListModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-model-abstractor:list-models';

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
                echo "\nFound {$classFullName} which EXTENDS Eloquent\Model directly";
            } else {
                echo "\nFound {$classFullName} which DOESN'T EXTEND Eloquent\Model";
            }
        }
    }
    

}
