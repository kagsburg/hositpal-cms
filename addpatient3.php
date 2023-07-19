<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
}
if (!isset($_SESSION['patientreg'])) {
    header("Location:addpatient.php");
} else {
    $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='" . $_SESSION['patientreg'] . "'");
    $row =  mysqli_fetch_array($getpatient);
    $level = $row['level'];
    if ($level == 1) {
        header("Location:addpatient1.php");
    }
    if ($level == 2) {
        header("Location:addpatient2.php");
    }
    if ($level == 4) {
        header("Location:addpatient4.php");
    }
    if ($level == 5) {
        header("Location:addpatient5.php");
    }
    if ($level == 6) {
        header("Location:addpatient.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Patient</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <?php
        include 'includes/header.php';
        ?>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Patient</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="patients">Patients</a></li>
                            <li class="breadcrumb-item active"><a href="addpatient.php">Add Patient</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">PART FOUR</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <?php
                                    if (isset($_FILES['image'], $_FILES['doc'])) {
                                        $image_name = $_FILES['image']['name'];
                                        $image_size = $_FILES['image']['size'];
                                        $image_temp = $_FILES['image']['tmp_name'];
                                        $allowed_ext = array('jpg', 'jpeg', 'png', 'PNG', 'gif', 'JPG', 'PNG', 'GIF', 'JPEG', '');
                                        $imgext = explode('.', $image_name);
                                        $image_ext = end($imgext);
                                        $doc_name = $_FILES['doc']['name'];
                                        $doc_size = $_FILES['doc']['size'];
                                        $doc_temp = $_FILES['doc']['tmp_name'];
                                        $allowed_ext = array('jpg', 'jpeg', 'png', 'PNG', 'gif', 'JPG', 'PNG', 'GIF', 'JPEG', 'PDF', 'pdf', '');
                                        $docext = explode('.', $doc_name);
                                        $doc_ext = end($docext);
                                        include 'includes/thumbs3.php';
                                        mysqli_query($con, "UPDATE patients SET ext='$image_ext',docext='$doc_ext',level=6,status=3 WHERE patient_id='" . $_SESSION['patientreg'] . "'");
                                        if (!empty($image_name)) {
                                            $image_file =  md5($_SESSION['patientreg']) . '.' . $image_ext;
                                            move_uploaded_file($image_temp, 'images/patients/' . $image_file) or die(mysqli_error($con));
                                            create_thumb('images/patients/', $image_file, 'images/patients/thumbs/');
                                        }
                                        if (!empty($doc_name)) {
                                            $doc_file =  md5($_SESSION['patientreg']) . '.' . $doc_ext;
                                            move_uploaded_file($doc_temp, 'images/docs/' . $doc_file) or die(mysqli_error($con));
                                        }
                                        echo '<div class="alert alert-success">Patient Information Successfully Added. Click <a href="patient?id=' . $_SESSION['patientreg'] . '">here</a> to complete the registration</div>';
                                        unset($_SESSION["patientreg"]);
                                    }
                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">


                                        <div class="form-group"><label class="control-label">Upload Photo (must be a passport size less that 200kb)</label>
                                            <input type="file" name="image" class="form-control ">
                                        </div>
                                        <div class="form-group"><label class="control-label">Upload other related documents if needed (Must be in PDF or image format)</label>
                                            <input type="file" name="doc" class="form-control ">
                                        </div>


                                        <div class="form-group pull-left">
                                            <!--                  <a class="btn btn-success" a href="addpatient5.php">Back</a>-->
                                        </div>
                                        <div class="form-group pull-right">
                                            <a href="canceladdpatient" class="btn btn-danger" onclick="return cancelpatient()">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Proceed</button>
                                            <script type="text/javascript">
                                                function cancelpatient() {
                                                    return confirm('You are about To Cancel this process. Are you sure you want to proceed?');
                                                }
                                            </script>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
            Footer start
        ***********************************-->
    <?php
    include 'includes/footer.php';
    ?>
    <!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        
    </script>
</body>

</html>