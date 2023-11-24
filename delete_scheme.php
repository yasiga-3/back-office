<?php
session_start();
include_once('con.php');

$id = $_GET['id'];
$query = "DELETE FROM scheme WHERE id = ".$id.";";
$result = mysqli_query($con, $query);
if($result){
    $_SESSION['success_message'] = 'Scheme deleted successfully.';
    header('Location:scheme_list.php');
}
else{
    echo "check your query";
}
?>