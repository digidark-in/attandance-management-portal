<?php 
$servername = "89.117.157.154";
$username = "u359658933_qrgymoutlet";
$password = '7Ta~PthT>g|3$Vn]]1Ow';
$dbname = "u359658933_qrgymoutlet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>