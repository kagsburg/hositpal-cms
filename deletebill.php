<?php
include 'includes/conn.php';
include 'utils/bills.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
} else {
    $id = $_GET['q'];
    clear_bill($pdo, $id);
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
