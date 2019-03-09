<?php


class MembersController{


    protected $Conn;
    protected $Model;
    protected $Hash;

	public function __construct(){

		$this->Conn 		= new DBConnection;
        $this->Model     	= new MembersModel;	
        $this->Hash         = new Password;	
    }
    
    


    /* Get all Members */
    public function FGetAllMembers(){
        
        return $this->Model->select()->all();
    }


    /* Get Member by Field */
    public function FCheckUserName($pData){

        $SQL = "SELECT * FROM {$this->Model->Table} WHERE `u_user_name` = :u_user_name";

        return $this->Model->FExecSQL($SQL, ['u_user_name' => $pData], 1);
    }


    /* CRUD Operations = Saving the new Member. */
    public function FCRUDMember($pData){

        /* Hash the Password. */
        $vPassword = $this->Hash->make($pData['pUserPassword']);

		/* Removes First Item from Array POST.*/
        array_splice($pData, 0, 0);         
        
        $pData['pUserPassword'] = $vPassword;

 		/* Removes Last Item from Array POST.*/
        array_pop($pData); 

        return $this->Model->FCallStored($pData);
    }

}