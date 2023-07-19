<?php
include 'includes/conn.php';
if(!isset($_SESSION['elcthospitaladmin'])){
   header('Location:login.php');
      } else{
$id=$_GET['id'];
// $change=  mysqli_query($con,"UPDATE patients SET status='0' WHERE patient_id='$id'") or die(mysqli_error($con));
mysqli_query($con, "UPDATE paymethod SET status='0' WHERE paymethod_id='" . $id . "'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>