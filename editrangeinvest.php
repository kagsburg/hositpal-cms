<?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'admin')) {
        header('Location:login.php');
    } else {
        $id = $_GET['id'];
        // if (isset($_POST['typename'], $_POST['classification'], $_POST['unit'])) {
            
            $normalx = mysqli_real_escape_string($con, trim($_POST['normalx']));
            $normaly = mysqli_real_escape_string($con, trim($_POST['normaly']));
            if ( (empty($normaly)) || (empty($normalx))) {
                echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
            } else {

                mysqli_query($con, "UPDATE investigationtypesrange SET normalx='$normalx',normaly='$normaly' WHERE typesrange_id ='$id'") or die(mysqli_error($con));
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        // }
    }
    ?>