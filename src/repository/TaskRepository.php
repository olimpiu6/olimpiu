<?php
namespace repository;

use services\Db;

class TaskRepository{

	private $db;

	public function __construct(){
		$this->db = new Db();
	}

	/*
	* get task lists along side category names
	*/
	public function getAllTasks(){
		$pdo = $this->db->getPdo();

		$sql = 'SELECT tareas.*, GROUP_CONCAT(categorias.nombre) as cat_nom
				FROM tareas 
				INNER JOIN tareas_categorias ON tareas_categorias.tarea = tareas.id
				INNER JOIN categorias ON tareas_categorias.categoria = categorias.id
				GROUP BY tareas.id ORDER BY TAREAS.id DESC
				';
		$tasks = $this->db->selectQ($sql);

		return $tasks;
	}

	/*
	* get one task
	*/
	public function getOneTasks($id){
		$pdo = $this->db->getPdo();

		$sql = 'SELECT tareas.*, GROUP_CONCAT(categorias.nombre) as cat_nom
				FROM tareas 
				INNER JOIN tareas_categorias ON tareas_categorias.tarea = tareas.id
				INNER JOIN categorias ON tareas_categorias.categoria = categorias.id
				WHERE tareas.id = :id
				';
		$tasks = $this->db->selectQ($sql, array(':id'=>$id));

		return $tasks;
	}

	/*
	* insert new task
	*/	
	public function addNew($data ){
		$pdo = $this->db->getPdo();

		$sql = 'INSERT INTO tareas(nombre, fecha_creacion) 
				VALUES(:nombre, :fecha_creacion)';

		$res = $this->db->execQ($sql, array(':nombre'=>$data, ':fecha_creacion'=>time() ));

		$lastId = $this->db->lastId();

		return $res === true ? $this->db->lastId() : false;
	}

	/*
	* insert into middle-ware table 
	*/
	public function completeAddTask($task , $category){
		$idTask = $this->addNew($task);

		if ($idTask) {
			$pdo = $this->db->getPdo();
			$category = explode(',', $category);

			$sql = 'INSERT INTO tareas_categorias(tarea, categoria) VALUES(:tarea, :categoria)';

			foreach($category as $k => $v){
				if(empty($v)){continue;}

				$this->db->execQ($sql, array(':tarea'=>$idTask, ':categoria'=>$v));
			}
		}
		return $idTask;
	}

	/*
	* delete middle ware table data
	*/
	public function deleteMiddleTable($id){
		$pdo = $this->db->getPdo();

		$sql = 'DELETE FROM tareas_categorias WHERE tarea = :tarea';
		$res = $this->db->execQ($sql, array(':tarea'=>$id));

		return $res;
	}
}

?>