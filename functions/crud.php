<?php
include 'controllers/authController.php';
if(!$_SESSION['email']){
    header('location: login.php');  
}
global $conn;
$email=$_SESSION['email'];
$errors = [];

if(isset($_POST["send-code"]))
{
  $enteredNo = $_POST["contact"];
  $fullname = $_POST["fullname"];

  $details="SELECT * FROM users WHERE email='$email'";
   
  $result=mysqli_query($conn,$details);

 
  while($row=mysqli_fetch_array($result)){
  $contact=$row['contact'];
  $surname=$row["surname"];
  $username=$row["username"];
  $name=$username." ".$surname;
 
if($contact!==$enteredNo){
  $errors['number'] = 'Enter Correct Contact Number';
}
if($fullname!==$name){
  $errors['name'] = 'Enter Correct FullName';
}

if (sizeof($errors) === 0) {
$apiKey = urlencode('');
	
	
// Message details


$numbers = array($_POST["contact"]);
$sender = urlencode('TXTLCL');
$otp=mt_rand(10000,100000);
$message = rawurlencode("Enter". $otp."  OTP to verify your contact number");
setcookie('code',$otp);
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
//echo "$response";
// Process your response here
  }
  }
}

if(isset($_POST["verify-btn"]))
{
  $code=$_COOKIE['code'];
  if($code!==$_POST['otp']){
    $errors['otp-v'] = 'Enter Correct Code';
  }
  else{
    header("location:viewRecord.php");
  }
}



if(isset($_POST['add-prescription']))
{

    $disease=$_POST['disease'];
    $medicine=$_POST['medicine'];
    $dose=$_POST['dose'];
    $weight=$_POST['weight'];
    $days=$_POST["days"];
$insert="INSERT INTO prescription (disease,medicine,weight,dose,days,email) VALUES ('$disease','$medicine','$weight','$dose',$days,'$email')";
$run=mysqli_query($conn,$insert);
unset($_POST['add-prescription']);  
unset($_POST['disease']);
unset($_POST['medicine']);
unset($_POST['dose']);
unset($_POST['days']);
unset($_POST['weight']);  

}



if(isset($_POST['add-record']))
{
  $age=$_POST['age'];
    $disease=$_POST['disease'];
    $medicine=$_POST['medicine'];
    $allergy=$_POST['allergy'];
    $previous_illness=$_POST['previous_illness'];
    $treatment=$_POST['treatment'];
$insert="INSERT INTO records (age,email,disease,medicine,allergy,previous_illness,treatment) VALUES ('$age','$email','$disease','$medicine','$allergy','$previous_illness','$treatment')";
$run=mysqli_query($conn,$insert);
unset($_POST['add-record']);  
unset($_POST['disease']);
unset($_POST['medicine']);
unset($_POST['allergy']);
unset($_POST['treatment']);  
unset($_POST['age']); 
unset($_POST['previous_illness']); 
}

if(isset($_GET['del_id'])){
    global $conn;
    $email=$_SESSION['email']; 
    
$del_id=$_GET['del_id'];
 $query="DELETE FROM prescription WHERE presc_id='$del_id' AND email='$email' ";   
   $run=mysqli_query($conn,$query);
   header("location:viewRecord.php");
}


if(isset($_GET['delRec_id'])){
    global $conn;
    $email=$_SESSION['email']; 
    
$del_id=$_GET['delRec_id'];
 $query="DELETE FROM records WHERE record_id='$del_id' AND email='$email' ";   
   $run=mysqli_query($conn,$query);
   header("location:viewRecord.php");
}


function showPrescription(){
    global $conn;
    $email=$_SESSION['email'];
  

$get="SELECT * FROM prescription WHERE email='$email'";

    $run=mysqli_query($conn,$get);

   
    while($row=mysqli_fetch_array($run)){
       $disease=$row["disease"];
       $medicine=$row["medicine"];
       $weight=$row["weight"];
       $dose=$row["dose"];
       $date=$row["date"];
       $days=$row["days"];
       $id=$row["presc_id"];
echo"
<tr>
<th scope='row'>$disease</th>
<td>$medicine</td>
<td>$weight</td>
<td>$dose</td>
<td>$days</td>
<td>$date</td>
<td><a href='update_presc.php?presc_id=$id' style='text-decoration:none'>Yes</a></td>
<td><a href='records.php?del_id=$id' style='text-decoration:none'>yes</a></td>
</tr>

";
     
    }
 
}
function update(){
    global $conn;
    $email=$_SESSION['email'];
    
    if(isset($_GET['presc_id'])){
        $id=$_GET['presc_id'];
        
        $get="SELECT * FROM prescription WHERE email='$email' and presc_id='$id'";

    $run=mysqli_query($conn,$get);

   
    while($row=mysqli_fetch_array($run)){
        $disease=$row["disease"];
        $medicine=$row["medicine"];
        $weight=$row["weight"];
        $dose=$row["dose"];
        $days=$row["days"];

        echo "
        <div class='container'>

<form action='' method='post'>
<div class='form-group'>
            <label>Disease</label>
            <input type='text' name='disease' class='form-control form-control-lg' value=$disease required>
          </div>
          <div class='form-group'>
            <label>Medicine</label>
            <input type='text' name='medicine' class='form-control form-control-lg' value='$medicine' required>
          </div>
          <div class='form-group'>
            <label>Weight (Mg)</label>
            <input type='number' name='weight' class='form-control form-control-lg' value='$weight' required>
          </div>
          <div class='form-group'>
            <label>Dose</label>
            <input type='text' name='dose' class='form-control form-control-lg' value='$dose' required>
          </div>
          <div class='form-group'>
          <label>Days</label>
          <input type='number' name='days' class='form-control form-control-lg' value='$days' required>
        </div>
          <div class='form-group'>
            <button type='submit' name='update-prescription' class='btn btn-lg btn-block'>Update</button>
          </div>

</div>
</form>  
</div>
        ";
    }
 

        }
        if(isset($_POST['update-prescription'])){
            global $conn;
            $email=$_SESSION['email'];  

                
            $disease1=$_POST['disease'];
        $medicine1=$_POST['medicine'];
        $dose1=$_POST['dose'];
        $days1=$_POST['days'];
              $weight1=$_POST['weight'];  
        $query="UPDATE prescription SET disease='$disease1',medicine='$medicine1', dose='$dose1',days='$days1' , weight='$weight1' WHERE presc_id='$id' AND email='$email' ";   
     
        $run=mysqli_query($conn,$query);
       header("location:records.php");
        }

   
}



//////



function showRecords(){
    global $conn;
    $email=$_SESSION['email'];
  

$get="SELECT * FROM records WHERE email='$email'";

    $run=mysqli_query($conn,$get);

   
    while($row=mysqli_fetch_array($run)){
      $age=$row["age"];
       $disease=$row["disease"];
       $medicine=$row["medicine"];
       $allergy=$row["allergy"];
       $previous_illness=$row["previous_illness"];
       $treatment=$row["treatment"];
       $date=$row["record_date"];
       $r_id=$row["record_id"];

echo"
<tr>
<th scope='row'>$age</th>
<td>$disease</td>
<td>$medicine</td>
<td>$allergy</td>
<td>$previous_illness</td>
<td>$treatment</td>
<td>$date</td>
<td><a href='update_record.php?record_id=$r_id' style='text-decoration:none'>Yes</a></td>
<td><a href='records.php?delRec_id=$r_id' style='text-decoration:none'>Yes</a></td>
</tr>

";
     
    }
 
}
function updateRecord(){
    global $conn;
    $email=$_SESSION['email'];
    
    if(isset($_GET['record_id'])){
        $id=$_GET['record_id'];
        
        $get="SELECT * FROM records WHERE email='$email'";

    $run=mysqli_query($conn,$get);

   
    while($row=mysqli_fetch_array($run)){
      $age=$row["age"];
      $previous_illness=$row["previous_illness"];
        $disease=$row["disease"];
        $medicine=$row["medicine"];
        $allergy=$row["allergy"];
        $treatment=$row["treatment"];

        echo "
        <div class='container'>

<form action='' method='post'>
<div class='form-group'>
            <label>Age</label>
            <input type='number' name='age' class='form-control form-control-lg' value=$age required>
          </div>
<div class='form-group'>
            <label>Disease</label>
            <input type='text' name='disease' class='form-control form-control-lg' value=$disease required>
          </div>
          <div class='form-group'>
            <label>Medicine</label>
            <input type='text' name='medicine' class='form-control form-control-lg' value='$medicine' required>
          </div>
          <div class='form-group'>
            <label>Allergy</label>
            <input type='text' name='allergy' class='form-control form-control-lg' value='$allergy' >
          </div>

          <div class='form-group'>
          <label>Previous_illness</label>
          <input type='text' name='previous_illness' class='form-control form-control-lg' value='$previous_illness' >
        </div>

          <div class='form-group'>
            <label>Treatment Days</label>
            <input type='number' name='treatment' class='form-control form-control-lg' value='$treatment' required>
          </div>
          <div class='form-group'>
            <button type='submit' name='update-record' class='btn btn-lg btn-block'>Update</button>
          </div>

</div>
</form>  
</div>
        ";
    }
 

        }
        if(isset($_POST['update-record'])){
            global $conn;
            $email=$_SESSION['email'];  

               $age1=$_POST["age"]; 
            $disease1=$_POST['disease'];
        $medicine1=$_POST['medicine'];
        $allergy1=$_POST['allergy'];
        $previous_illness1=$_POST['previous_illness'];
              $treatment1=$_POST['treatment'];  
        $query="UPDATE records SET age='$age1',disease='$disease1',medicine='$medicine1', allergy='$allergy1' ,previous_illness='$previous_illness1', treatment='$treatment1' WHERE record_id='$id' AND email='$email' ";   
        // echo"<script>alert('$query')</script>";
        $run=mysqli_query($conn,$query);
       header("location:viewRecord.php");
        }
    
}
