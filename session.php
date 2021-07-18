<?php
session_start();
if (!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true){
  header("location:login.php");
  exit;
};
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <style>
    .container{
      padding:20px;
    }
    </style>
  </head>
  <body>
  <?php
  require 'partials/_nav.php';?>
  <div class="container">
  <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Welcome <?php echo $_SESSION['username'] ?></h4>
  <p>Hey!You are logged in as  <?php echo $_SESSION['username'] ?>. </p>
  <hr>
  <p class="mb-0">You can log out using this <a href="/PROJECT_FINAL/logout.php">link</a>.</p>
</div>
  </div>
  
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    
  </body>
</html>