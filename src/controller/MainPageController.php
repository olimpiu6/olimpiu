<?php  
namespace controller;

use controller\Controller;
use entity\Categorias;
use entity\Tareas;
use repository\TaskRepository;

class MainPageController extends Controller{

	public function mainPage(){

		$cat = new Categorias();
		$categorias = $cat->findAll('categorias');

		$taskRepo = new TaskRepository();
		$tareas = $taskRepo->getAllTasks('tareas');

		$this->loadView(self::BASE_PATH . '/templates/header.php');
		$this->loadView(self::BASE_PATH . '/templates/menu.php');
		$this->loadView(self::BASE_PATH . '/templates/table.php', array(
			'categorias'=>$categorias,
			'tareas'=>$tareas
		));
		$this->loadView(self::BASE_PATH . '/templates/footer.php');
	}
}


?>