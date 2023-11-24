<?php
session_start();
include_once('con.php');

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id = ".$id.";";
$result = mysqli_query($con, $query);
if($result){
    $_SESSION['success_message'] = 'User deleted successfully.';
    header('Location:user_management.php');
}
else{
    echo "check your query";
}
?>