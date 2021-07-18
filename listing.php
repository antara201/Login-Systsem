<?php
session_start();
if (!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true){
  header("location:login.php");
  exit;};
$server="localhost";
$username="root";
$password="";
$database="trying";
$conn=mysqli_connect($server,$username,$password,$database);
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<style>
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/PROJECT_FINAL/css/jquery.dataTables.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
        });
    </script>
<title>Welcome <?php echo $_SESSION['username'] ?></title>
</head>
<body>
<?php
  require 'partials/_nav.php';
  ?>
<br>
<div class="container">
  <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Welcome <?php echo $_SESSION['username'] ?></h4>
  <p>Hey!You are logged in as  <?php echo $_SESSION['username'] ?>. </p>
  <hr>
  <p class="mb-0">You can log out using this <a href="/PROJECT_FINAL/logout.php">link</a>.</p>
</div>
  </div>
<div class="container">
<div class="alert alert-info text-center">
Data from MySQL Database
</div>
<div>
<table class="table table-bordered" id="myTable">
<thead>
<tr>
<th>Student Id</th>
<th>Username</th>
<th>Picture</th>
<th>Address</th>
<th>Gender</th>
<th>Branch</th>
<th>Language</th>
<th>Edit</th>
<th>Remove</th>
</tr>
</thead>
<tbody>
<?php
$query="SELECT * FROM students";
$result=mysqli_query($conn,$query);
while ($row=mysqli_fetch_assoc($result)){
    echo "<tr>
    <td>".$row["id"]."</td>
    <td>".$row["Username"]."</td>
    <td>"?><img src='<?php echo $row['Photograph']; ?>' width=100 height=100><?php echo "</td>
    <td>".$row["Address"]."</td>
    <td>".$row["Gender"]."</td>
    <td>".$row["Branch"]."</td>
    <td>".$row["Language"]."</td>
    
    <td>"?><a href="edit.php?rn=<?php echo $row["id"]?>&un=<?php echo $row["Username"]?>&ad=<?php echo $row["Address"]?>&gn=<?php echo $row["Gender"]?>&br=<?php echo $row["Branch"]?>&ln=<?php echo $row["Language"]?>&pho=<?php echo $row["Photograph"]?>"><?php echo "Update</td>
    <td>"?><a href="delete.php?rn=<?php echo $row["id"]?>"><?php echo "Delete</td>
    </tr>";
}
 ?>
 
</tbody>
</table>
</div>

<br>
<br>

</body>
</html>