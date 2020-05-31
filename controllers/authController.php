<?php
require_once 'config/db.php';
require_once 'emailController.php';
global $conn;
$username = "";
$email = "";
$errors = [];
$cookieotp=$_COOKIE['otp']|| "";
// SIGN UP USER


if(isset($_POST["send-otp"]))
{
  //  $username = "bndalwadi26@gmail.com";
// 	$hash = "ffc2f4e5cd305dd611929ead7a6feb34689c070175843622e74ef3ae6813a80c";

// 	// Config variables. Consult http://api.txtlocal.com/docs for more info.
// 	$test = "0";
// $name=$_POST["username"];

// $otp=mt_rand(10000,100000);
// 	// Data for text message. This is the text message data.
// 	$sender = "API Test"; // This is who the message appears to be from.
// 	$numbers = $_POST["contact"]; // A single number or a comma-seperated list of numbers
// 	$message = "Enter". $otp."  OTP to verify your contact number";
// 	// 612 chars or less
//     // A single number or a comma-seperated list of numbers
//     setcookie('otp',$otp);
// 	$message = urlencode($message);
// 	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
// 	$ch = curl_init('http://api.txtlocal.com/send/?');
// 	//curl_setopt($ch, CURLOPT_POST, true);
// 	//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// 	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    // $result = curl_exec($ch); // This is the result from the API
//     echo "<script>alert('$numbers')</script>";
// 	curl_close($ch);



$apiKey = urlencode('OofW+PcExAw-9LYehR9z5xBA6MEdYYavLustvtajHb');
	
	
// Message details

$numbers = array($_POST["contact"]);

$sender = urlencode('TXTLCL');
$otp=mt_rand(10000,100000);
$message = rawurlencode("Enter". $otp."  OTP to verify your contact number");
setcookie('otp',$otp);
//echo "<script>alert('$otp')</script>";
$numbers = implode(',', $numbers);

// Prepare data for POST request
$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

//Send the POST request with cURL
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Process your response here


}


if (isset($_POST['signup-btn'])) {
    $cookieotp=$_COOKIE['otp'];
    $newotp=$_POST['otp'];

    if (empty($_POST['surname'])) {
        $errors['surname'] = 'surname required';
    }

    if (empty($_POST['address'])) {
        $errors['address'] = 'address required';
    }
    if (empty($_POST['postcode']) || strlen($_POST['postcode'])<6) {
        $errors['postcode'] = 'Postcode required and having at least 6 characters';
    }

    if (empty($_POST['birthdate'])) {
        $errors['birthdate'] = 'birthdate required';
    }

    if (empty($_POST['contact'])) {
        $errors['contact'] = 'contact required';
    }
    
    if (!isset($_POST['term']) && $_POST['term']!=='1') {
        $errors['term'] = 'Agree to terms and conditions';
    }
    

    if (empty($_POST['otp'])) {
        $errors['OTP'] = 'OTP required';
    }
    if ($newotp!==$cookieotp) {
        $errors['OTP-valid'] = 'OTP not valid';
    }
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username required';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Invalid email address";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'The two passwords do not match';
    }
    $password=$_POST['password'];
    $number    = preg_match('@[0-9]@', $password);

    if(!$number ||  strlen($password) < 8) {
        $errors['password-valid'] = 'include min 8 characters and number';
    }
$contact=$_POST['contact'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $postcode = $_POST['postcode'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
   //$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
 //  echo "<script>alert($sql)</script>";
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");

    if (mysqli_num_rows($result) > 0) {
        
        $errors['email'] = "Email already exists";
    }
  if (sizeof($errors) === 0) {
  $insert="INSERT INTO users (username,contact,email,verified,token,password) VALUES ('$username','$contact','$email','1','$token','$password')";
    echo "<script>alert('$insert')</script>";

   $run=mysqli_query($conn,"INSERT INTO users (username,surname,contact,email,address,postcode,birthdate,verified,token,password) VALUES ('$username','$surname','$contact','$email','$address','$postcode','$birthdate','1','$token','$password')");

      
       if ($run) {
     
         //   $user_id = $stmt->insert_id;
  
           
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = 0;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location: home.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
     }
}

// LOGIN
if (isset($_POST['login-btn'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username or email required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password required';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];



    if (sizeof($errors) === 0) {
        $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: home.php');
                exit(0);
            } else { // if password does not match
                $errors['login_fail'] = "Wrong username / password";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }

}

 
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verify']);
    header("location: login.php");
    exit(0);
}

if(isset($_POST['continue'])){
    echo "<script>alert('continue'); </script>";
   // header("location:home.php");
}

 if(isset($_POST['checkout'])){

    header("location:home.php");
 } 


function products(){
    global $conn;
   

    // $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {
    //   echo"Email already exists";
    // }
    if(!isset($_GET['search'])){

$get_products="SELECT * FROM products";

    $run=mysqli_query($conn,$get_products);

   
    while($row=mysqli_fetch_array($run)){
        $pro_id=$row['pro_id'];
        $pro_title=$row['pro_name'];
        $pro_price=$row['pro_price'];
        $pro_image=$row['pro_image'];
        $pro_keyword=$row['pro_keyword'];
    
   
echo"
<div class='col-md-3 card card-cascade card-ecommerce narrower' style='margin:15px'>


  <div class='view view-cascade overlay'>
    <img class='card-img-top' src='images/$pro_image'
      alt=''>
    <a>
      <div class='mask rgba-white-slight'></div>
    </a>
  </div>

  <div class='card-body card-body-cascade text-center'>

    
    <h4 class='card-title'><strong>$pro_title</strong></h4>


    <div class='card-footer'>
      <span class='float-left'>$pro_price £</span>
      <span class='float-right'>
        <a href='home.php?pro_id=$pro_id' data-toggle='tooltip' data-placement='top' title='Add to Cart'><button type='button' class='btn btn-light' style='border:1px solid black'>Add To Cart</button></a>
      </span>
    </div>

  </div>
 

</div>
";


    }
    }
}

function addcart(){
    global $conn;

        if(isset($_GET['pro_id'])){
            if(!$_SESSION['email']){
                header('location: login.php');  
            }
            $email=$_SESSION['email'];
    $id=$_GET['pro_id'];
    $check="SELECT * FROM cart WHERE email='$email' AND cart_id='$id'";
    $run=mysqli_query($conn,$check);
    if(mysqli_num_rows($run)>0){
        echo "<script>alert('Already in the cart') </script>";
    }
    else{
       // echo "<script>alert('$email') </script>";
// $insert="INSERT INTO cart (cart_id,email,quantity) VALUES ('$id','$email','1')";
    $run=mysqli_query($conn,"INSERT INTO cart (cart_id,email,quantity) VALUES ('$id','$email','1')");
    echo "<script>alert('Product added to cart') </script>";
    }
    
    }
    
    }










function searchproducts(){

    global $conn;
if(isset($_GET['search'])){
    $pro=$_GET['user_query'];
    $get_products="SELECT * FROM products WHERE pro_keyword LIKE '%$pro%'";
    $run=mysqli_query($conn,$get_products);
    while($row=mysqli_fetch_array($run)){
        $pro_id=$row['pro_id'];
        $pro_title=$row['pro_name'];
        $pro_price=$row['pro_price'];
        $pro_image=$row['pro_image'];
        $pro_keyword=$row['pro_keyword'];
    
   
echo"
<div class='col-md-3 card card-cascade card-ecommerce narrower' style='margin:15px'>


  <div class='view view-cascade overlay'>
    <img class='card-img-top' src='images/$pro_image'
      alt=''>
    <a>
      <div class='mask rgba-white-slight'></div>
    </a>
  </div>

  <div class='card-body card-body-cascade text-center'>

    
    <h4 class='card-title'><strong>$pro_title</strong></h4>


    <div class='card-footer'>
      <span class='float-left'>$pro_price £</span>
      <span class='float-right'>
        <a href='home.php?pro_id=$pro_id' data-toggle='tooltip' data-placement='top' title='Add to Cart'><button type='button' class='btn btn-light' style='border:1px solid black'>Add To Cart</button></a>
      </span>
    </div>

  </div>
 

</div>
";
    }
    }
}


