<?php  
class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASSWORD;
	private $dbName = DB_NAME;

	private $handler;
	private $query;
	private $error;

	public function __construct() {
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try {
			$this->handler = new PDO($dsn, $this->user, $this->pass, $options);
		} 
		catch (PDOException $e) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	public function query($sqlQuery) {
		$this->query = $this->handler->prepare($sqlQuery);
	}

	public function bind($param, $value, $type = null) {
		if ( is_null($type) ) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;

				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
							
				default:
					$type = PDO::PARAM_STR;
			}
		}

		$this->query->bindValue($param, $value, $type);
	}

	public function execute() {
		return $this->query->execute();
	}

	public function singleResult() {
		$this->execute();
		return $this->query->fetch(PDO::FETCH_OBJ);
	}	

	public function multipleResult() {
		$this->execute();
		return $this->query->fetchAll(PDO::FETCH_OBJ);
	}	

	public function rowCount() {
		return $this->query->rowCount();
	}
}
?>