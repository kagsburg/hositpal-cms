<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')&&(($_SESSION['elcthospitallevel']!='store manager'))&&(($_SESSION['elcthospitallevel']!='accountant'))){
header('Location:login.php');
      }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE restockorders SET status='4' WHERE restockorder_id ='$id'") or die(mysqli_error($con));
$_SESSION['success']='<div class="alert alert-success">ReStock Order Cancelled  </div>';
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>