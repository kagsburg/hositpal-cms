<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}else{
$id=$_GET['id'];
$section = $_GET['section'];
$change=  mysqli_query($con,"UPDATE stockorders SET status='1' WHERE stockorder_id='$id' AND section='$section'") or die(mysqli_error($con));
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>