<?php 
  $dbHostName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "authentication";
  // database connection validation
  $conn = mysqli_connect($dbHostName, $dbUserName, $dbPassword, $dbName);
  // connection  validation
  if(!$conn) {
    die("Connection failed: " .mysqli_connect_error());
  }
?>