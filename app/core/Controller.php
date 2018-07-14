<?php
/*
 *  CORE CONTROLLER CLASS
 *  Loads Models & Views
 */
class Controller{

  protected $view;
  protected $model;

  //=============================================================create a new view
  public function view($viewFile,$data=[]){
    if(file_exists(VIEW. $viewFile . '.pearl')){
      include (VIEW. $viewFile . '.pearl');
    }
  }
  //=============================================================create a new model
  public function model($modelName,$data=[]){
    if(file_exists(MODEL . $modelName . '.php')){
      require (MODEL . $modelName . '.php');
      return $this->model = new $modelName;
    } else {
      // No view exists
      die('View does not exist');
    }
  }
  //get breadcrumb to display in view 
  public function breadcrumb(){
    //modelname/action/parameter1/parameter2
    
  }


}

?>
