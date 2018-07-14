<?php
// Models get data and return it to the controller
// all models extend Cibo to access SQL helper functions and database connection
//
// user Model

class user extends Cibo{

  public function __construct(){

  }
  public function userSESSION($user_data){
    session_start(); //important! create session to set variables
    $_SESSION['id'] = $user_data['users_id'];
    $_SESSION['username'] = $user_data['users_name'];
    $_SESSION['email'] = $user_data['users_email'];
    $_SESSION['coin'] = $user_data['users_coin'];
    $_SESSION['success'] = "You are now logged in";
    return true;
  }
   //=============================================================find user by email
  public function findUserByEmail($email){
    $sql = "SELECT * FROM cibo_users WHERE users_email = :email";
    $stmt = $this->CiboPREP($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num = $stmt->rowCount();

    if($num > 0){
      return true;
    }else{
      return false;
    }  
  }
    //=============================================================User Login Auth
  
  public function login($data){
    //login User 
    $email = $data['email']; 
    $password = $data['password'];  //unhashed password

    $sql = "SELECT * FROM cibo_users WHERE users_email = :email";
    $stmt = $this->CiboPREP($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashed_password = $record['users_password'];
    //if hash password matches given password 
    if(password_verify($password, $hashed_password)){
      return $record;
    }else{
      return false;
    }
  }
   //=============================================================User Register Auth
  public function register($data){
    //create new user 
      $sql = "INSERT INTO cibo_users (users_name, users_email, users_password) VALUES (:name, :email, :password)";
      $stmt = $this->CiboPREP($sql);
      //Bind Parameters
      $stmt->bindParam(':name', $data['name']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':password', $data['password']);

      if($stmt->execute()){
        return true;
      }else{
        return false;
      }

  }//end method register

}//end user object

?>
