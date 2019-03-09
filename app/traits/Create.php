<?php

trait Create{

	private $SQL;
	private $Binds;


	/* Get all the Stored Procedure IN Params. */
	private function FReturnBinds($pData){


		$toReturn = "";

		foreach ($pData as $key => $value) {
			
			$toReturn .= ':' . $key . ', ';
		}
		
		return rtrim( $toReturn, ', ' );
	}

	

	/* Saving Data with a Stored Procedure.  */
	public function FCallStored($pData, $StoredName = null){
				
		$pStored = ($StoredName === null)? $this->Stored: $StoredName;

		$this->SQL = "CALL $pStored ({$this->FReturnBinds($pData)} )";

		$stmt = $this->Connect->prepare($this->SQL);
		

        foreach ($pData as $key => &$value) {
        	
        	$stmt->bindParam($key, $value);
        }				

		return $stmt->execute();
	}
}