<?php
include 'includes/conn.php';
include 'utils/departments.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['section'])) {
        $section =  mysqli_real_escape_string($con, trim($_POST['section']));
        if (empty($section)) {
            $errors[] = 'Section Name Required';
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        } else {
            update_section($conn, $id, $section);
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
