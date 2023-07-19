<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
   header('Location:login.php');
} else {
   $id = $_GET['id'];
   $change =  mysqli_query($con, "UPDATE clinic_clients SET status='0' WHERE id='$id'") or die(mysqli_error($con));
   header('Location:' . $_SERVER['HTTP_REFERER']);
}
