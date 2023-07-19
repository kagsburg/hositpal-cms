<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['charge'])) {
        $charge =  mysqli_real_escape_string($con, trim($_POST['charge']));
        if (empty($charge)) {
            $errors[] = 'Charge is  Required';
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            mysqli_query($con, "UPDATE insuredinventoryitems SET charge='$charge' WHERE insuredinventoryitem_id='$id'") or die(mysqli_error($con));
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>