    <?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'doctor')) {
        header('Location:login.php');
    }
    $id = $_GET['id'];
    $b = $_GET['b'];
    $getbed = mysqli_query($con, "SELECT * FROM beds WHERE bed_id='$b' AND status=1") or die(mysqli_error($con));
    $row = mysqli_fetch_array($getbed);
    $ward_id = $row['ward_id'];
    $getward =  mysqli_query($con, "SELECT * FROM wards WHERE status=1 AND ward_id='$ward_id'");
    $row1 = mysqli_fetch_array($getward);
    $bedfee = $row1['bedfee'];
    $section_id = $row1['section_id'];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Admit Patient</title>
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
        <div id="main-wrapper">
            <?php
            include 'includes/header.php';
            $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
            $row = mysqli_fetch_array($getque);
            $patientsque_id = $row['patientsque_id'];
            $admission_id = $row['admission_id'];
            $room = $row['room'];
            $attendant = $row['attendant'];
            $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'");
            $row1 = mysqli_fetch_array($getadmission);
            $patient_id = $row1['patient_id'];
            $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
            $row2 = mysqli_fetch_array($getpatient);
            $firstname = $row2['firstname'];
            $lastname = $row2['lastname'];
            $gender = $row2['gender'];
            $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'   AND status=1 ORDER BY patientsque_id DESC");
            $rowp = mysqli_fetch_array($getprevque);
            $preroom = $rowp['room'];
            if (strlen($patient_id) == 1) {
                $pin = '000' . $patient_id;
            }
            if (strlen($patient_id) == 2) {
                $pin = '00' . $patient_id;
            }
            if (strlen($patient_id) == 3) {
                $pin = '0' . $patient_id;
            }
            if (strlen($patient_id) >= 4) {
                $pin = $patient_id;
            }
            if ((isset($_SESSION['lan'])) && ($_SESSION['lan'] == 'fr')) {
                include 'fr/addadmission.php';
            } else {
            ?>
                <div class="content-body">
                    <!-- row -->
                    <div class="container-fluid">
                        <div class="row page-titles mx-0">
                            <div class="col-sm-6 p-md-0">
                                <div class="welcome-text">
                                    <h4>Admit <?php echo $firstname . ' ' . $lastname . ' (' . $pin . ')'; ?></h4>

                                </div>
                            </div>
                            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                                    <li class="breadcrumb-item"><a href="waitingpatients">Waiting Patients</a></li>
                                    <li class="breadcrumb-item active"><a href="#">Admit Patient</a></li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Admit Patient</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                if ((empty($b)) || (empty($id))) {
                                                    $errors[] = 'Some fields are Empty';
                                                }
                                                $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
                                                $row = mysqli_fetch_array($getque);
                                                $admission_id = $row['admission_id'];

                                                $check = mysqli_query($con, "SELECT * FROM admitted WHERE admission_id='$admission_id' AND status=1");
                                                if (mysqli_num_rows($check) > 0) {
                                                    $errors[] = 'Patient Already Admitted';
                                                }
                                                if (!empty($errors)) {
                                                    foreach ($errors as $error) {
                                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                                    }
                                                } else {
                                                    mysqli_query($con, "INSERT INTO admitted(admission_id,bed_id,price,admissiondate,dischargedate,admin_id,status) VALUES('$admission_id','$b','$bedfee','$timenow',0,'" . $_SESSION['elcthospitaladmin'] . "','1')") or die(mysqli_error($con));
                                                    mysqli_query($con, "UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                    echo '<div class="alert alert-success">Patient Successfully Added.Click Here to <a href="admitted">View</a> Admissions</div>';
                                                }
                                            }

                                            ?>
                                            <form method="POST">
                                                <div class="form-group">
                                                    <label class="control-label">Ward</label>
                                                    <select name="ward" id="ward" class="form-control">
                                                        <option value="">Select ward ...</option>
                                                        <?php
                                                        $getwards =  mysqli_query($con, "SELECT * FROM wards WHERE status=1");
                                                        while ($row = mysqli_fetch_array($getwards)) {
                                                            $ward_id = $row['ward_id'];
                                                            $wardtype_id = $row['wardtype_id'];
                                                            $wardname = $row['wardname'];
                                                            $section_id = $row['section_id'];
                                                            $getcategory =  mysqli_query($con, "SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$section_id'");
                                                            $row2 = mysqli_fetch_array($getcategory);
                                                            $servicecategory = $row2['servicecategory'];

                                                        ?>
                                                            <option value="<?php echo $ward_id; ?>"><?php echo $wardname . ' (' . $servicecategory . ')'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Bed</label>
                                                    <select name="" id="bedname" class="form-control">
                                                        <option value="" selected="">Select Bed</option>
                                                    </select>
                                                    <?php
                                                    $getwards =  mysqli_query($con, "SELECT * FROM wards WHERE status=1");
                                                    while ($row = mysqli_fetch_array($getwards)) {
                                                        $ward_id = $row['ward_id'];
                                                    ?>
                                                        <select name="bed" id="bed<?php echo $ward_id; ?>" style="display:none;" class="beds form-control">
                                                            <option value="">Select Bed</option>
                                                            <?php
                                                            $getbeds =  mysqli_query($con, "SELECT * FROM beds WHERE status=1 AND ward_id='$ward_id'");
                                                            while ($row1 =  mysqli_fetch_array($getbeds)) {
                                                                $bed_id = $row1['bed_id'];
                                                                $bednumber = $row1['bednumber'];
                                                                $checkbed = mysqli_query($con, "SELECT * FROM admitted WHERE bed_id='$bed_id' AND status=1");
                                                                if (mysqli_num_rows($checkbed) == 0) {
                                                            ?>
                                                                    <option value="addadmission?id=<?php echo $id; ?>&&b=<?php echo $bed_id; ?>"><?php echo $bednumber; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
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


        <!-- Dashboard 1 -->
        <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
        <script>
            $('#bedname').click(function() {
                if ($('#ward').val() === '') {
                    alert("Please Select a Ward First");
                }
            });

            $('#ward').change(function() {
                if ($(this).val() !== '') {
                    //       	 $(this).closest("form").attr('action',  $(this).val());
                    $("#bedname").hide();
                    $(".beds").each(function(index) {

                        // console.log(this.id);
                        $("#" + this.id).hide();


                    });

                    $("#bed" + $('#ward').val()).show();
                    var townid = $("#bed" + $('#ward').val());
                    $('.beds').change(function() {
                        $(this).closest("form").attr('action', $(this).val());
                    });
                } else {

                    $("#bedname").show();
                    $(".beds").hide();
                }
            });
        </script>
    </body>

    </html>