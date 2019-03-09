<?php


class DBConnection{


    public static function FPDOConnection(){

        $pdo = new PDO("mysql:host=localhost;dbname=dbusers", "root", "");

        $pdo->setAttribute(PDO::ATTR_ERRMODE,               PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,    PDO::FETCH_OBJ);

        return $pdo;
    }    


}