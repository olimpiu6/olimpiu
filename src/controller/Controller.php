<?php
namespace controller;
/*
* Controller class
*/

class Controller{

    const BASE_PATH =  __DIR__ . '/../../' ;

    /*
    * 
    */

    /*
    * @param string $view
    * @param array $assets
    */
    public function loadView($view, $data=array('css'=>array(), 'js'=>array() ) ){
    	if(file_exists( $view )){
           include_once($view);
    	}else{
    		die('ERROR VIEW -- '.$view.' -- NOT FOUND. CHECK THEME FOLDER');
    	}
    }
}