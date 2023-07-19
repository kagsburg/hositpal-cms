<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='pharmacist')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE nurseorders SET status='1' WHERE nurseorder_id='$id'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>