<?php

//namespace app\controllers;

class LoginController
{


    protected $Conn;
    protected $Model;
    protected $Login;

    public function __construct()
    {

        $this->Conn         = new DBConnection;
        $this->Model         = new MembersModel;
        $this->Login        = new Login;
    }

    /* Login */
    public function FLogin($pData)
    {

        return $this->Login->FLogin($pData);
    }
}
