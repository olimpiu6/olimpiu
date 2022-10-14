<?php 
include_once __DIR__ . '/src/autoload.php';

use entity\Tareas;
use repository\TaskRepository;

//validate post
if (isset($_POST['action']) && $_POST['action'] == 'deleteTask') {
	$id = is_numeric($_POST['id']) ? $_POST['id'] : false;

	if ($id) {
		$repo = new TaskRepository();
		$task = new Tareas();

		if($task->deleteRow('tareas', $id)){
			$repo->deleteMiddleTable($id);

			echo 1;
		}
		
	}
}else{
	echo 0;
}
?>