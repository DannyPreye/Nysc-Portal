<?php
  require_once __DIR__. '\classes\class.php';
  $server = '127.0.0.7';
  $username = "Daniel";
  $password = "12345678";
  $db = "daniel";
  $table = "nysc";

  // Instantiate the class
  $con = new dbconnect($server,$username,$password,$db);
  //connect db
  $con->connect();

?>