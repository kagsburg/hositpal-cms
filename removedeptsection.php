<?php
include 'includes/conn.php';
include 'utils/departments.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    deactivate_section($conn, $id);
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
