<?php 

namespace entity;

use repository\Repository;

class Tareas extends Repository{

	private $id;
	private $nombre;
	private $fechaCreacion;

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

	public function setfechaCreacion($fecha){
		$this->fechaCreacion = $fecha;

		return $this;
	}

	public function getfechaCreacion(){
		return $this->fechaCreacion;
	}
}

?>