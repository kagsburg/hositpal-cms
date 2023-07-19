    <?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'admin')) {
        header('Location:login.php');
    } else {
        $id = $_GET['id'];
        if (isset($_POST['wardtype'], $_POST['wardname'])) {
            $wardname = mysqli_real_escape_string($con, trim($_POST['wardname']));
            $wardtype = mysqli_real_escape_string($con, trim($_POST['wardtype']));
            $bedfee = mysqli_real_escape_string($con, trim($_POST['bedfee']));
            $creditfee = mysqli_real_escape_string($con, trim($_POST['creditfee']));

            if (empty($wardtype)) {
                $errors[] = 'Ward type Name Required';
            }
            $check =  mysqli_query($con, "SELECT * FROM wards WHERE wardname='$wardname' AND status=1 AND ward_id!='$id'");
            if (mysqli_num_rows($check) > 0) {
                $errors[] = 'Ward name Already Added';
            }
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            } else {
                mysqli_query($con, "UPDATE wards SET wardname='$wardname',wardtype_id='$wardtype', bedfee='$bedfee', creditfee='$creditfee' WHERE ward_id='$id'") or die(mysqli_error($con));
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    ?>