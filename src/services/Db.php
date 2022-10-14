<?php
/*
* Db,  CRUD utility
*/
namespace services;
use \PDO;

require_once(__DIR__ . '/config.php');

class Db{

    private $pdo;

	//setters
	public function setPdo(){
		try {
            $this->pdo = new PDO("mysql:host=" . SERVER .";dbname=" . DB, USER, PASS);
            // error mode exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Coneccion fallida: " . $e->getMessage();
            }
	}

	//getters
	public function getPdo(){
		$this->setPdo();
		return $this->pdo;
	}

    //select
    public function selectQ($query, $bind=array()){
        $stmt=$this->pdo->prepare($query);
        $stmt->execute($bind);

        if($stmt){
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        }else{
        	return array();
        }
    }

    //insert, update, delete
    public function execQ($query, $bind=array()){
        $stmt=$this->pdo->prepare($query);
        $stmt->execute($bind);

        if($stmt){
          return true;
        }else{
            return false;
        }
    }

     //return last inserted id
    public function lastId(){
        $lastId = $this->pdo->lastInsertId();
        return $lastId;
    }


}

?>