<?php 
include './connection.php';

echo "hii";

date_default_timezone_set("Asia/Kolkata");

$previousMonth = date("n")-1;
$previousYear = date('Y');

if ($previousMonth === 0) {
    // If it's January, set the previous month to December of the previous year
    $previousMonth = 12;
    $previousYear -= 1;
}

echo $previousMonth;
echo "<br>";
echo $previousYear;
echo "<br>";


$daysInPreviousMonth = cal_days_in_month(CAL_GREGORIAN, $previousMonth, $previousYear);

// Calculate the number of Sundays in the previous month
$sundays = 0;
for ($day = 1; $day <= $daysInPreviousMonth; $day++) {
    $date = "$previousYear-$previousMonth-$day";
    if (date("N", strtotime($date)) == 7) {
        $sundays++;
    }
}

echo $daysInPreviousMonth;
echo "<br>";
echo $sundays;
echo "<br>";


$sql ="SELECT e.employeeId, e.name, SEC_TO_TIME(SUM(TIME_TO_SEC(STR_TO_DATE(da.workingHours, '%H:%i:%s')))) AS totalWorkingHours , e.salary,e.balance
FROM employee e
LEFT JOIN dailyattendance da ON e.employeeId = da.employeeId
WHERE MONTH(da.date) = '$previousMonth' AND YEAR(da.date) = '$previousYear'
GROUP BY e.employeeId, e.name;
";


$result = mysqli_query($conn , $sql);

while ($row = mysqli_fetch_assoc($result)){
    if($row['totalWorkingHours']){
        print_r($row);
        
        
        
        $workingHour = $row['totalWorkingHours'];
        echo gettype($workingHour);
        $hu = substr($workingHour, strpos($workingHour, ":") + 1);
        $min = substr($hu, strpos($hu, ":") + 1);

        echo $hu;
        echo "<br>";
        echo $min;
        echo "<br>";
        echo $workingHour;
        echo "<br>";
        $perhour = $row['salary']/($daysInPreviousMonth*9);
        // $salary = $perhour*($row['totalWorkingHours']+0);
        echo $perhour;
        echo "<br>";
        // echo $salary;
        echo "<br>";
    }
}


?>