<?php
include 'includes/conn.php';
if(($_SESSION['elcthospitallevel']!='doctor')){
    header('Location:login.php');
   }else{
    $id=$_GET['patientid'];
    $que = $_GET['que'];
    $change=  mysqli_query($con,"UPDATE admissions SET attended=1 WHERE patient_id='$id' and status=1 ") or die(mysqli_error($con));
    header('Location:adddoctorreport?id='.$que);

}



?>