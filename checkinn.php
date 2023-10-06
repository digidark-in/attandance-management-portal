<?php

include './connection.php';


// $sql1 = "SELECT * FROM dailyattendance WHERE emplyeeId ==";

$sql = "SELECT `employeeId` , `name`
FROM employee 
WHERE onsite = 0 AND active = 1;";

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

        
        <!-- <div class="mb-3 col-2"> -->
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
        <div class="row"><h3 id="checked" class="text-warning"></h3></div>
        <form method="post" action="./backend/checkinbd.php">
            <div class="row">

                <div class="mb-3 col-1">
                    <H4>Emplyee ID</H4>
                </div>
                <div class="mb-3 col-3">
                    <H4 class="mx-2">Name</H4>
                </div>
                <div class="mb-3 col-2 ">
                    <H4 style="    margin-left: 29px;">Absent</H4>
                </div>
                <div class="mb-3 col-3">
                    <H4>CheckIN Time</H4>
                </div>
                <div class="mb-3 col-3">
                    <H4>approded by</H4>
                </div>
            </div>
            
            <div id="fild">
                
                
                </div>
                
                <button type="submit" id="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
        
        
        <!-- End Example Code -->
        <script>
            let totalinput = 0;
            let tab = "";
            var json = <?= $json ?>;
            // console.log(json)
            // let search = document.querySelector('#search');
        //     const  = new Date()
        // year = today.getFullYear();
        // month = today.getMonth() + 1;

        // selectDate.setAttribute('max', `${year+'-'+month}`)
            
            const checked = document.getElementById('checked');
            
            for (const key in json) {
                if (json.hasOwnProperty(key)) {
                    //   console.log(json[key] + " hh ") ;
                
                tab += `<div class="row" id="row${json[key][0]}">

                        <div class="mb-3 col-1">
                        
                            <input type="number" class="form-control " id="employeeId${json[key][0]}" name="${totalinput}" aria-describedby="emailHelp" value="${json[key][0]}"  readonly />
                        </div>
                        <div class="mb-3 col-3">

                            <input type="text" class="form-control" id="employeeName employeeName${json[key][0]}" aria-describedby="emailHelp" value="${json[key][1]}"  disabled />

                        </div>

                        
                        <div class="mb-3 col-2 mt-2">
                        <div class="form-check checkbox-xl">
                        <input class="form-check-input" type="checkbox" name="absent${json[key][0]}" id="${json[key][0]}" style="margin-left: 19px;" checked>
                        <label class="form-check-label" for="${json[key][0]}" style="  margin-top: -29px;">
                        absent
                        </label>
                        </div>
                        </div>


                        <div class="mb-3 col-3">
                            <input type="time" class="form-control" name="checkInTime${json[key][0]}"  id="checkInTime${json[key][0]}" value=09:00 aria-describedby="emailHelp" disabled/>
                        </div>
                        <div class="mb-3 col-3">
                            <input type="text" class="form-control" id="approved${json[key][0]}" aria-describedby="emailHelp" name="approved${json[key][0]}" value="none"  />
                        </div>
                        </div>
                       `;

                // Setting innerHTML as tab variable
                totalinput++;
                // checked.innerText = totalinput;



                // console.log(json[key][0] + "  " + json[key][1]);
            }
        }

        function getformatedtime() {
            var currentDate = new Date();

            // Get year, month, and day
            let year = currentDate.getFullYear();
            let month = String(currentDate.getMonth() + 1).padStart(2, '0');
            let day = String(currentDate.getDate()).padStart(2, '0');

            // Get hours, minutes, and seconds
            let hours = String(currentDate.getHours()).padStart(2, '0');
            let minutes = String(currentDate.getMinutes()).padStart(2, '0');
            let seconds = String(currentDate.getSeconds()).padStart(2, '0');

            // Format the date and time
            let formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

            return formattedDateTime;
        }


        tab += ` <input type="hidden" name="totalinput" value="${totalinput}"/> 
         <input type="text" class="visually-hidden" name="today" value="${getformatedtime()}"/>
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

            const formattedToday = yyyy + '-' + mm + '-' + dd;
            // console.log(formattedToday);

            document.getElementById('dateinput').innerHTML = ` <input type="text" class="visually-hidden" name="date" value="${formattedToday}"/>`;


        }
        const selectDate = document.querySelector('#date');

        function onnn() {
            // console.log(selectDate.value)
            const d = new Date(selectDate.value);

            today = d;
            sett();
            // console.log(today)



            // document.querySelector('#todayDate').innerHTML =  d.toLocaleDateString("en-US", options);
        }



        document.getElementById("fild").innerHTML = tab

        const checkboxes = document.querySelectorAll('.form-check-input');





        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', function() {
                // Get the ID of the clicked checkbox
                const checkboxId = this.id;
                const approved = document.getElementById(`approved${checkboxId}`);
                const checkin = document.getElementById(`checkInTime${checkboxId}`)
                if (approved.hasAttribute('disabled')) {
                    approved.removeAttribute("disabled");
                    checkin.setAttribute('disabled', "")

                } else {
                    checkin.removeAttribute("disabled");
                    approved.setAttribute('disabled', "")
                }
                // console.log(checkboxId)

            })
        })
        sett();

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
                // console.log("empty")
                json.forEach((e) => {
                    let row = document.getElementById(`row${e[0]}`);
                    if (row.classList.contains('visually-hidden')) {
                        row.classList.remove("visually-hidden");
                    }

                })
            }else{

                
                if (isNaN(numberValue)) {
                    
                    
                    json.forEach((e) => {
                        // get1.toLowerCase().includes(get2.toLowerCase())
                        if (e[1].toLowerCase().includes(stringValue.toLowerCase())) {
                            
                            let row = document.getElementById(`row${e[0]}`);
                            
                            if (row.classList.contains('visually-hidden')) {
                                row.classList.remove("visually-hidden");
                            }
                            // console.log(`true ${numberValue} `)
                        } else {
                            let row = document.getElementById(`row${e[0]}`);
                            row.classList.add("visually-hidden");
                        }
                    })

                    
                    
                    
                } else {
                    // console.log(`Converted number`);
                    let text =  numberValue.toString();
                    
                    json.forEach((e) => {
                        // if (numberValue != e[0]) {
                        if (!e[0].includes(text)) {
                            // console.log('hii')
                            let row = document.getElementById(`row${e[0]}`);
                            row.classList.add("visually-hidden");
                        } else {
                            let row = document.getElementById(`row${e[0]}`);
                            
                            if (row.classList.contains('visually-hidden')) {
                                row.classList.remove("visually-hidden");
                            }
                            // console.log(`true ${numberValue} `)
                        }
                    })
                }
            }
        }

        search.addEventListener('input', debounce(eventHandler, 200));
    </script>
</body>

</html>