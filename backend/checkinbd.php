<?php

include "../connection.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

print_r($_POST);


$date = $_POST['date'];
$totalinput = $_POST['totalinput'];
$today = $_POST['today'];


for ($x = 0; $x < $totalinput; $x++) {
    $employeeId = $_POST[$x];
    // echo $employeeId;
    
    if(isset($_POST['checkInTime'.$employeeId])){
        // echo $employeeId."hii";
        $time = $_POST['checkInTime'.$employeeId];
        $timestamp = $date . ' ' . $time;
        echo $time;


        $sql2 = "INSERT INTO `dailyattendance`(`entryDateTime`, `Date`,`employeeId`, `checkInTime`) VALUES ('$today','$date','$employeeId','$timestamp')";
        
        $result = mysqli_query($conn,$sql2); 
        $sql ="UPDATE `employee` SET `onsite`= 1 WHERE employeeId = '$employeeId'"; 
        $result = mysqli_query($conn,$sql); 

        echo $employeeId . "first";
    }elseif($_POST['approved'.$employeeId]){

        $approvedBy = $_POST['approved'.$employeeId];
        if($approvedBy != 'none'){

            $sql = "INSERT INTO `dailyattendance` (`entryDateTime`,`Date`, `employeeId`, `apsent`, `approved`) VALUES ( '$today','$date','$employeeId', true, '$approvedBy');";
            echo $employeeId ."sec";
            $result = mysqli_query($conn,$sql); 
        }
        }  
  }

header('Location: ../index.php');
}
?>