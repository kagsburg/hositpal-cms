<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
      header('Location:login.php');
  }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE stockorders SET status='1',approvedby='" . $_SESSION['elcthospitaladmin'] . "' WHERE stockorder_id='$id'") or die(mysqli_error($con));
$_SESSION['success']='<div class="alert alert-success">Stock Order Approved </div>';
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>