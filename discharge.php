<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='receptionist')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE admissions SET status='2',dischargedate=UNIX_TIMESTAMP() WHERE admission_id='$id'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>