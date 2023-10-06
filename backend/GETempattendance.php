<?php
include '../connection.php';

//  $empName = $_GET["name"];
$empId =  $_GET["empid"];
$month = $_GET['month'];
$year = $_GET['year'];




$sql = " SELECT da.date, da.employeeId, da.apsent, da.checkInTime, da.checkOutTime, da.workingHours, e.name , da.approved
 FROM dailyattendance da
 INNER JOIN employee e ON da.employeeId = e.employeeId
 WHERE MONTH(`date`) = $month AND YEAR(`date`) = $year AND da.employeeId = $empId; ";


$result = mysqli_query($conn, $sql);
if ($result) {
    $row =  mysqli_fetch_all($result);
    $json = json_encode($row);
    echo $json;
}
?>