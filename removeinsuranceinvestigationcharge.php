<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
   header('Location:login.php');
} else {
   $id = $_GET['id'];
   $change =  mysqli_query($con, "UPDATE insuredinvestigationtypes SET status='0' WHERE insuredinvestigationtype_id='$id'") or die(mysqli_error($con));
   header('Location:' . $_SERVER['HTTP_REFERER']);
}
