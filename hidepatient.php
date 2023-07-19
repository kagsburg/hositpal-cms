<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && ($_SESSION['elcthospitallevel'] != 'receptionist')) {
   header('Location:login.php');
} else {
   $id = $_GET['id'];
   // receptionist can only hide if status is 3
   if ($_SESSION['elcthospitallevel'] == 'receptionist') {
      $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='$id'");
      $row =  mysqli_fetch_array($getpatient);
      if ($row['status'] != 3) {
         header('Location:' . $_SERVER['HTTP_REFERER']);
      }
   }
   $change =  mysqli_query($con, "UPDATE patients SET status='0' WHERE patient_id='$id'") or die(mysqli_error($con));
   header('Location:' . $_SERVER['HTTP_REFERER']);
}
