<?php
class Connection {
	public $host = "localhost";
	private $username = "root";
	private $password = "";
	public $dbName = "firma";
	public $connection;

	public function connection(){
		try {
			$this->connection = new PDO("mysql:host=". $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->exec('SET CHARACTER SET utf8');	//Setting utf-8 charset
			return $this->connection;  
		}catch(PDOException $a){
			echo "Connection failed: " . $a->getMessage();
		}
	}
}
?>