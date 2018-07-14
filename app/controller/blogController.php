<?php
class blogController extends Controller{

  public function index(){
    $blogModel = $this->model('blog');
    $data = $blogModel->getPosts();
    $this->view('blog\index', $data);
  }
  public function article(){
    $blogModel = $this->model('blog');
    $data = $blogModel->getArticles();
    $data = [
      'title' => $title,
       'desc' => $description,
      'author' => $author_name
    ];
    $this->view('home\index', $data);
  }

}//end homeController

 ?>
