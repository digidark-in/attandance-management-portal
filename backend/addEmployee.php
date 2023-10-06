<?php 

include "../connection.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

print_r($_POST);

$name = $_POST['name'];
$phoneNO = $_POST['phoneNO'];
$address = $_POST['address'];
$joiningDate = $_POST['joiningDate'];
$gender = $_POST['gender'];
$salary = $_POST['salary'];



$sql = "INSERT INTO `employee` (`name`, `gender`,`contactNo`, `address`, `joiningDate`,  `salary` ) VALUES ( '$name', '$gender','$phoneNO', '$address', '$joiningDate','$salary');";

$result = mysqli_query($conn, $sql);

}
header('Location: ../index.php');
?>