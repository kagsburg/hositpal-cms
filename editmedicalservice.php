    <?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'admin')) {
        header('Location:login.php');
    } else {
        $id = $_GET['id'];
        if (isset($_POST['medicalservice'])) {
            $medicalservice =  mysqli_real_escape_string($con, trim($_POST['medicalservice']));
            $charge =  mysqli_real_escape_string($con, trim($_POST['charge']));
            $creditprice =  mysqli_real_escape_string($con, trim($_POST['creditprice']));
            $section =  mysqli_real_escape_string($con, trim($_POST['section']));
            $clinic =  mysqli_real_escape_string($con, trim($_POST['clinic']));
            $clinictype =  mysqli_real_escape_string($con, trim($_POST['clinictype']));
            if (empty($medicalservice)) {
                $errors[] = 'Medical service Name Required';
            }
            $check =  mysqli_query($con, "SELECT * FROM medicalservices WHERE medicalservice='$medicalservice' AND status=1 AND medicalservice_id!='$id'") or die(mysqli_error($con));
            if (mysqli_num_rows($check) > 0) {
                $errors[] = 'Medical service Already Added';
            }
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            } else {
                mysqli_query($con, "UPDATE medicalservices SET medicalservice='$medicalservice',clinic='$clinic',clinictype='$clinictype',charge='$charge',creditprice='$creditprice',section_id='$section' WHERE medicalservice_id='$id'") or die(mysqli_error($con));
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    ?>