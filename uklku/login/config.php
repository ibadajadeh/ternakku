<?php
$server = "localhost";
$username ="root";
$pass ="";
$database ="ukl";
$conn = mysqli_connect($server, $username, $pass,$database);
if(!$conn){
    die('koneksi gagal:'. mysqli_connect_error());
}
?>