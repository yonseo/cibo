<?php
/*
 *  APP CORE CLASS
 *  Creates URL & Loads Core Controller
 *  URL Format - /controller/method/param1/param2
 *
 * credits: https://yonseo.com
 * email: yonseoart@gmail.com
 */
class Core{

protected $controller = 'homeController'; // Default controller
protected $action = 'index'; // Default method
protected $params = []; // Set initial empty array

  public function __construct(){
    echo 'Load object Core, Load method construct</br>';
    $this->parseURL();
    // Look in core folder for controller
    if(file_exists(CONTROLLER. $this->controller . '.php')){
      // Instantiate the current controller
      $this->controller = new $this->controller;
      // Check if second part of url is set (method)
      if(method_exists($this->controller,$this->action)){
        call_user_func_array([$this->controller, $this->action],$this->params);
      }
    }

  }
  public function parseURL(){
    echo 'Load object Core, Load method prepareURL</br>';
    $request = trim($_SERVER['REQUEST_URI'], '/');
    if(!empty($request)){
      $url = explode('/', $request);
      $this->controller = isset($url[0]) ? $url[0].'Controller' : 'homeController';
      $this->action = isset($url[1]) ? $url[1] : 'index';
      unset($url[0],$url[1]);
      $this->params = !empty($url) ? array_values($url) : [];

    }
  }


}//end core object

?>
