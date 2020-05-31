
<?php
include 'controllers/authController.php';
if(!$_SESSION['email'] || $_SESSION['verified']==0){
    header('location: login.php');  
}



    function showcart(){
      
        $x=0;
        $i=0;
        $total_item=0;
        $total_price=0;
        $idd=array();
        $qty=array();
        $email=$_SESSION['email'];  
   
            global $conn;
            $check="SELECT * FROM cart WHERE email='$email'";
            $run=mysqli_query($conn,$check);
            while($row=mysqli_fetch_array($run)){
                $id=$row['cart_id'];
            $idd[$i]=$id;
          
            $qty=$row['quantity'];
      
            $total_item=$qty+$total_item;
                $singleprize="SELECT * FROM products WHERE pro_id='$id'";
                $result=mysqli_query($conn,$singleprize);
                while($rw=mysqli_fetch_array($result)){
                   $pro_title=$rw["pro_name"];
                   $p=$rw['pro_price'];
                    $price=$rw['pro_price']*$qty;
                    $total_price=$price+$total_price;
                    $pic=$rw['pro_image']; 
        
echo "

<tr>
  <th scope='row'>
    <img width='200' height='200' src='images/$pic' alt='' class='img-fluid z-depth-0'>
  </th>
  <td>
    <h5 class='mt-3'>
      <strong>$pro_title</strong>
    </h5>
    
  </td>
 <td></td>
  <td>$p</td>
  <td>
    <input type='number'  value='$qty' name='qty[]' aria-label='Search' class='form-control' style='width: 100px'>
  </td>
  <td class='font-weight-bold'>
    <strong>$price</strong>
  </td>
  <td>
  <input type='checkbox' name='remove[]' value='$id'>
  </td>
</tr>



";
                          }

          
         $i++;
           }
        
           echo "<div >
           <h4 class='bill'>Total Items: $total_item </h4>
           <h4 class='bill'>Total Bill:  $total_price £</h4>
           </div>";


           if(isset($_POST['continue'])){
            header("location:home.php");
        }
        
         if(isset($_POST['checkout'])){
            $email=$_SESSION['email'];  
   
            global $conn;
        
              $cart="SELECT * FROM cart WHERE email='$email'";
            //   echo "<script>alert($cart) </script>";
            $run=mysqli_query($conn,$cart);
            while($row=mysqli_fetch_array($run)){
                $id=$row['cart_id'];
                $qt=$row['quantity'];
                // echo "<script>alert($qt) </script>";
                $product="SELECT * FROM products WHERE pro_id='$id'";
                $run1=mysqli_query($conn,$product);
                while($row1=mysqli_fetch_array($run1)){
                    $p=$row1['pro_price'];
                    $amount=$p*$qt;
                    echo "<script>alert($amount) </script>";
               $insert="INSERT INTO orders (order_id,email,quantity,amount) VALUES ('$id','$email','$qt','$amount')";
                $run2=mysqli_query($conn,$insert);
               
            }
        }
        header("location:history.php");
         }  
        
         
         if(isset($_POST['update'])){

        
             foreach($_POST['remove'] as $remove){
            
             $del="DELETE FROM cart WHERE cart_id='$remove' AND email='$email'";
             $run=mysqli_query($conn,$del);
             
             }
        
            foreach($_POST['qty'] as $qty){
                
        $qnt[$x]=$qty;
        
        $x++;    
        }
        for($i=0;$i<=$x;$i++){
        
         $quantity="UPDATE cart SET quantity='$qnt[$i]'  WHERE cart_id='$idd[$i]' AND email='$email' ";   
         $run=mysqli_query($conn,$quantity);
        
        }     
       
     header("location:cart.php");
   
                
 }


        
        }
        
       function showhistory(){
        global $conn;
   
        $email=$_SESSION['email'];
      
    
    $get_orders="SELECT * FROM orders WHERE email='$email'";
    
        $run=mysqli_query($conn,$get_orders);
    
       
        while($row=mysqli_fetch_array($run)){
            $order_id=$row['order_id'];
      
            $amount=$row['amount'];
            $quantity=$row['quantity'];
            $date=$row['order_date'];
        
            $get_details="SELECT * FROM products WHERE pro_id='$order_id'";
    
            $result=mysqli_query($conn,$get_details);
        
           
            while($row1=mysqli_fetch_array($result)){
                $name=$row1["pro_name"];
                $price=$row1["pro_price"];
  echo"
  <tr>
  <th scope='row'>$name</th>
  <td>$quantity</td>
  <td>$price</td>
  <td>$amount</td>
  <td>$date</td>
</tr>
  
  ";  
            }
        }
     

       }

       function user(){

        global $conn;
        $email=$_SESSION['email'];
        $username=$_SESSION['username'];
        $details="SELECT * FROM users WHERE email='$email'";
   
        $result=mysqli_query($conn,$details);
    
       
        while($row=mysqli_fetch_array($result)){
        $contact=$row['contact'];
        $surname=$row["surname"];
        $address=$row["address"];
        $birthdate=$row["birthdate"];
        $postcode=$row["postcode"];
     echo "<div class='container'>


     <div class='card'>
       <h5 class='card-header'>User History</h5>
       <div class='card-body'>
       <h5 class='card-title'>Name: $username $surname</h5>
         <h5 class='card-title'>Email: $email</h5>
         <h5 class='card-title'>BirthDate: $birthdate</h5>
  
         
        <h5 class='card-title'>Address: $address</h5>
         <h5 class='card-title'>Postcode: $postcode</h5>
       

         <h5 class='card-title'>Contact: $contact</h5>
       </div>
     </div>";   
       }
      }

?>


