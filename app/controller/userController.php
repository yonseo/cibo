<?php
class userController extends Controller{

   //=============================================================User Profile page
  public function profile(){
    $data = [
      'hello' => 'hello world'
    ];
    $this->view('user\profile', $data);
  }
  //=============================================================logout and end seession

  public function logout(){
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['coin']);
    unset($_SESSION['success']);
    $_SESSION = array();
    session_destroy();
    header('Location: /user/login');
    exit();
  }
   //=============================================================check for user authentication on login form
  public function login(){
  //check for POST else display the form
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //process form

      $data = [
        'email' => trim($_POST['login_email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => ''
      ];
      $errors = 0;
      //Validate email
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter an email';
        $errors++;
      }else{
        $userModel = $this->model('user');
        if($userModel->findUserByEmail($data['email']) == true){
          //User Found
          //die('A user with that email is found');

        }else{
          //No user found
          $data['email_err'] = 'No user found';
          $errors++;
        }
      }
      //Validate Password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter a password';
        $errors++;
      }elseif(strlen($data['password']) < 6){
        $data['password_err'] = 'Password must be at least 6 characters';
        $errors++;
      }

     //Make sure errors are empty
      if(empty($data['email_err']) && empty($data['password_err']) ){
        //Check and set  logged in user
        $loggedInUser = $userModel->login($data);
        if($loggedInUser){
          //Create User Session
          if($userModel->userSESSION($loggedInUser) == true){
            header('Location: /home/index');
            exit();
          }else{
            die('Something went wrong!');
          }

        }else{
          $data['password_err'] = 'Password incorrect';
          //Load View with Errors
          $this->view('user\login', $data);

        }

      }else{
        //Load View with Errors
        $this->view('user\login', $data);

      }

    }else{
      //load form
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => ''
      ];
      //load View
      $this->view('user\login', $data);

    }//end else load form view
  }
  //=============================================================check for user authentication on register form
  public function register(){
    //check for POST else display the form
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //process form

      $data = [
        'name' => trim($_POST['reg_username']),
        'email' => trim($_POST['reg_email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      $errors = 0;
      //Validate email
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter an email';
        $errors++;
      }else{
        $userModel = $this->model('user');
        if($userModel->findUserByEmail($data['email']) == true){
          $data['email_err'] = 'A user with that email already exists';
          $errors++;
        }
      }
      //Validate Name
      if(empty($data['name'])){
        $data['name_err'] = 'Please enter a name';
        $errors++;
      }
      //Validate Password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter a password';
        $errors++;
      }elseif(strlen($data['password']) < 6){
        $data['password_err'] = 'Password must be at least 6 characters';
        $errors++;
      }
      //Validate Confirm Password
      if(empty($data['confirm_password'])){
        $data['confirm_password_err'] = 'Please confirm password';
        $errors++;
      }
      //Validate if both passwords match
      if($data['password'] != $data['confirm_password']){
        $data['confirm_password_err'] = 'Passwords do not match';
        $errors++;
      }

      //Make sure errors are empty
      if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) &&
      empty($data['confirm_password_err']) ){
        //validated
        //die('SUCCESS');
        // Hash Password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        //Execute to db
        if($userModel->register($data) == true){
          // Redirect to login
          header('Location: /user/login');
        } else {
          die('Something went wrong');
        }

      }else{
        //die('post submitted with errors');
        //Load View with Errors
        $this->view('user\register', $data);

      }

    }else{
      //load form
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      //load View
      $this->view('user\register', $data);

    }//end else load form view

  }//end register method
}//end userController

 ?>
