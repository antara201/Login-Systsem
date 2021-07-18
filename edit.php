<?php
include "partials/_dbconnect.php";
error_reporting(0);
$rn=$_GET['rn'];
$un=$_GET['un'];
$ad=$_GET['ad'];
$gn=$_GET['gn'];
$br=$_GET['br'];
$ln=$_GET['ln'];
$ln_array = explode(",",$ln);
$pho=$_GET['pho'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Register yourself</title>
    <style>
    .heading{
      text-align:center;
      padding-top:20px;
    };
    </style>
</head>
<body>
<div class="container">
  <h3 class="heading">UPDATE YOUR INFORMATION</h3>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" value=<?php echo "$un"?> maxlength="11" class="form-control" id="username" name="username" type="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Address</label>
  <textarea class="form-control" name="Address" id="Address" rows="3"> <?php echo "$ad"?></textarea>
</div>
<p>Gender</p>
<div class="form-check form-check-inline" >
  <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($gn=='male'){echo 'checked';} ?>>
    Male
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($gn=='female'){echo 'checked';} ?>>
    Female
</div>
<br>
<br>
<p>Branch</p>
<select name="branch" class="form-select" aria-label="Default select example"  >
  <option <?php if($br==="--"){ echo "selected";}?> >--</option>
  <option <?php if($br=="CS"){echo "selected";}?> value="CS">CS</option>
  <option <?php if($br=="IT"){echo "selected";}?> value="IT">IT</option>
  <option <?php if($br=="ECE") {echo "selected";}?> value="ECE">ECE</option>
  <option <?php if($br=="EX"){ echo "selected";}?> value="EX">EX</option>
  <option <?php if($br=="EXTC") {echo "selected";}?>  value="EXTC">EXTC</option>
  <option <?php if($br=="PROD") {echo "selected";}?> value="PROD">PROD</option>
  <option <?php if($br=="TEXTILE") {echo "selected";}?> value="TEXTILE">TEXTILE</option>
</select>
<br>
<p>Languages</p>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="language[]" value="C++" id="language[]" <?php if($ln[0]=="C"){echo 'checked';}?>>
  <label class="form-check-label" for="Languages">
    C++
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="Java"  name="language[]" id="language[]" <?php if(in_array("Java",$ln_array)){echo("checked");}?>>
  <label class="form-check-label" for="Languages">
   Java
  </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" value="Python"  name="language[]" id="language[]" <?php if(in_array("Python",$ln_array)){echo 'checked';}?>>
  <label class="form-check-label" for="Languages">
    Python
  </label>
</div>
<br>
<br>




<div class="mb-3">
  <label for="photo" class="form-label">Photograph</label>
  <br>
  <img src='<?php echo $pho; ?>' width=100 height=100>
  <br>
  <br>
  <input class="form-control" type="file" id="photo" name="photo" value="$ph">
</div>
<input type="submit" name="submit" value="Update">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <br>
  <br>
  </body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $user=$_POST["username"];
    $add=$_POST["Address"];
    $gen=$_POST["gender"];
    $bran=$_POST["branch"];
    $lang = implode(",",$_POST["language"]);
    if(!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) {
    $query="UPDATE `students` SET Username = '$user',Address = '$add',`Gender` = '$gen',`Branch` = '$bran',`Language` = '$lang' WHERE `students`.`id` = '$rn';";
    $data=mysqli_query($conn,$query);
    }else{echo "<script>alert('Done')</script>";
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
  $query="UPDATE `students` SET Username = '$user',Address = '$add',`Gender` = '$gen',`Branch` = '$bran',`Language` = '$lang',`Photograph`='$target_file' WHERE `students`.`id` = '$rn';";
  $data=mysqli_query($conn,$query);
  
   
}

header("location:listing.php");
}
?>



