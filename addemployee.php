<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body >
    <div class="container " >

    <h2 class="text-center mt-5">Enter details of Employee </h2>
 
    <form class="row g-3 mt-5 text fs-5 fw-bolder" method="post" action="./backend/addEmployee.php">
  <div class="col-md-12">
    <label for="inputEmail4" class="form-label">Full Name</label>
    <input type="text" name="name" class="form-control border-dark border-2" id="inputEmail4" placeholder="Name" required>
  </div>
  <div class="col-md-12">
    <label for="inputPassword4" class="form-label">Phone No</label>
    <input type="number" class="form-control border-dark border-2" name="phoneNO" id="inputPassword4" required>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control border-dark border-2" id="inputAddress" placeholder="1234 Main St" name="address" required>
  </div>
  
  <div class="col-md-4">
    <label for="inputCity" class="form-label">Joining Date</label>
    <input type="date" class="form-control border-dark border-2" id="joingDate" name="joiningDate" required>
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Gender</label>
    <select id="inputState" class="form-select border-dark border-2" name="gender" required>
      <option selected
      >Choose...</option>
      <option value="1">Male</option>
      <option value="0">Female</option>
    </select>
  </div>
  <div class="col-md-4">
    <label for="inputZip" class="form-label">Salary</label>
    <input name="salary" type="number" class="form-control border-dark border-2" required  id="inputZip">
  </div>
  <div class="col-12">
    <!-- <div class="form-check">
      <input class="form-check-input border-dark border-2" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div> -->
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Regester Employee</button>
  </div>
</form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>