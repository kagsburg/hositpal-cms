<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='store manager')&& ($_SESSION['elcthospitallevel'] != 'pharmacist')){
header('Location:login.php');
      }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE stockorders SET status='1' WHERE stockorder_id='$id'") or die(mysqli_error($con));
$_SESSION['success']='<div class="alert alert-success">Stock Order Approved </div>';
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>