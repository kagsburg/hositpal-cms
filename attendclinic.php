<?php 

include 'includes/conn.php';
if(($_SESSION['elcthospitallevel']!='nurse')){
    header('Location:login.php');
   }else{
    $id=$_GET['id'];
    $change=  mysqli_query($con,"UPDATE clinic_clients SET status=1 WHERE clinic_cl_id='$id' ") or die(mysqli_error($con));
    echo '<script>window.location.href = "clinicclient?id='.$id.'";</script>';exit();

    // header('Location:'.$_SERVER['HTTP_REFERER']);

}

