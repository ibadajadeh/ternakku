<?php
include_once("config.php");


$id = $_GET['id']; 
$result = $conn->prepare("DELETE FROM users WHERE id=?");
$result->bind_param("i", $id); 
$result->execute(); 
$result->close(); 
echo "Delete Success!"; 
?>
