<?php 

namespace entity;

use repository\Repository;

class Categorias extends Repository{

	private $id;
	private $nombre;

	//setter -- getter
	public function setId($id){
		$this->id = $id;

		return $this;
	}

	public function getId(){
		return $this->id;
	}

	public function setName($name){
		$this->nombre = $name;

		return $this;
	}

	public function getName(){
		return $this->nombre;
	}
}

?>