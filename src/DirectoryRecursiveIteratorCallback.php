<?php

namespace DominikStyp\LaravelModelAbstractor;

/**
 * DirectoryRecursiveIteratorCallback
 *
 * @author Dominik
 */
class DirectoryRecursiveIteratorCallback {
    
    /**
     * Closure gets \SplFileInfo instance as first parameter
     * 
     * @param type $dir
     * @param \Closure $closure
     */
    public static function iterateOverFilesInDir($dir, \Closure $closure){
        $directory = new \RecursiveDirectoryIterator($dir);
        $iterator = new \RecursiveIteratorIterator($directory);
        foreach($iterator as $info){ /* @var $info \SplFileInfo */
            if($info->isFile()){
                $closure($info);
            }
        }
    }
    
    
}
