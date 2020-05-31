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
            <label>Disease</label>
            <input type="text" name="disease" class="form-control form-control-lg" placeholder="Fever" required>
          </div>
          <div class="form-group">
            <label>Medicine</label>
            <input type="text" name="medicine" class="form-control form-control-lg" placeholder="Crocin" required>
          </div>
          <div class="form-group">
            <label>Weight (Mg)</label>
            <input type="number" name="weight" class="form-control form-control-lg" placeholder="250" required>
          </div>
          <div class="form-group">
            <label>Dose</label>
            <input type="text" name="dose" class="form-control form-control-lg" placeholder="Morning-1 Evening-1" required>
          </div>
          <div class="form-group">
            <label>Days</label>
            <input type="number" name="days" class="form-control form-control-lg" placeholder="2" required>
          </div>
          <div class="form-group">
            <button type="submit" name="add-prescription" class="btn btn-lg btn-block">Add</button>
          </div>
</form>  
</div>

</div>
<div class="col-md-7">
<div class="container">
<h4 style="padding:20px">View And Update Prescription</h4>
<form action="" method="post">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Disease</th>
      <th scope="col">Medicine</th>
      <th scope="col">Weight</th>
      <th scope="col">Dose</th>
      <th scope="col">Days</th>
      <th scope="col">Date</th>
      <th scope="col">update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
showPrescription()
?> 
   
  </tbody>
</table>
</form>
</div>
</div>

    </div>








    <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper login">
        <h3 class="text-center form-title">Authorisation Access To Your Medical History</h3>
        <?php if (sizeof($errors) > 0): ?>
        <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <li>
            <?php echo $error; ?>
          </li>
          <?php endforeach;?>
        </div>
        <?php endif;?>

        <form action="records.php" method="post">
          <div class="form-group">
            <label>Full name</label>
            <input type="text" name="fullname" class="form-control form-control-lg"  value="<?php echo $_POST["fullname"] ?>" required>
          </div>
          <div class="form-group">
            <label>Provided Contact Number</label>
            <input type="number" name="contact" class="form-control form-control-lg"  value="<?php echo $_POST["contact"] ?>" required>
          </div>
          <div class="form-group">
            <button type="submit" name="send-code" class="btn btn-lg btn-block">Send Code</button>
          </div>
          <div class="form-group">
            <label>Aceess Code</label>
            <input type="number" name="otp" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="verify-btn" class="btn btn-lg btn-block">Access</button>
          </div>
        </form>
   
      </div>
    </div>
  </div>









<!-- 

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



<div class="col-md-7">
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
</div> -->
</body>

</html>