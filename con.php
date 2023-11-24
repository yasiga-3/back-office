<?php
$servername = "localhost";
$username = "sharkfin_backofficeusr";
$password = "5GHNwbPEgk5wuw3";
$database = "sharkfin_backoffice";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>