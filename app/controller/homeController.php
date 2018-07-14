<?php
class homeController extends Controller{

  public function index(){
    $data = [];
    $this->view('home\index', $data);

  }
  public function aboutus(){
    $data = [];
    $this->view('home\aboutus', $data);

  }

}//end homeController

 ?>
