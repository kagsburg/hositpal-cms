    <?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
        header('Location:login.php');
    }
    $id = $_GET['id'];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Attend Patient</title>
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
            $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$id'");
            $row = mysqli_fetch_array($getpatient);
            $patient_id = $row['patient_id'];
            $firstname = $row['firstname'];
            $secondname = $row['secondname'];
            $thirdname = $row['thirdname'];
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
            ?>

            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Attend <?php echo $firstname . ' ' . $secondname . ' ' . $thirdname . ' (' . $pin . ')'; ?></h4>

                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="patient">Attend Patient</a></li>
                                <li class="breadcrumb-item active"><a href="#">Attend Patient</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Attend Patient</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <?php
                                        if (isset($_POST['mode'])) {
                                            $mode = $_POST['mode'];
                                            $room = $_POST['section'][0];
                                            if (empty($mode)) {
                                                $errors[] = 'Mode Type Required';
                                            }
                                            if (!empty($errors)) {
                                                foreach ($errors as $error) {
                                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                                }
                                            } else {
                                                mysqli_query($con, "INSERT INTO  admissions(patient_id,mode,timestamp,dischargedate,admin_id,status) VALUES('$id','$mode',UNIX_TIMESTAMP(),0,'" . $_SESSION['elcthospitaladmin'] . "',2)") or die(mysqli_error($con));
                                                $last_id = mysqli_insert_id($con);
                                                mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status) VALUES('$last_id','$room','0','0','" . $_SESSION['elcthospitaladmin'] . "','receptionist',UNIX_TIMESTAMP(),0)") or die(mysqli_error($con));
                                                $lastid = mysqli_insert_id($con);
                                                if (isset($_POST['medicalservices'])) {
                                                    mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$lastid','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,0,0,'reception',0,0)") or die(mysqli_error($con));
                                                    $last_id = mysqli_insert_id($con);
                                                    $medicalservices = $_POST['medicalservices'];
                                                    foreach ($medicalservices as $service) {
                                                        $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$service'");
                                                        $row1 =  mysqli_fetch_array($getmedicalservice);
                                                        $charge = $row1['charge'];
                                                        mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                    }
                                                }
                                                echo '<div class="alert alert-success">Patient Successfully Added.</div>';
                                            }
                                        }
                                        ?>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label>Select Mode</label>
                                                <select class="form-control mode" name="mode">
                                                    <option selected="selected" value="">Select option..</option>
                                                    <option value="emergency">Emergency Mode</option>
                                                    <option value="normal">Normal Mode</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Department</label>
                                                <select class="form-control" id="category" name="department" data-parsley-id="1560" class="form-control parsley-error" data-parsley-required="true">
                                                    <option value="" selected="selected">Choose Department...</option>
                                                    <?php
                                                    $getdepartment =  mysqli_query($con, "SELECT * FROM departments WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getdepartment)) {
                                                        $department_id = $row1['department_id'];
                                                        $department = $row1['department'];
                                                        $getsections = mysqli_query($con, "SELECT * FROM sections WHERE department_id='$department_id'");
                                                    ?>
                                                        <option value="<?php echo $department_id; ?>"><?php echo $department; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Section</label>
                                                <select name="" id="subcategoryname" class="form-control">
                                                    <option value="" selected="">Select Section</option>
                                                </select>
                                                <?php
                                                $getdepartment =  mysqli_query($con, "SELECT * FROM departments WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getdepartment)) {
                                                    $department_id = $row1['department_id'];
                                                    $department = $row1['department'];
                                                ?>
                                                    <select name="section[]" id="subcategory<?php echo $department_id; ?>" style="display:none;" class="subcategories form-control">
                                                        <option value="">Select Section</option>
                                                        <?php
                                                        $getsections =  mysqli_query($con, "SELECT * FROM sections WHERE status=1 AND department_id='$department_id'");
                                                        while ($row1 =  mysqli_fetch_array($getsections)) {
                                                            $section_id = $row1['section_id'];
                                                            $section = $row1['section'];
                                                        ?>
                                                            <option value="<?php echo $section_id; ?>"><?php echo $section; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Medical Services</label>
                                                <select name="servicename" id="servicename" class="form-control">
                                                    <option value="">Select Medical Service</option>
                                                </select>
                                                <?php
                                                $getsection =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                                                while ($row =  mysqli_fetch_array($getsection)) {
                                                    $section_id = $row['section_id'];
                                                ?>
                                                    <div id="service<?php echo $section_id; ?>" style="display:none;width:100%;" class="row services form-group">

                                                        <?php
                                                        $getmedicalservices =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND section_id='$section_id' ORDER BY medicalservice");
                                                        while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                                            $medicalservice_id = $row1['medicalservice_id'];
                                                            $medicalservice = $row1['medicalservice'];
                                                            $charge = $row1['charge'];
                                                        ?>
                                                            <div class="col-lg-6">
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label" style="font-size:14px">
                                                                        <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="medicalservices[]"><?php echo $medicalservice; ?>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>



                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Submit</button>
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


        <!-- Dashboard 1 -->
        <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
        <script>
            $('#subcategoryname').click(function() {
                if ($('#category').val() === '') {
                    alert("Please Select a Category First");
                }
            });
            $('#category').change(function() {
                if ($(this).val() !== '') {
                    //       	 $(this).closest("form").attr('action',  $(this).val());
                    $("#subcategoryname").hide();
                    $(".subcategories").each(function(index) {

                        // console.log(this.id);
                        $("#" + this.id).hide();


                    });

                    $("#subcategory" + $('#category').val()).show();
                    var townid = $("#subcategory" + $('#category').val());
                    //         $('.subcategories').change(function() {                               
                    //             	 $(this).closest("form").attr('action',  $(this).val());                  
                    //                    });
                    $('.subcategories').change(function() {
                        if ($(this).val() !== '') {
                            //       	 $(this).closest("form").attr('action',  $(this).val());
                            $("#servicename").hide();
                            $(".services").each(function(index) {

                                // console.log(this.id);
                                $("#" + this.id).hide();


                            });
                            $("#service" + $(townid).val()).show();

                            //                           $('.subparishes').change(function() {                               
                            //             	 $(this).closest("form").attr('action',  $(this).val());                  
                            //                    });

                        } else {
                            $("#servicename").show();
                            $(".services").hide();
                        }

                    });
                } else {

                    $("#subcategoryname").show();
                    $(".subcategories").hide();
                    $("#servicename").show();
                    $(".services").hide();
                }
            });
        </script>
    </body>

    </html>