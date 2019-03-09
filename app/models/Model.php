<?php

require_once "../../app/traits/Read.php";
require_once "../../app/traits/Create.php";

class Model{

	use Read, Create;

	protected $Connect;

	public function __construct(){

		$this->Connect 	= DBConnection::FPDOConnection();
	}
}