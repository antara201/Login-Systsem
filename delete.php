<?php
include "partials/_dbconnect.php";
$rn=$_GET['rn'];
$query="DELETE FROM `students` WHERE `students`.`id` = '$rn'";
$del=mysqli_query($conn,$query);
header("location:listing.php");
?>
