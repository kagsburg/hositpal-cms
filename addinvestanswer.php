<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['answer'])) {
        $charge =  mysqli_real_escape_string($con, trim($_POST['answer']));
        if (empty($charge)) {
            $errors[] = 'Answer is  Required';
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            mysqli_query($con, "INSERT INTO investigationselect(investigationtype_id,answer,timestamp,status,admin_id) VALUES('$id','$charge',UNIX_TIMESTAMP(),'1','".$_SESSION['elcthospitaladmin']."')") or die(mysqli_error($con));
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>