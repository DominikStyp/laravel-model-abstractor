<?php

namespace DominikStyp\LaravelModelAbstractor;

/**
 * ReflectionHelper
 *
 * @author Dominik
 */
class ReflectionHelper {
    
    private $filePath = '';
    private $contents = '';
    private $classFullName = '';
    /**
     *
     * @var \SplFileInfo
     */
    private $splFileInfo;
    /**
     *
     * @var \ReflectionClass
     */
    private $reflectionClass;
    
    public function __construct(\SplFileInfo $splFileInfo) {
        if(!$splFileInfo->isFile()){
            throw new \Exception("File {$splFileInfo->getPathname()} is not a file");
        }
        $this->filePath = $splFileInfo->getPathname();
        $this->contents = file_get_contents($this->filePath);
        $this->splFileInfo = $splFileInfo;
    }
    
    public function isChildOfEloquentModel() {
        $classFullName = $this->getClassFullName();
        $reflectionClass = new \ReflectionClass($classFullName);
        $parent = $reflectionClass->getParentClass();
        $parentName = $parent->getName();
        return $parentName === 'Illuminate\Database\Eloquent\Model';
    }
    
    public function getClassFullName() {
            if(empty($this->classFullName)){
                $namespace = $this->getNamespace();
                if(empty($namespace)){
                    throw new \Exception("Whooops! {$this->filePath} doesn't have a namespace ???");
                }
                $baseName = str_replace(".php",'',$this->splFileInfo->getFilename());
                $this->classFullName = "\\{$namespace}\\{$baseName}";
            }
            return $this->classFullName;
    }
    
    protected function getNamespace(){
        if(preg_match("#namespace ([^;]+);#", $this->contents, $matches)){
            return trim($matches[1]);
        }
        return "";
    }
    
    public function isOriginalLaravelModel(){
        return strpos($this->contents, "use" ." Illuminate\Database\Eloquent\Model")!==false;
    }
    
}
