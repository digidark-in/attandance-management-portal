<?php

include '../connection.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = file_get_contents("php://input");
    $json_data = json_decode($data, true);

    // Access the month and year values from the JSON data
    $month = $json_data['month'];
    $year = $json_data['year'];



    $sql = " SELECT da.date, da.employeeId, da.apsent, da.checkInTime, da.checkOutTime, da.workingHours, e.name , da.approved
 FROM dailyattendance da
 INNER JOIN employee e ON da.employeeId = e.employeeId
 WHERE MONTH(`date`) = $month AND YEAR(`date`) = $year;";



$result = mysqli_query($conn, $sql);
if ($result) {
    $row =  mysqli_fetch_all($result);

    echo json_encode($row);
}

    // $response = array(
    //     "status" => "success",
    //     "message" => "Data received successfully!",
    //     "month" => $month,
    //     "year" => $year
    // );

    // Encode the response data as JSON and send it back to the JavaScript code
    // echo json_encode($response);
}
?>
