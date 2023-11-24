<?php
session_start();
include_once('con.php');

$id = $_GET['id'];
$query = "DELETE FROM roles WHERE id = ".$id.";";
$result = mysqli_query($con, $query);
if($result){
    $_SESSION['success_message'] = 'Role deleted successfully.';
    header('Location:roles_list.php');
}
else{
    echo "check your query";
}
?>