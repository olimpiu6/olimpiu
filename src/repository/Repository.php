<?php 
namespace repository;

use services\Db;

class Repository{

	private $db;

	public function __construct(){
		$this->setDb();
	}

	//setter -- getters
	public function setDb(){
		$this->db = new Db();

		return $this;
	}

	public function getDb(){
		return $this->db;
	}

	//utilities functions
	public function findAll($tableName){
		$pdo = $this->db->getPdo();

		$sql = 'SELECT * FROM ' . $tableName;
		$result = $this->db->selectQ($sql);

		return $result;
	}

	//delete
	public function deleteRow($tableName, $id){
		$pdo = $this->db->getPdo();

		$sql = 'DELETE FROM ' . $tableName . ' WHERE id = :id' ;
		$result = $this->db->execQ($sql, array(':id'=>$id));

		return $result;
	}

}

?>