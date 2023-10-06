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
        body {
            background-color: #f6f6f6;
        }
        th {
            min-width: 100px;
        }
        td{
            font-size: 17px;
            font-weight: 600;
        }
        a{
            text-decoration: none;
            color: yellow;
        }
    </style>
</head>

<body >

    <div class="container">

        <h2 class="text-center mt-5">Attendace table</h2>
        <h1 class=" text-center text-danger " id="todayDate">
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
                <div class="col-4 m-3">

                    <input type="month" class="form-control border-dark border-2" id="date" aria-describedby="emailHelp" min="2023-08" max="" onchange="onnn()" />
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">

        <div class="row justify-content-center">

        </div>
        <div class="row">
            <div class="col-md-12"  style="background: #c5c5c5;
    border-radius: 29px;">
                <div class="table-wrap">
                    <table class="table table-striped table-responsive-xl my-5 table-dark">
                        <thead>
                            <tr id="header" class="text-center ">


                            </tr>
                        </thead>
                        <tbody id="table" class="text-center">



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        let json = [];
        let today = new Date();
        let totaldays;

        const selectDate = document.querySelector('#date');

        year = today.getFullYear();
        month = today.getMonth() + 1;

        selectDate.setAttribute('max', `${year+'-'+month}`)
        // selectDate = today;


        sett();



        function show() {
            let headerInner = '<th>ID</th> <th style="min-width: 200px;">Name</th>';

            // let lastMonthDays =  today.getDate();

            const month = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];

            // const d = new Date();
            let name = month[today.getMonth()];
            for (let i = 1; i <= totaldays; i++) {
                headerInner += ` <th>${i}-${name}</th>`;
            }

            headerInner += '<th>Total Hours</th>';

            let header = document.getElementById('header');
            header.innerHTML = headerInner;

            let table = document.getElementById('table');
            let tableData = '';


            // Extract unique employees based on ID
            let uniqueEmployees = [...new Set(json.map(item => item[1]))];
            uniqueEmployees.sort((a, b) => a - b);

            for (let employeeId of uniqueEmployees) {
                let employeeName = json.find(item => item[1] === employeeId)[6];
                let rowData = `<tr  id="row${employeeId}" role="alert"><td>${employeeId}</td><td> <a href="./emptable.php?empid=${employeeId}">${employeeName}</a></td>`;

                let totalHours = 0;
                // Loop through dates 1 to 31 and find corresponding working hours for the employee
                for (let i = 1; i <= totaldays; i++) {
                    // who alreday checkout
                    // let workingHours = json.find(item => item[1] === employeeId && item[3] != null && item[0].endsWith(`${i}`));
                    if (i < 10) {
                        i = "0" + i;
                    }
                    let workingHours = json.filter(item => item[1] === employeeId && item[3] != null && item[0].endsWith(`${i}`));
                    // console.log(workingHours, i);       

                    // for getting approved by 
                    let entry = json.find(item => item[1] === employeeId && item[3] == null && item[0].endsWith(`${i}`));



                    if (workingHours.length > 0) {
                        let workingHoursDisplay = workingHours[0][5];
                        let dayTotalHours = 0;
                        let show = false;

                        for (let entry of workingHours) {
                            if (entry[5] !== null) {
                                let hoursMinutes = entry[5].split(':');
                                let minfirst = parseInt(hoursMinutes[0]) * 60 + parseInt(hoursMinutes[1]);
                                // hoursfirst =  hoursfirst.toFixed(2);

                                dayTotalHours += minfirst;
                                // console.log(dayTotalHours)
                            } else {
                                rowData += `<td class="text-dark bg-warning">onsite</td>`;
                                show = true;
                            }
                        }

                        // Add the day's total working hours to the employee's total hours
                        totalHours += dayTotalHours;

                        if (!show) {
                            let hour = Math.floor(dayTotalHours / 60);
                            let min = dayTotalHours % 60;
                            if (hour < 10) {
                                hour = "0" + hour;
                            }
                            if (min < 10) {
                                min = "0" + min;
                            }
                            // console.log(hour , min)
                            rowData += `<td class="text-success">${hour+":"+min}</td>`;
                            // let hoursMinutes = workingHoursDisplay.split(':');
                            // totalHours += parseInt(hoursMinutes[0]) + parseInt(hoursMinutes[1]) / 60;

                            // totalHours += parseInt(hoursMinutes[0]) + parseInt(hoursMinutes[1]) / 60;
                        }
                    } else if (entry) {

                        rowData += `<td class="text-danger">${entry[7]}</td>`;
                    } else {
                        rowData += `<td class="text-danger">-</td>`;
                        workingHoursDisplay = '-';
                    }
                    // rowData += `<td>${workingHoursDisplay}</td>`;


                }
                headerInner += '<th>Total Hours</th>';
                rowData += `<td>${(totalHours/60).toFixed(2)}</td>`;

                rowData += '</tr>';
                tableData += rowData;
            }
            table.innerHTML = tableData;

        }

        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }


        function sett(date = "") {
            let options = {
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
            getjson(month, year);


        }

        function getjson(month, year) {

            const dataToSend = {
                "month": month,
                "year": year,
            };

            fetch('./backend/tableget.php', {
                    "method": 'POST',
                    "headers": {
                        'Content-Type': 'application/json'
                    },
                    "body": JSON.stringify(dataToSend)
                })
                .then(response => response.json())
                .then(responseData => {
                    // console.log(responseData.length);
                    if (responseData.length > 0) {

                        json = responseData;
                        show();
                    } else {
                        document.getElementById('table').innerHTML = '<h1 class="text-center text-danger">No Data Found</h1>';
                    }
                    // // console.log(responseData);
                    // json = responseData;
                    // show();
                })
                .catch(error => {
                    console.error('Error:', error);

                });


        }

        function onnn() {

            const d = new Date(selectDate.value);

            today = d;
            sett(selectDate.value);
            // console.log(today)

        }

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
                    let row = document.getElementById(`row${e[1]}`);
                    if (row.classList.contains('visually-hidden')) {
                        row.classList.remove("visually-hidden");
                    }

                })
            } else {


                if (isNaN(numberValue)) {
                    // console.log("Cannot convert the string to a number.");


                    json.forEach((e) => {
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
                    // console.log(`Converted number`);
                    let text = numberValue.toString();

                    json.forEach((e) => {
                        if (!e[1].includes(text)) {
                            let row = document.getElementById(`row${e[1]}`);
                            row.classList.add("visually-hidden");
                        } else {
                            let row = document.getElementById(`row${e[1]}`);

                            if (row.classList.contains('visually-hidden')) {
                                row.classList.remove("visually-hidden");
                            }
                            // console.log(`true ${numberValue} `)
                        }
                    })
                }
            }
        }

        let search = document.querySelector('#search');
        search.addEventListener('input', debounce(eventHandler, 800));
    </script>

</body>


</html>