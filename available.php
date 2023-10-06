<?php
include './connection.php';

// $sql = "SELECT *
// FROM employee WHERE onsite = 1 AND active = 1;";


$sql = " SELECT  da.employeeId , e.name, e.contactNo, e.address, da.checkInTime
 FROM dailyattendance da
 INNER JOIN employee e ON da.employeeId = e.employeeId
WHERE da.checkOutTime  IS NULL AND da.apsent = 0
ORDER BY da.checkInTime";


$result = mysqli_query($conn, $sql);
if ($result) {
    $row =  mysqli_fetch_all($result);

    $json = json_encode($row);
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <div class="text-center m-4">
            <h1>Employee detail </h1>
        </div>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Sr no</th>
                    <th scope="col">Em id</th>

                    <th scope="col">Name</th>
                    <th scope="col">contact No</th>
                    <th scope="col">address</th>
                    <th scope="col">checkIN time</th>
                    <th scope="col">workingHour</th>
                </tr>
            </thead>
            <tbody id="fild">


            </tbody>
            
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        var json = <?= $json ?>;
        // console.log(json)
        let totalinput = 1;
        let tab = "";

        for (const key in json) {
            if (json.hasOwnProperty(key)) {
                // console.log(json[key] );
            
                const checkIN = new Date(json[key][4]);
                const nowTime = new Date();
                let diff = nowTime - checkIN;
                // console.log(checkIN);
                // console.log(nowTime);

                
                var hh = Math.floor(diff / 1000 / 60 / 60);
                if(hh<10){

                    hh = ('0' + hh).slice(-2)
                }

                // console.log(hh);
                diff -= hh * 1000 * 60 * 60;
                var mm = Math.floor(diff / 1000 / 60);
                mm = ('0' + mm).slice(-2);

                
                const workinghours = hh+":"+mm;

                tab += ` <tr>
                    <th class="p-2" scope="row">${totalinput}</th>
                    <td class="p-2">${json[key][0]}</td>
                    <td class="p-2">${json[key][1]}</td>
                    <td class="p-2">${json[key][2]}</td>
                    <td class="p-2">${json[key][3]}</td>
                    <td class="p-2">${json[key][4]}</td>
                    <td class="p-2">${workinghours}</td>
                </tr>`;

                totalinput++;


                // console.log(json[key][0] + "  " + json[key][1]);
            }
        }

        document.getElementById("fild").innerHTML = tab
    </script>
</body>

</html>