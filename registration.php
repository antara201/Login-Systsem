<?php
include "partials/_dbconnect.php";
$showAlert=false;
$showError=false;
if ($_SERVER["REQUEST_METHOD"]=="POST"){
  $username=$_POST["username"];
  $password=$_POST["password"];
  $cpassword=$_POST["cpassword"]; 
  $address=$_POST["Address"];
  $gender=$_POST["gender"];
  $branch=$_POST["branch"];
  $language = implode(",",$_POST["language"]);
  $target_dir="image/";
$target_file=$target_dir.basename($_FILES["photo"]["name"]);
$uploadOk=1;
$a=6;
$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//Check is image is fake or real
if(isset($_POST["submit"])){
  $check=getimagesize($_FILES["photo"]["tmp_name"]);

if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

if (file_exists($target_file)) {
  $uploadOk = 0;
}
if ($_FILES["photo"]["size"] > 500000) {
  $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  $a=0;
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
    $a=7;
  } else {
   $a=9;
  }
}

 
  
  $existSql="SELECT * from `students` where Username='$username' ";
  $result=mysqli_query($conn,$existSql);
  $numExistRows= mysqli_num_rows($result);
  if ($numExistRows>0){
    $showError="Username already exists!";
  }
  else{
    if (($password==$cpassword)){
      $hash=password_hash($password,PASSWORD_DEFAULT);
      $sql="INSERT INTO `students` ( `Username`,`Password`,`Date`,`Address`,`Gender`,`Branch`,`Language`,`Photograph`) VALUES ( '$username', '$hash', current_timestamp(),'$address','$gender','$branch','$language','$target_file')";
      $result = mysqli_query($conn,$sql);
      if ($result){
        $showAlert=true;
      }
    }
    else{
      $showError="Passwords do not match";
    }
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Register yourself</title>
    <style>
    span{
      color:Red;
    }
    .heading{
      text-align:center;
      padding-top:20px;
    };
    </style>
  </head>
  <body>
    <?php
    include "partials/_nav.php";
    
if ($showAlert){
  echo '<div class="alert  alert-success" role="alert">
  Success!You have been registered.
 
</div>';
}
if ($showError){
echo '<div class="alert  alert-danger" role="alert">
Registration Failed!'.$showError.'

</div>';
}

    ?>
  <div class="container">
  <h3 class="heading">Register Yourself</h3>

  <form action="/PROJECT_FINAL/registration.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="username" class="form-label">Username<span>*</span></label>
    <input type="text" maxlength="11" class="form-control" id="username" name="username" type="username"  autocomplete="off" aria-describedby="emailHelp">
    <h6 id="usercheck"></h6>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Address</label>
  <textarea class="form-control" name="Address" id="Address" rows="3"></textarea>
</div>
<p>Gender<span>*</span></p>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender" id="male" value="male">
    Male
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender" id="female" value="female">
    Female
</div>
<h6 id="gencheck"></h6>
<br>
<br>
<p>Branch<span>*</span></p>
<select name="branch" id="branch" class="form-select" aria-label="Default select example">
  <option value ="" selected hidden>--</option>
  <option value="CS">CS</option>
  <option value="IT">IT</option>
  <option value="ECE">ECE</option>
  <option value="EX">EX</option>
  <option value="EXTC">EXTC</option>
  <option value="PROD">PROD</option>
  <option value="TEXTILE">TEXTILE</option>
</select>
<h6 id="brancheck"></h6>
<br>
<p>Languages</p>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="language[]" value="C++" id="language[]">
  <label class="form-check-label" for="Languages">
    C++
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="Java"  name="language[]" id="language[]" >
  <label class="form-check-label" for="Languages">
   Java
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="Python"  name="language[]" id="language[]">
  <label class="form-check-label" for="Languages">
    Python
  </label>
</div>
<br>
<br>

<div class="mb-3">
  <label for="photo" class="form-label">Upload Photograph</label>
  <input class="form-control" type="file" id="photo" name="photo">
</div>



  <div class="mb-3">
    <label for="password" class="form-label">Password<span>*</span></label>
    <input type="password" class="form-control" id="password" name="password">
    <h6 id="passcheck"></h6>
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password<span>*</span></label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <h6 id="cpasscheck"></h6>
  </div>
  <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
</form>
</div>
<br>
<script>
        $(document).ready(function(){

            $('#usercheck').hide();
            $('#passcheck').hide();
            $('#cpasscheck').hide();
            $('#gencheck').hide();
            $('#brancheck').hide();

            var userErr=true;
            var passErr=true;
            var cpassErr=true;
            var branErr=true;

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
            $('#cpassword').keyup(function(){
                cpassword_check()
            });
            function cpassword_check(){
                var pass_value=$('#password').val();
                var cpass_val=$('#cpassword').val();
                if (cpass_val != pass_value){
                    $('#cpasscheck').show();
                    $('#cpasscheck').html("**Passwods do not match");
                    $('#cpasscheck').focus();
                    $('#cpasscheck').css("color","red");
                    cpassErr=false;
                    return false;
                }
                else{
                    $('#cpasscheck').hide();
                }
            }

            


            $("#submitbtn").click(function(){
                userErr=true;
                passErr=true;
                cpassErr=true;
                branErr=true;
        
                username_check();
                password_check();
                cpassword_check();
                var gencheck=$("input[name='gender']:checked").val();
                if(!gencheck){
                  $('#gencheck').show();
                    $('#gencheck').html("**Please select gender");
                    $('#gencheck').focus();
                    $('#gencheck').css("color","red");
                }
                var branch=$("#branch");
                if (branch.val()===""){
                  $('#brancheck').show();
                  $('#brancheck').html("**Please select branch");
                  $('#brancheck').focus();
                  $('#brancheck').css("color","red");
                  branErr=false;


                }

                if ((userErr==true)&&(passErr==true)&&(cpassErr==true)&&(gencheck)&&(branErr==true)){
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

