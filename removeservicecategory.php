<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE servicecategories SET status='0' WHERE servicecategory_id='$id'") or die(mysqli_error($con));
header('Location:servicecategories#categories');
   }
?>