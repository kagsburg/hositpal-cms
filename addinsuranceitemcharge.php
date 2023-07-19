<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['itemid'];
    if (isset($_POST['charge'])) {
        $charge =  mysqli_real_escape_string($con, trim($_POST['charge']));
        $company =  mysqli_real_escape_string($con, trim($_POST['company']));
        if (empty($charge)) {
            $errors[] = 'Charge is  Required';
        }
        if (empty($company)) {
            $errors[] = 'Insurance company is  Required';
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            mysqli_query($con, "INSERT INTO insuredinventoryitems(inventoryitem_id,insurancecompany_id,charge,status) VALUES('$id','$company','$charge','1')") or die(mysqli_error($con));
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>