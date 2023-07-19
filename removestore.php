<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){ 
header('Location:login');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE stores SET status='0' WHERE  store_id='$id'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>