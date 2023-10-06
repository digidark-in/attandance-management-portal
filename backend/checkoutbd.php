<?php

include "../connection.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

print_r($_POST);

$totalinput = $_POST['totalinput'];
$date = $_POST['date'];



for ($x = 0; $x < $totalinput; $x++) {

  if(isset($_POST[$x])){

    $employeeId = $_POST[$x];
    
    $checkInTime = $_POST['checkInTime'.$employeeId];
    $time = $_POST['checkOutTime'.$employeeId];
    $workinghours = $_POST['workingHours'.$employeeId];
    
    
    $timestamp = $date . ' ' . $time;


    $sql = "UPDATE `dailyattendance` SET `checkOutTime`='$timestamp',`workingHours`='$workinghours' WHERE `employeeId` = '$employeeId' AND `checkOutTime` IS NULL AND  `apsent` != 1 ";
    $result = mysqli_query($conn, $sql);
    
    $sql1 ="UPDATE `employee` SET `onsite`= 0 WHERE employeeId = '$employeeId'"; 
    $result = mysqli_query($conn,$sql1);
  }
}
header('Location: ../index.php');
}
?>