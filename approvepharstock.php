<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')&&(($_SESSION['elcthospitallevel']!='store manager'))&&(($_SESSION['elcthospitallevel']!='head physician'))){
header('Location:login.php');
      }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE stockitems SET status='1' WHERE pharstockorder_id='$id'") or die(mysqli_error($con));
$change=  mysqli_query($con,"UPDATE pharstockorders SET status=1 WHERE pharstockorder_id='$id'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>