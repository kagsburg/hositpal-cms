<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='store manager')){
header('Location:login.php');
      }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE stockorders SET status='1' WHERE stockorder_id='$id'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>