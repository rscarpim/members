<?php


class Load{

    public static function file($file){

        $file = path().$file;

        if(!file_exists($file)){
            
            throw new \Exception("File Doesn't exists: {$file}");
        }

        return require $file;

    }

}
