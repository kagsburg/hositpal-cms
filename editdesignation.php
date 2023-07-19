<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['designation'])) {
        $designation = mysqli_real_escape_string($con, trim($_POST['designation']));
        if (empty($designation)) {
            $errors[] = 'Designation Name Required';
        }
        $check =  mysqli_query($con, "SELECT * FROM designations WHERE designation='$designation' AND designation_id!='$id' AND status=1");
        if (mysqli_num_rows($check) > 0) {
            $errors[] = 'Designation Already Added';
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            mysqli_query($con, "UPDATE  designations SET designation='$designation' WHERE designation_id='$id'") or die(mysqli_error($con));
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>