<?php
global $conn;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "native_blog";

$conn = mysqli_connect($servername , $username, $password, $dbname);
// CEK KONEKSI
if(!$conn){
  die("Connection failed : " .mysqli_connect_error());
}
?>
