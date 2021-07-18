<?php
include "partials/_dbconnect.php";
$login=false;
$showError=false;
if ($_SERVER["REQUEST_METHOD"]=="POST"){
  $username=$_POST["username"];

  $password=$_POST["password"];
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $sql="SELECT * from `students` where Username='$username'";

  $result = mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result);
  if ($num==1){
    while ($row=mysqli_fetch_assoc($result)){
      if (password_verify($password,$row['Password'])){
        echo "yes";
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location:listing.php");
      }
      else{
        $showError="Invalid Credentials";
      }
    } 
  }
  else{
    $showError="Invalid Credentials";
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>LOGIN</title>
    <style>
    .heading{
      text-align:center;
      padding-top:20px;
    };
    </style>
  </head>
  <body>
  <?php
  require 'partials/_nav.php'
  ?>
   <?php
  if ($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>You are logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if ($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! </strong>'. $showError .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>  
  <div class="container">
  <h3 class="heading">Log In</h3>

  <form action="/PROJECT_FINAL/login.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" type="username"  autocomplete="off" aria-describedby="emailHelp">
    <h6 id="usercheck"></h6>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password"  autocomplete="off" name="password">
    <h6 id="passcheck"></h6>
  </div>
  <button type="submit" id="submitbtn" class="btn btn-primary">Login</button>
</form>
</div>   
<script>
        $(document).ready(function(){

            $('#usercheck').hide();
            $('#passcheck').hide();

            var userErr=true;
            var passErr=true;

            $('#username').keyup(function(){
                username_check();
            });
            function username_check(){
                var user_val= $('#username').val();
                if (user_val.length==0){
                    $('#usercheck').show();
                    $('#usercheck').html("**Please fill Username");
                    $('#usercheck').focus();
                    $('#usercheck').css("color","red");
                    userErr=false;
                    return false;
                }
                else{
                    $('#usercheck').hide();
                }
                if ((user_val.length<3) || (user_val.length>11)){
                    $('#usercheck').show();
                    $('#usercheck').html("**Length must be between 3 and 10");
                    $('#usercheck').focus();
                    $('#usercheck').css("color","red");
                    userErr=false;
                    return false;
                }
                else{
                    $('#usercheck').hide();
                }
            }
            $('#password').keyup(function(){
                password_check();
            });
            function password_check(){
                var pass_val=$('#password').val();
                if (pass_val.length==0){
                    $('#passcheck').show();
                    $('#passcheck').html("**Please fill password");
                    $('#passcheck').focus();
                    $('#passcheck').css("color","red");
                    passErr=false;
                    return false;
                }
                else{
                    $('#passcheck').hide();
                }
                if ((pass_val.length<3) || (pass_val.length>10)){
                    $('#passcheck').show();
                    $('#passcheck').html("**Length must be between 3 and 10");
                    $('#passcheck').focus();
                    $('#passcheck').css("color","red");
                    passErr=false;
                    return false;
                }
                else{
                    $('#passcheck').hide();
                }
            }
           

            $("#submitbtn").click(function(){

                userErr=true;
                passErr=true;
               
                username_check();
                password_check();
              
                if ((userErr==true)&&(passErr==true)){
                    return true;
                }
                else{
                    return false;
                }
            });
            

           
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>