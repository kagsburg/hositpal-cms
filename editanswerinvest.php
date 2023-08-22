<?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'admin')) {
        header('Location:login.php');
    } else {
        $id = $_GET['id'];
        // if (isset($_POST['typename'], $_POST['classification'], $_POST['unit'])) {
            $answwer = mysqli_real_escape_string($con, trim($_POST['answer2']));
            if ((empty($answwer)) ) {
                echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
            } else {

                mysqli_query($con, "UPDATE investigationselect SET answer='$answwer' WHERE investigationselect_id  ='$id'") or die(mysqli_error($con));
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        // }
    }
    ?>