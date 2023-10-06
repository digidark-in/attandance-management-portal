<?php
include "./connection.php";

$employeeId = $_GET['empid'];
// echo $employeeId;

$sql = "SELECT * FROM employee WHERE `employeeId` = $employeeId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// print_r($row);

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- <link rel="stylesheet" href="./css/index.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        th {
            min-width: 100px;
        }

        p {
            font-size: 25px;
            padding: 0;
            margin: 0;
        }

        .info {
            background-color: #b0d8d4;
            font-weight: 500;
            opacity: 0.8;
        }

        .texx {
            color: #000000c9;
            font-size: larger;
            font-weight: 700;
            font-family: cursive;
        }
    </style>
</head>

<body class="bg-dark"> 

    <div class="container">

        <h2 class="text-center text-white mt-5"><span id="empName" class="text-primary"></span> Attendace table of</h2>
        <h1 class=" text-center text-danger " id="todayDate">
        </h1>

        <div class="row g-3 d-flex justify-content-end align-items-center m-5">

            <div class="col-6 info " style=" border-radius: 25px; ">
                <div class="row m-4 ">
                    <h1>Employee Details</h1>

                    <p>Address : <span class="texx"> <?php echo $row['address'] ?></span></p>
                    <p>Contact No : <span class="texx"> <?php echo $row['contactNo'] ?></span></p>
                    <p>Joining date : <span class="texx"> <?php echo $row['joiningDate'] ?></span></p>
                    <p>Salary : <span class="texx"> <?php echo $row['salary'] ?></span></p>
                </div>


            </div>
            <div class="col-6 d-flex justify-content-end ">

                <div class="col-auto d-flex justify-content-end  ">
                    <label for="date" class="fs-2 fw-bolder text-white  col-form-label" style="font-family: none;">Select Date:</label>
                </div>
                <div class="col-4 m-3">

                    <input type="month" class="form-control border-dark border-2" id="date" aria-describedby="emailHelp" min="2023-08" max="" onchange="onnn()" />
                </div>
            </div>
        </div>

        <section class="ftco-section">


            <div class="row justify-content-center">

            </div>
            <div class="row ">
                <div class="col-md-12" style="    background: #ffffff63;
    border-radius: 29px;">
                    <div class="table-wrap " style="margin: -12px;">
                        <table class="table table-dark table-striped table-responsive-xl my-5 ">
                            <thead>
                                <tr class="text-center" id="header">
                                    <th>Date</th>
                                    <th>Check IN time</th>
                                    <th>check Out Time</th>
                                    <th>workingHours</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="table">




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    </section>

    </div>
    <Script>
        let empid = <?= $_GET["empid"] ?>;


        let today = new Date();
        let totaldays;

        const selectDate = document.querySelector('#date');

        year = today.getFullYear();
        month = today.getMonth() + 1;

        selectDate.setAttribute('max', `${year+'-'+month}`)
        sett();

        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }

        function sett(date = "") {
            var options = {
                year: 'numeric',
                month: 'long'
            };
            let month, year;
            if (date === "") {
                year = today.getFullYear();
                month = today.getMonth() + 1;

                const d = new Date();
                totaldays = d.getDay() + 1;

                selectDate.value = year + '-' + month;


            } else {

                const myArray = date.split("-");
                year = myArray[0];
                month = myArray[1];

                const d = new Date();

                // console.log(year);
                // console.log( month , d.getMonth()+1);

                if ((month == (d.getMonth() + 1)) && year == d.getFullYear()) {
                    totaldays = d.getDay() + 1;
                    // console.log(totaldays);
                } else {
                    totaldays = daysInMonth(month, year);
                    // console.log(totaldays);

                }
            }

            document.querySelector('#todayDate').innerHTML = today.toLocaleDateString("en-US", options);
            // console.log(month, year)
            getjson(month, year);


        }

        function getjson(month, year) {


            fetch(`./backend/GETempattendance.php?empid=${empid}&month=${month}&year=${year}`)
                .then(response => response.json())
                .then(responseData => {

                    // console.log(responseData.length);
                    if (responseData.length > 0) {

                        json = responseData;
                        show();
                    } else {
                        document.getElementById('table').innerHTML = ' <td colspan="4" class="text-center"><h1 class="text-center text-danger">No Data Found</h1></td>  ';
                    }
                })
            // .catch(error => {
            //     console.error('Error:', error);

            // });


        }

        function onnn() {

            const d = new Date(selectDate.value);

            today = d;
            sett(selectDate.value);
            // console.log(today)

        }


        function show() {
            // let headerInner = '<th>ID</th> <th style="min-width: 200px;">Name</th>';
            let totalHours = 0;
            let rowData = '';

            const month = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];

            // const d = new Date();
            let name = month[today.getMonth()];
            document.getElementById('empName').innerText = json[0][6] + "'s";



            for (let i = 1; i <= totaldays; i++) {

                rowData += `<tr> <td class="text-primary">${i}-${name}</td>`;



                if (i < 10) {
                    i = "0" + i;
                }
                let workingHours = json.filter(item => item[3] != null && item[0].endsWith(`${i}`));

                let entry = json.find(item => item[3] == null && item[0].endsWith(`${i}`));


                if (workingHours.length > 0) {
                    let workingHoursDisplay = workingHours[0][5];

                    let dayTotalHours = 0;



                    let count = 0;
                    for (let entry of workingHours) {
                        let minfirst
                        let show = false;
                        // console.log(entry);

                        if (count > 0) {
                            rowData += '</tr> <td></td>'
                        }
                        count++;

                        let checkIN = entry[3].split(' ')[1].slice(0, -3);
                        let checkOUT = entry[4].split(' ')[1].slice(0, -3);
                        if (entry[5] !== null) {
                            let hoursMinutes = entry[5].split(':');
                            minfirst = parseInt(hoursMinutes[0]) * 60 + parseInt(hoursMinutes[1]);
                            // hoursfirst =  hoursfirst.toFixed(2);

                            dayTotalHours += minfirst;
                            // console.log(dayTotalHours)
                        } else {
                            // count++;
                            rowData += ` <td class="text-warning"> ${checkIN} </td> <td class="text-dark bg-warning">onsite</td>`;
                            show = true;
                        }

                        // Add the day's total working hours to the employee's total hours
                        totalHours += dayTotalHours;

                        if (!show) {
                            let hour = Math.floor(minfirst / 60);
                            let min = dayTotalHours % 60;
                            if (hour < 10) {
                                hour = "0" + hour;
                            }
                            if (min < 10) {
                                min = "0" + min;
                            }
                            // count++;
                            // console.log(hour , min)
                            rowData += ` <td class="text-warning"> ${checkIN} </td>  <td class="text-warning"> ${checkOUT} </td>   <td class="">${hour+":"+min}</td> </tr>`;

                        }
                    }
                } else if (entry) {


                    rowData += `<td class="text-danger">${entry[7]}</td> <td>-</td><td>-</td>`;
                } else {
                    rowData += `<td class="text-danger">-</td>`;
                    rowData += `<td class="text-danger">-</td>`;
                    rowData += `<td class="text-danger">-</td>`;
                    workingHoursDisplay = '-';

                }
            }


            rowData += `<tfoot>
            
            <tr>
      <td colspan="3" class="text-center">total working hours</td>
      <td class="text-warning">${(totalHours/60).toFixed(2)}</td>
    </tr>
                        </tfoot>`;

            let table = document.getElementById('table');

            table.innerHTML = rowData;

        }
    </Script>

</body>

</html>