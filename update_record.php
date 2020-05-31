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

<div class="col-md-6 offset-md-3 form-wrapper">
<?php
updateRecord();
?>








    </div>

</body>

</html>