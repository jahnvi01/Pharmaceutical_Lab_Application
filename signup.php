<?php include_once 'controllers/authController.php'?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <title>User verification system PHP</title>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper">
        <h3 class="text-center form-title">Register</h3>

        <?php if (sizeof($errors) > 0): ?>
          <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
            <li>
              <?php echo $error; ?>
            </li>
            <?php endforeach;?>
          </div>
        <?php endif;?>

        <form action="signup.php" method="post">
        <div class="form-group">
            <label>Contact Number</label>
            <input type="number" name="contact" class="form-control form-control-lg" value="<?php echo $_POST["contact"] ?>">
          </div>

          <div class="form-group">
            <button type="submit" name="send-otp" class="btn btn-lg btn-block">Send Access Code</button>
          </div>


          <div class="form-group">
            <label>Access Code</label>
            <input type="number" name="otp" class="form-control form-control-lg" value="<?php echo $_POST["otp"] ?>">
          </div>

          <div style="display:flex">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $_POST["username"] ?>">
          </div>
          <div class="form-group">
            <label>Surname</label>
            <input type="text" name="surname" class="form-control form-control-lg" value="<?php echo $_POST["surname"] ?>">
          </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $_POST["email"] ?>">
          </div>
<div style="display:flex">
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control form-control-lg" value="<?php echo $_POST["address"] ?>">
          </div>
          <div class="form-group">
            <label>Postcode</label>
            <input type="text" name="postcode" class="form-control form-control-lg" value="<?php echo $_POST["postcode"] ?>">
          </div>
          </div>
          <div class="form-group">
            <label>Date Of Birth</label>
            <input type="date" name="birthdate" class="form-control form-control-lg" value="<?php echo $_POST["birthdate"] ?>">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <label>Password Confirm</label>
            <input type="password" name="passwordConf" class="form-control form-control-lg">
          </div>
         
          <div class="form-group" style="display:flex;align-items: baseline">
         
          <input type="checkbox" name="term" value='1'>
             <label> Agree to terms and conditions</label>
         
          </div>
          <div class="form-group">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Sign Up</button>
          </div>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
</body>

</html>