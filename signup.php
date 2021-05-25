<?php

   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <style>
.error {color: #FF0000;}
</style>
  </head>
<body>
  
<?php
include 'dbconnection.php';
$emailErr =" ";


   
  if(isset($_POST['signup'])){
      $username= mysqli_real_escape_string($con,$_POST['username']);
      $email=mysqli_real_escape_string($con,$_POST['email']);
      error_reporting(0);
      if(empty($email)){
        $emailErr="Please enter Email";
 
      }
      elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailErr="Enter valid email";
      
      }
     
      $phone=mysqli_real_escape_string($con,$_POST['phone']);
      $password=mysqli_real_escape_string($con,$_POST['password']);
     
      
    

      $pass=password_hash($password,PASSWORD_BCRYPT);
      //token
      $token=bin2hex(random_bytes(15));

      $emailquery="select * from registration where email='$email' ";
      $query=mysqli_query($con,$emailquery);
      
      $emailcount=mysqli_num_rows($query);
      if($emailcount>0)
      {
        ?>
        <script>
        alert("Email already Exist");
        </script>
        <?php
        
      }
      else
      {
          $insertquery="insert into registration (username,email,phone,password,token,status) values ('$username','$email','$phone','$pass','$token','inactive')";
          $iquery=mysqli_query($con,$insertquery);
          if($iquery)
          {
            $subject="Email activation";
            $body="Hi, $username. Click to activate your account
             http://localhost/signup/activate.php?token=$token";
            $headers="From: nencyvpatel3010@gmail.com";
            if(mail($email,$subject,$body,$headers))
            {
              $_SESSION['msg']="Check your mail to activate your 
                      account $email";
                      header("Location:login.php");

            }
            else{
              echo "Email sending failed";
            }
              ?>
              <script>
              alert("Register succesfully");
              </script>
              <?php
              header("Location:login.php");
          }
          else{
            
            ?>
            <script>
            alert("Un succesfully");
            </script>
            <?php
          }
        }
      
  
  }


?>
           
           <div class="container" >
             <div  class="row content">
                 <div class="col-md-6 mb-3">
                     <img src="image/images/register.svg" class="img-fluid"></img>
             
                 </div>
                 <div class="col-md-6 mb-3">
                     <h2 class="signup-text mb-3">SignUp</h2>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group"> 
                        <label htmlFor="username"><i class="zmdi zmdi-account"></i></label>
                        <input type="text" name="username"  autoComplete="off" placeholder="Your Name" class="form-control" 
                        required 
                        ></input>
                     </div>
                     
                     <div class="form-group"> 
                        <label htmlFor="email"><i class="zmdi zmdi-email"></i></label><span class="error"> <?php echo $emailErr;?></span>
                        <input type="text" name="email"  autoComplete="off" placeholder="Your Email" class="form-control" 
                        required
                        > </input>
                       
                     </div>
                     <div class="form-group"> 
                        <label htmlFor="phone"><i class="zmdi zmdi-phone"></i></label>
                        <input type="text" name="phone"  autoComplete="off" placeholder="Your Phonenumber" class="form-control" 
                        required
                        ></input>
                     </div>
                     
                     <div class="form-group"> 
                        <label htmlFor="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="text" name="password"  autoComplete="off" placeholder="Your Passwprd" class="form-control" required>
                           
                        </input>
                       
                     
                     </div>
                     <div class="btn-class">
                     <input type="submit" name="signup"  autoComplete="off"  class="btn-class-form" value="Register" ></input>
                     </div>
                    </form>
                 </div>

           </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>