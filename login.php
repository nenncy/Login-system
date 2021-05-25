<?php

   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Ip</title>
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>
<body>
<?php 
   include "dbconnection.php";
   if(isset($_POST['signin'])){
       $email=$_POST['email'];
       $password=$_POST['password'];
       $email_search="select * from registration where email='$email' ";
       $query=mysqli_query($con,$email_search);
       $email_count=mysqli_num_rows($query);
       if($email_count)
       {
           $email_pass=mysqli_fetch_assoc($query);

           $db_pass=$email_pass['password'];
           $pass_decode=password_verify($password,$db_pass);

           if($pass_decode){
            ?>
            <script>
            alert("Login succesfully");
            </script>
            <?php
            header("Location:inner-page.html");
                 
           }
           else{
            ?>
            <script>
            alert("Inavalid email or password");
            </script>
            <?php
           }
       }
       else{
        ?>
        <script>
        alert("Inavalid email or password ");
        </script>
        <?php
       }
   }

?>
           
           <div class="container" >
             <div  class="row content">
                 <div class="col-md-6 mb-3">
                     <img src="image/images/login.svg" class="img-fluid"></img>
             
                 </div>
                 <div class="col-md-6 mb-3">
                     <h2 class="signup-text mb-3">Sign In</h2>
                    <Form method="POST">
                     
                     <div class="form-group"> 
                        <label htmlFor="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="text" name="email"  autoComplete="off" placeholder="Your Email" class="form-control" 
                         
                        ></input>
                     </div>
                     
                     <div class="form-group"> 
                        <label htmlFor="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="text" name="password"  autoComplete="off" placeholder="Your Passwprd" class="form-control" >
                            
                        </input>
                     
                     </div>
                     <div class="btn-class">
                     <input type="submit" name="signin"  autoComplete="off"  class="btn-class-form" value="Login" ></input>
                     </div>
                    </Form>
                 </div>

           </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>