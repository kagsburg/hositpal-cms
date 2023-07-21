<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='doctor')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE anaesthesiareport SET status='0' WHERE anareport_id='$id'") or die(mysqli_error($con));

header('Location:operationswaiting');
   }
?>