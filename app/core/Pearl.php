<?php
/*
 *  Pearl Template CONTROLLER CLASS
 *  uses custom syntax to display data to a view
 *  displays header, footer, and sidebar
 *  currently a work in progress
 *
 * credits: https://yonseo.com
 * email: yonseoart@gmail.com
 */
class Pearl extends Controller{

  //variables
  private $vars = array();

  //=============================================================controller view
  public function controllerView($viewName){
    $view = $this->view($viewName);
    return $view;
  }
  //=============================================================controller model
  public function controllerModel($modelName){
    $model = $this->model($modelName);
    return $model;
  }
  //=============================================================assign variables to array data
  public function net($arrayName, $arrayData){
      $contents = file_get_contents($path);
      $contents = preg_replace($arrayName, $arrayData);
      eval(' ?>' . $contents . '<?php ');
  }
  //=============================================================assign variables to single data
  public function assign($key, $value){
    $this->vars[$key] = $value;
  }
  //=============================================================render the temnplate with assigned variables
  public function render($template_name){
    $path = VIEW . $template_name . '.pearl';
    if(file_exists($path)){
      //include $path;
      $contents = file_get_contents($path);
      foreach($this->vars as $key => $value){
        $contents = preg_replace('/\[' . $key . '\]/', $value, $contents);
      }
      eval(' ?>' . $contents . '<?php ');
    }else{
      die('<h1>Template Error!</h1>');
    }
  }

}//end pearl

?>
