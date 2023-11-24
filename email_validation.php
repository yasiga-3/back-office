<?php
include('con.php');
if(!empty($_POST["email"])) {
  $email = $_POST["email"];
  $query = "SELECT email FROM users WHERE email='" . $_POST["email"] . "'";
  $result = mysqli_query($con,$query);
  $count = mysqli_num_rows($result);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<span id='invalid' style='color:red'> Invalid email format .</span>";
    die();
  }
  if($count>0) {
     echo "<span style='color:red'> Email not available .</span>";
  }else{
    echo "<span style='color:green'> Email Avalivable .</span>";
  }
}
?>