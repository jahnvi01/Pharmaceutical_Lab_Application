<?php
 
 include 'functions/crud.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <title></title>
</head>

<body>
<!-- 
header -->
    <div class="row">
      <div class="col-md-12 ">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="home.php">Dashboard</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="records.php">Records</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="history.php">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" a href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" a href="index.php?logout=1">Logout</a>
      </li>
    </ul>

  </div>
</nav>  
</div>
    
    </div>


<!-- 
order section -->



    <div class="row" style="justify-content:center;margin-top:20px">
    <div class="col-md-4 form-wrapper">
<div class="container">

<form action="" method="post">

<div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control form-control-lg"  placeholder="18"required>
          </div>
<div class="form-group">

            <label>Disease</label>
            <input type="text" name="disease" class="form-control form-control-lg" placeholder="Fever" required>
          </div>
          <div class="form-group">
            <label>Medicine</label>
            <input type="text" name="medicine" class="form-control form-control-lg" placeholder="Crocin" required>
          </div>
          <div class="form-group">
            <label>Allergy (If any)</label>
            <input type="text" name="allergy" class="form-control form-control-lg" placeholder="Itching" >
          </div>
          <div class="form-group">
            <label>Previous Illness</label>
            <input type="text" name="previous_illness" class="form-control form-control-lg" placeholder="Dengue" >
          </div>
          <div class="form-group">
            <label>Treatment days</label>
            <input type="number" name="treatment" class="form-control form-control-lg"  placeholder="2"required>
          </div>
          <div class="form-group">
            <button type="submit" name="add-record" class="btn btn-lg btn-block">Add-Record</button>
          </div>
</form>  
</div>

</div>



<div class="col-md-8">
<div class="container">
<h4 style="padding:20px">View And Update Medical Records</h4>
<form action="" method="post">
<table class="table">
  <thead>
    <tr>
    <th scope="col">Age</th>
      <th scope="col">Disease</th>
      <th scope="col">Medicine</th>
      <th scope="col">Allergy</th>
      <th scope="col">Previous Illness</th>
      <th scope="col">treatment</th>
      <th scope="col">Date</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
showRecords()
?>  
   
  </tbody>
</table>
</form>
</div>
</div>
</div> 
</body>

</html>