<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='receptionist')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE patients SET status='0' WHERE patient_id='".$_SESSION['patientreg']."'") or die(mysqli_error($con));
unset($_SESSION["patientreg"]);
header('Location:addpatient');
   }
?>