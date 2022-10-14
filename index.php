<?php
include_once __DIR__ . '/src/autoload.php';

use controller\MainPageController;

$controller = new MainPageController();
$controller->mainPage();
?>