<?php 
include_once __DIR__ . '/src/autoload.php';

use repository\TaskRepository;

//validate post
if (isset($_POST['action']) && $_POST['action'] == 'newTask') {
	$data = isset($_POST['data']) ? json_decode($_POST['data']) : false;

	if (is_array($data)) {
		$repo = new TaskRepository();
		$lastId = $repo->completeAddTask($data[0], $data[1]);

		if(is_numeric($lastId)){
			$response = $repo->getOneTasks($lastId);
			$response = json_encode($response);

			echo $response != NULL ? $response : 0;
		}else{
			echo 0;
		}

		
	}
}else{
	echo 0;
}
?>