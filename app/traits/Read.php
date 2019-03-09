<?php

trait Read{

	private $SQL;
	private $Binds;


    private function BindExecute(){

        $Select = $this->Connect->prepare($this->SQL);
        

        $Select->execute($this->Binds);
        
        return $Select;
    }


    private function FReturnSQLBinds(array $pArgs){

        $toReturn = "";

        $toPatern = '/[\<>]/';

        $i=0;
        foreach ($pArgs as $key => $value) {
            $i++;           
            
            $toReturn .= ($i % 2 != 0)? $value . " = :" . $value . " AND ": "";
        }
        
        return (rtrim($toReturn, " AND "));        
    }    




    /* The SQL where Clause. */
    public function where(){

        /* Get the Number of Arguments. */
        $vNumArgs   = func_num_args();

        /* Get the Arguments. */
        $vArgs      = func_get_args();

        /* Creating the SQL WHERE Clause. */
        switch ($vNumArgs) {

            /* TWO Args it's = */
            case ($vNumArgs == 2):
                
                $this->SQL .= " WHERE {$vArgs[0]} = :{$vArgs[0]}";

                $this->Binds = [ $vArgs[0] => $vArgs[1] ];
                break;


            /* MORE tham TWO Args */
            case ($vNumArgs > 2):

                $this->SQL .= " WHERE " . $this->FReturnSQLBinds((array) $vArgs);                

                /* Creates the Array with All Where Clause's Ex: WHERE Field = :Field */
                $i=0;         
                foreach ($vArgs as $key => $value) {
                    
                    /* Only when is a ODD */
                    $i++; 
                    if($i % 2 != 0){ 

                        /* Populates the Array with all the Arguments. */
                        $this->Binds[$value] = $vArgs[$i];
                    };                                    
                }
                break;           
        }
        
        return $this;
    }





   	/* Return All Records. */
    public function all($pTable = null){

        $vTable = ($pTable === null)? $this->Table: $pTable;
        
        $SQL = "SELECT * FROM {$vTable}";
        
        $All = $this->Connect->query($SQL);

        $All->execute();

        return $All->fetchAll();
    }






    /* Returns a SQL Selection */
    public function select($Table = null, $Fields = '*'){

        $vTable = ($Table === null) ? $this->Table: $Table;

        $this->SQL = "SELECT {$Fields} FROM {$vTable}";

        return $this;
    }





    /* Select by ID. */
    public function ById($pTable = null, $pFieldName, $pValue){
        
        $vTable = ($pTable === null) ? $this->Table: $this->View;

        $this->SQL = "SELECT * FROM {$vTable} WHERE `{$pFieldName}` = :{$pFieldName}";
       

        $this->Binds[$pFieldName] = $pValue; 
        

        $Select = $this->BindExecute();

        return $Select->fetchAll();
    }






    /* Returns all the Fields. */
    public function get(){

        $Select = $this->BindExecute();

        return $Select->fetchAll();
    }






    /* Returns the First Record. */
    public function first(){

        $Select = $this->BindExecute();

        return $Select->fetch();
    }


    /* Find by a Specific Field */
    public function findBy($field, $value){     

        $this->SQL = "SELECT * FROM {$this->Table}";
        
        $this->where($field, $value);

        return $this->first();
    }





    public function FExecSQL($pSQL, $pBinds, $pTypeReturn=0){

        /* The String SQL */
        $this->SQL = $pSQL;

        /* Binding the Binds. */
        foreach ($pBinds as $key => $value) {

            $this->Binds[$key] = $value;
        }

        $Select = $this->BindExecute();

        /* Set the Type of Return fetch = 0 default, fetchAll = 1, rowCount = 2*/
        switch ($pTypeReturn) {

            /* fetchAll() */
            case 1:
                return $Select->fetchAll();
                break;

            /* RowCount. */
            case 2:
                return $Select->rowCount();
                break;
            
            default:
                return $Select->fetch();
                break;
        }
    }        

}