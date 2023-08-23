<?php
    include 'includes/conn.php';
    if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }else{
$patientque_id = $_GET['patientsque_id'];
$admission_id = $_GET['admission_id'];
$test=$_GET['test'];

       mysqli_query($con,"UPDATE labreports SET approved='".$_SESSION['elcthospitaladmin']."' WHERE patientsque_id='$patientque_id' and admission_id ='$admission_id' and test='$test'") or die(mysqli_error($con));
        header('Location:'.$_SERVER['HTTP_REFERER']);



    }
