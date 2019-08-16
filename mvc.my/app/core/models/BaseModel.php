<?php 

namespace core\models;

class BaseModel{


	private $host;
	private $user;
	private $password;
	private $db; 
	

    protected function connect() {

    	$this->host = '127.0.0.1';
		$this->user = 'root';
		$this->password = '';
		$this->db = 'avenue'; 
		

    	$conn = new \mysqli($this->host, $this->user, $this->password, $this->db);

    	return $conn;

    }
	
	

}