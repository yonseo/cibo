<?php

/***************DO NOT ALLOW DIRECT ACCESS************************************/
if ( stripos( $_SERVER[ 'REQUEST_URI' ], basename( __FILE__ ) ) !== FALSE ) { // TRUE if the script's file name is found in the URL
  header( 'HTTP/1.0 403 Forbidden' );
  die( "<h2>Forbidden! You don't have permission to access this page.</h2>" );
}
/*****************************************************************************/

class Kon{
    protected function dbconnect(){
        $host = $this->servername = "localhost";
        $username = $this->username = "root";
        $password = $this->password = "root";
        $dbname = $this->dbname = "cibo_db";

        //set DSN
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        //create a pdo instance
        $link = new PDO($dsn, $username, $password);
        //procedural connection
        //$link = mysqli_connect($host,$username,$password,$dbname);

      // Check connection
      if (!$link){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }else if ($link){
        return $link;
      }
    }//end dbconnect
}// end Kon
?>
