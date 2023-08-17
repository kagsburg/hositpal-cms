<?php 

include 'includes/conn.php';
if(($_SESSION['elcthospitallevel']!='nurse')){
    header('Location:login.php');
   }else{
    $id=$_GET['id'];
    $change=  mysqli_query($con,"UPDATE clinic_clients SET status=3 WHERE clinic_cl_id='$id' ") or die(mysqli_error($con));
    header('Location:'.$_SERVER['HTTP_REFERER']);

}

