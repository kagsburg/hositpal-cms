<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='lab technician')&& ($_SESSION['elcthospitallevel']!='lab technologist')){
header('Location:login.php');
      }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE stockorders SET status='1' WHERE stockorder_id='$id' AND section='lab'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>