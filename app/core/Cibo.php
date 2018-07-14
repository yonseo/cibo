<?php
//=======================================================//
// Cibo mini ORM
// performs various repetetive tasks that can be called
// to perform sql instructions to the database,
// these tasks are called commands
//
// credits: https://yonseo.com
// email: yonseoart@gmail.com
//========================================================//

//=//	NOTES
/*	When using placeholders in a sql the pattern to follow is: prepare/bind/execute/fetch
*	execute() will not return the data, you must fetch the data
*
*///

class Cibo extends Kon{
	//================================================================ query sql command
	#Having a query with NO placeholders 
	public function CiboQUERY($sql){
	  $link = $this->dbconnect();
	  $query = $link->query($sql);
	  return $query;
	}
    //================================================================ prepare sql command
    #Having a query with placeholders, you have to prepare it
	public function CiboPREP($sql){
	  //user input
	  $link = $this->dbconnect();
	  $prep = $link->prepare($sql);
	  return $prep;
	}
	//================================================================ pdo execute prepared statement command
    #PDO Execute Prepared Statement with placeholders
	public function CiboEXE($placeholder){
	  //user input
	  $link = $this->dbconnect();
	  $result = $link->execute($placeholder);
	  return $result;
	}
	//================================================================ fetch one row as associative array command
	public function CiboFETCH($stmt){
	  $data = $stmt->fetch(PDO::FETCH_ASSOC);
	  return $data;
	}
	//================================================================ fetch all as associative array command
	public function CiboFETCHALL($stmt){
	  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  return $data;
	}
	//================================================================ fetch one array as object command
	public function CiboOBJ($stmt){
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
	//================================================================ fetch all arrays as object command
	public function CiboOBJALL($stmt){
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	//================================================================ return number of rows
	public function CiboCOUNT($stmt){
	  return $num = $stmt->rowCount();
	}
	//================================================================ sanitize variable command
	public function CiboCLEAN($var){
	  //sanitize data
	  $link = $this->dbconnect();
	  $sanitize_data = mysqli_real_escape_string($link, $var);
	  return $sanitize_data;
 
 }
}//end class




 ?>
