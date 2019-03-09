<?php

session_start();

class Login{

    protected $Conn;
    protected $Model;
    
    
	public function __construct(){

		$this->Conn 		= new DBConnection;
        $this->Model     	= new LoginModel;
    }    


    public function FLogin($Data){

        /* Get's User Info. */
        $user   = $this->Model->findBy('u_user_name', $Data['pUserName'], false);
        
        if(!$user){

            return false;
        }

        /* Verifying the Passwords. */
        if(Password::verify($Data['pUserPassword'], $user->u_user_password)){
            
            $_SESSION['isLoggedIn'] = 'true';
            $_SESSION['uUserID']    = $user->u_id;
            $_SESSION['uIsAdmin']   = $user->u_user_level;
            $_SESSION['uUserName']  = ucfirst ( $user->u_user_first_name ) . ' ' . ucfirst ( $user->u_user_last_name );
            return true;
        }

        return false;
    }
}