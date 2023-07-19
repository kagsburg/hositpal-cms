<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='head physician')){
header('Location:login.php');
      }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE restockorders SET status='1' WHERE restockorder_id='$id'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>