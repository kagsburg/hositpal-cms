<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['amount'])) {
        $amount =  mysqli_real_escape_string($con, trim($_POST['amount']));
        if (empty($amount)) {
            $errors[] = 'Amount is Required';
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            mysqli_query($con, "INSERT INTO  clientcredits(creditclient_id,date,amount,status) VALUES('$id','$timenow','$amount',1)") or die(mysqli_error($con));
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>