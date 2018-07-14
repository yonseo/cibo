<?php
//Models get data and return it to the controller
//all models extend Cibo to access SQL functions and database connection

class blog extends Cibo{

  public function getPosts(){
    $sql = "SELECT * FROM cibo_posts";
    $stmt = $this->CiboQUERY($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
}//end blog object

?>
