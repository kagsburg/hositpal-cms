<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['salarylevel'])) {
        $salarylevel = mysqli_real_escape_string($con, trim($_POST['salarylevel']));
        if (empty($salarylevel)) {
            $errors[] = 'Salary Level Name Required';
        }
        $check =  mysqli_query($con, "SELECT * FROM salarylevels WHERE salarylevel='$salarylevel' AND salarylevel_id!='$id' AND status=1");
        if (mysqli_num_rows($check) > 0) {
            $errors[] = 'Salary Level Already Added';
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            mysqli_query($con, "UPDATE  salarylevels SET salarylevel='$salarylevel' WHERE salarylevel_id='$id'") or die(mysqli_error($con));
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>