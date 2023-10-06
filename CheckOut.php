<?php

include './connection.php';
// SELECT * FROM `dailyattendance` WHERE `date` = '2023-09-25'

$sql = " SELECT da.date, da.employeeId, da.apsent, da.checkInTime, da.checkOutTime, da.workingHours, e.name
 FROM dailyattendance da
 INNER JOIN employee e ON da.employeeId = e.employeeId
WHERE da.checkOutTime  IS NULL AND da.apsent = 0
ORDER BY e.employeeId";



$result = mysqli_query($conn, $sql);
if ($result) {
    $row =  mysqli_fetch_all($result);

    $json = json_encode($row);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .checkbox-xl .form-check-input {
            top: 1.2rem;
            scale: 1.7;
            margin-right: 0.8rem;
        }

        .checkbox-xl .form-check-label {
            padding-top: 19px;
        }
    </style>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <!-- Example Code -->
    <div class="container" id="forrm">
        <h2 class="text-center mt-5">Check In Entery for </h2>
        <h1 class=" text-center text-danger " id="todayDate">
        </h1>

        </h1>

        <div class="row g-3 d-flex justify-content-end align-items-center m-5">
            <div class="col-6 d-flex justify-content-start ">
                <div class="col-auto ">
                    <label for="search" class="fs-2 fw-bolder  col-form-label">Search</label>
                </div>
                <div class="col-4 m-3">

                    <input type="text" class="form-control border-dark border-2" id="search" aria-describedby="emailHelp" placeholder="search" />
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">

                <div class="col-auto d-flex justify-content-end">
                    <label for="date" class="fs-2 fw-bolder  col-form-label">Select Date</label>
                </div>
                <div class="col-3 m-3">

                    <input type="date" class="form-control border-dark border-2" id="date" aria-describedby="emailHelp" onchange="onnn()" />
                </div>
            </div>
        </div>

        <form method="post" action="./backend/checkoutbd.php">
            <div class="row">

                <div class="mb-3 col-1">
                    <H4>Emplyee ID</H4>
                </div>
                <div class="mb-3 col-3">
                    <H4 class="mx-2">Name</H4>
                </div>

                <div class="mb-3 col-2">
                    <H4>CheckIn Time</H4>
                </div>
                <div class="mb-3 col-2">
                    <H4></H4>
                </div>
                <div class="mb-3 col-2">
                    <H4>CheckOUT Time</H4>
                </div>
                <div class="mb-3 col-2">
                    <H4>Working hour</H4>
                </div>

            </div>

            <div id="fild">

            </div>

            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <!-- End Example Code -->
    <script>
        let formattedToday;
        let totalinput = 0;
        let tab = "";
        var json = <?= $json ?>;
        console.log(json)
        for (const key in json) {
            if (json.hasOwnProperty(key)) {
                //   console.log(json[key] + " hh ") ;
                let checkIn = json[key][3];
                // console.log(checkIn);

                tab += `<div class="row" id="row${json[key][1]}">
                

                        <div class="mb-3 col-1">
                        
                            <input type="number" class="form-control" id="employeeId${json[key][1]}" name="${totalinput}" aria-describedby="emailHelp" value="${json[key][1]}"  readonly disabled />
                        </div>
                        <div class="mb-3 col-3">

                            <input type="text" class="form-control" id="employeeName employeeName${json[key][6]}" aria-describedby="emailHelp" value="${json[key][6]}"  disabled />

                          
                        </div>
                       
                        <div class="mb-3 col-2">
                            <input type="text" class="form-control" name="checkInTime${json[key][1]}"  id="checkInTime${json[key][1]}" value="${checkIn}"  aria-describedby="emailHelp" readonly disabled/>
                        </div>
                        
                        <div class="mb-3 col-2 mt-2">
                        <div class="form-check checkbox-xl">
                        <input class="form-check-input" type="checkbox" name="absent${json[key][1]}" id="cc${json[key][1]}" style="margin-left: 19px;" >
                        <label class="form-check-label" for="cc${json[key][1]}" style="  margin-top: -29px;">
                        Checkout
                        </label>
                        </div>
                        </div>


                        <div class="mb-3 col-2">
                        <input type="time" class="checkout00 form-control " name=" checkOutTime${json[key][1]}"  id="${json[key][1]}" aria-describedby="emailHelp"
                        value=18:00  required disabled />
                        </div>


                        <div class="mb-3 col-2">
                            <input type="text" class="form-control"   id="workingHours${json[key][1]}" value="00:00" name ="workingHours${json[key][1]}" aria-describedby="emailHelp" disabled readonly/>
                        </div>
                        
                        </div>`;

                // Setting innerHTML as tab variable
                totalinput++;


                // console.log(json[key][0] + "  " + json[key][1]);
            }
        }

        tab += ` <input type="hidden" id="totalinputfild" name="totalinput" value="${totalinput}"/>
        <div id="dateinput"></div>`;

        let today = new Date();

        function sett() {
            // console.log('run');

            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();

            document.querySelector('#todayDate').innerHTML = today.toLocaleDateString("en-US", options);

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            formattedToday = yyyy + '-' + mm + '-' + dd;
            // console.log(formattedToday);

            document.getElementById('dateinput').innerHTML = ` <input type="text" class="visually-hidden" name="date" value="${formattedToday}"/>`;


        }
        const selectDate = document.querySelector('#date');

        function onnn() {
            // console.log(selectDate.value)
            const d = new Date(selectDate.value);

            today = d;
            sett();
        }
        document.getElementById("fild").innerHTML = tab
        sett();

        const checkout = document.querySelectorAll('.checkout00');

        function workinghoursdata(idd) {
            console.log(idd)
            const workingHour = document.getElementById(`workingHours${idd}`);
            const checkinTime = document.getElementById(`checkInTime${idd}`);
            const checkOutTime = document.getElementById(`${idd}`);
            // console.log(checkOutTime)

            // console.log(checkboxes)
            const ddd = new Date(checkinTime.value);
            const eee = new Date(formattedToday + " " + checkOutTime.value + ":00");

            let diff = eee - ddd;
            var hh = Math.floor(diff / 1000 / 60 / 60);
            if (hh < 10) {
                hh = ('0' + hh).slice(-2)
            }

            // console.log(hh);
            diff -= hh * 1000 * 60 * 60;
            var mm = Math.floor(diff / 1000 / 60);
            mm = ('0' + mm).slice(-2);


            const workinghours = hh + ":" + mm;
            console.log(workinghours);

            workingHour.value = workinghours;

        }
        // console.log(checkout);

        checkout.forEach((date) => {
            date.addEventListener('input', function() {
                const idd = this.id;
                workinghoursdata(idd);

            })
        })
        const checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', function() {

                const ideee = this.id;
                let checkboxId = ideee.slice(2);
                // console.log(check)
                const workingHours = document.getElementById(`${checkboxId}`);
                const empid = document.getElementById(`employeeId${checkboxId}`);
                const workinghour = document.getElementById(`workingHours${checkboxId}`);
                const checkin = document.getElementById(`checkInTime${checkboxId}`)
                // const totalinputfild = document.getElementById('totalinputfild');

                if (empid.hasAttribute('disabled')) {
                    checkin.removeAttribute("disabled");
                    empid.removeAttribute("disabled");
                    workingHours.removeAttribute("disabled");
                    workinghour.removeAttribute("disabled");
                    workinghoursdata(checkboxId);

                } else {
                    checkin.setAttribute('disabled', "")
                    empid.setAttribute('disabled', "")
                    workinghour.setAttribute('disabled', "")

                    workingHours.setAttribute('disabled', "")
                    // totalinput--;
                    // totalinputfild.value = totalinput;

                }

            })
        })

        function debounce(eventfunc, delay) {
            let timer;
            return function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    eventfunc.call(this);
                }, delay);
            };
        }

        let eventHandler = () => {
            // console.log(search.value);


            function convertToNumber(str) {
                return +str;
            }

            let stringValue = search.value;

            let numberValue = convertToNumber(stringValue);


            if (search.value == '') {
                console.log("empty")
                json.forEach((e) => {
                    let row = document.getElementById(`row${e[1]}`);
                    if (row.classList.contains('visually-hidden')) {
                        row.classList.remove("visually-hidden");
                    }

                })
            } else {


                if (isNaN(numberValue)) {
                    // console.log("Cannot convert the string to a number.");


                    json.forEach((e) => {
                        // if (e[6].includes(stringValue)) {
                        if (e[6].toLowerCase().includes(stringValue.toLowerCase())) {

                            let row = document.getElementById(`row${e[1]}`);

                            if (row.classList.contains('visually-hidden')) {
                                row.classList.remove("visually-hidden");
                            }
                            // console.log(`true ${numberValue} `)
                        } else {
                            let row = document.getElementById(`row${e[1]}`);
                            row.classList.add("visually-hidden");
                        }
                    })

                } else {
                    console.log(`Converted number`);
                    let text =  numberValue.toString();

                    json.forEach((e) => {
                        if (!e[1].includes(text)) {
                            let row = document.getElementById(`row${e[1]}`);
                            row.classList.add("visually-hidden");
                        } else {
                            let row = document.getElementById(`row${e[1]}`);

                            if (row.classList.contains('visually-hidden')) {
                                row.classList.remove("visually-hidden");
                            }
                            console.log(`true ${numberValue} `)
                        }
                    })
                }
            }
        }

        let search = document.querySelector('#search');
        search.addEventListener('input', debounce(eventHandler, 400));
    </script>
</body>

</html>