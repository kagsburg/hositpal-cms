<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
   header('Location:login.php');
} else {
   $id = $_GET['id'];
   if (isset($_POST['name'])) {
      if (empty($_POST['name'])) {
         echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
      } else {
         $name =  mysqli_real_escape_string($con, trim($_POST['name']));
         mysqli_query($con, "UPDATE siunits SET name='$name' WHERE siunit_id='$id'") or die(mysqli_error($con));
         header('Location:' . $_SERVER['HTTP_REFERER']);
      }
   }
}
