<?php
include './connection.php';

$sql = "SELECT COUNT(`employeeId`)
FROM employee WHERE onsite = 1 AND active = 1;";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_all($result);

// print_r($row);


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <div class="container ">
        <h2 class="text-center m-5">Attendance Form </h2>

        <div class="m-5">
            <h1 class="text-center m-5">Available Staff...
                <span class="text-danger fs-1 font-monospace fw-bolder m-4"> <?php echo  $row[0][0]; ?> </span>

                <a href="available.php">

                    <button class="btn btn-success btn-lg">See details </button>
                </a>

            </h1>

        </div>

        <div class="row g-3 d-flex justify-content-end align-items-center m-5">

            <div class="col-auto">
                <a href="table.php">

                    <button class="btn btn-secondary"> Attendace Table</button>
                </a>
                <a href="addEmployee.php">

                    <button class="btn btn-danger">Add employee</button>
                </a>
            </div>
        </div>
        <!-- <div class="flex "> -->
        <div class="row  justify-content-around align-items-center h-75">

            <div class="col-3  w-30">
                <a href="./checkinn.php" style=" text-decoration: none;">
                    <div class="justify-content-around align-items-center bg-primary text-light" style=" height:150px; border: 5px solid black; border-radius: 25px; ">
                        <h1 class="m-5">Check IN</h1>

                    </div>
                </a>
            </div>
            <div class="col-3  w-30">
                <a href="./checkOut.php" style=" text-decoration: none;">
                    <div class="bg-primary text-light " style=" height:150px; border: 5px solid black;
                     border-radius: 25px;">
                        <h1 class="m-5">Check Out</h1>

                    </div>
                </a>
            </div>
        </div>
        <!-- </div> -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>