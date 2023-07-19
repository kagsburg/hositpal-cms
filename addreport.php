<?php
include 'includes/conn.php';
include 'utils/bills.php';

if (!isset($_SESSION['elcthospitaladmin'])) {
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
    <title>Add Patient Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">


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
        if ((isset($_SESSION['lan'])) && ($_SESSION['lan'] == 'fr')) {
            include 'fr/addreport.php';
        } else {
        ?>

            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Add Report</h4>

                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="waitingpatients">Waiting patients</a></li>
                                <li class="breadcrumb-item active"><a href="#">Add Report</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <?php
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
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                                </div>
                                <div class="card-body">

                                    <div class="profile-blog mb-5">
                                        <img src="images/avatar.png" alt="" class="img-fluid mt-4 mb-4 w-100">
                                        <h4 class="text-primary"><?php echo $firstname . ' ' . $lastname; ?></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Report</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <?php
                                        if (isset($_POST['destination'], $_POST['details'])) {
                                            $destination = $_POST['destination'];
                                            $details = $_POST['details'];
                                            if (!empty($destination)) {
                                                mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','$destination','0','0','" . $_SESSION['elcthospitaladmin'] . "','nurse',UNIX_TIMESTAMP(),0,'$id')") or die(mysqli_error($con));
                                                $lastid = mysqli_insert_id($con);
                                                mysqli_query($con, "UPDATE patientsque SET status='1',attendant='" . $_SESSION['elcthospitaladmin'] . "' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                if (isset($_POST['type'], $_POST['measurement'])) {
                                                    $type = $_POST['type'];
                                                    $measurement = $_POST['measurement'];
                                                    $allmeasurements = sizeof($measurement);
                                                    for ($i = 0; $i < $allmeasurements; $i++) {
                                                        mysqli_query($con, "INSERT INTO reports(type,measurement,patientsque_id,details,status) VALUES('$type[$i]','$measurement[$i]','$id','$details','1')") or die(mysqli_error($con));
                                                    }
                                                    if (isset($_POST['services'])) {
                                                        mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,insurer,percentage,source,status) VALUES('$lastid','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,0,'','acts',0)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        $services = $_POST['services'];
                                                        $total = 0;
                                                        foreach ($services as $service) {
                                                            $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$service'");
                                                            $row1 =  mysqli_fetch_array($getmedicalservice);
                                                            $charge = $row1['charge'];
                                                            $total = $total + $charge;
                                                            mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                        }
                                                        // create_bill($con, $patient_id, $admission_id, 'medical_service', $last_id, $total);

                                                    }
                                                    mysqli_query($con, "DELETE FROM reports WHERE measurement=''") or die(mysqli_error($con));
                                                }
                                        ?>

                                        <?php
                                                echo '<div class="alert alert-success">Patient Report Successfully Added</div>';
                                            }
                                        }
                                        ?>
                                        <form method="post" name='form' class="form" action="" enctype="multipart/form-data">


                                            <div class="col-lg-12">
                                                <h4>Tests done</h4>
                                            </div>

                                            <div class="row">
                                                <?php
                                                if ($room == 24) {
                                                ?>
                                                    <div class="form-group col-lg-6">
                                                        <label>Size in cm</label>
                                                        <input type="text" name="type[]" class="form-control " placeholder="Size in cm" value="Taille en cm" style="display: none">
                                                        <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label>Weight in Kg</label>
                                                        <input type="text" name="type[]" class="form-control " placeholder="Enter Weight" value="Poids en Kg" style="display: none">
                                                        <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label>Alteration tension cm / mercury Cm Hg</label>
                                                        <input type="text" name="type[]" class="form-control " value="Tension Altérieur cm/mercure Cm Hg" style="display: none">
                                                        <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label>Temperature in oC</label>
                                                        <input type="text" name="type[]" class="form-control " value="Température en oC" style="display: none">
                                                        <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label>Peripheral oxygen saturation</label>
                                                        <input type="text" name="type[]" class="form-control " value="Saturation périphérique d’oxygène" style="display: none">
                                                        <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label>Heart rate in pulsation / min</label>
                                                        <input type="text" name="type[]" class="form-control " value="Fréquence cardiaque en pulsation/min" style="display: none">
                                                        <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                    </div>


                                                <?php } else { ?>
                                                    <div class='subobj1'>
                                                        <div class='row'>
                                                            <div class="form-group col-lg-6">
                                                                <label>Type (e.g Weight)</label>
                                                                <input type="text" name="type[]" class="form-control " placeholder="Type">
                                                            </div>
                                                            <div class="form-group col-lg-5">
                                                                <label>Value</label>
                                                                <input type="text" name="measurement[]" class="form-control " placeholder="Enter value">
                                                            </div>

                                                            <div class="form-group col-lg-1">
                                                                <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Destination Section</label>
                                                <select name="destination" class="form-control" id="destination">
                                                    <option value="" selected="">select ...</option>
                                                    <?php
                                                    $getcategories =  mysqli_query($con, "SELECT * FROM servicecategories WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getcategories)) {
                                                        $servicecategory_id = $row1['servicecategory_id'];
                                                        $servicecategory = $row1['servicecategory'];
                                                    ?>
                                                        <option value="<?php echo $servicecategory_id; ?>"><?php echo $servicecategory; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <?php
                                                $getcategories =  mysqli_query($con, "SELECT * FROM servicecategories WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getcategories)) {
                                                    $servicecategory_id = $row1['servicecategory_id'];
                                                    $servicecategory = $row1['servicecategory'];
                                                ?>
                                                    <div id="medicalservice<?php echo $servicecategory_id; ?>" style="display:none;width:100%;" class="row medicalservices form-group">
                                                        <div class="col-lg-12 form-group"><strong>Select Services</strong></div>
                                                        <?php
                                                        $getmedicalservices =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND servicecategory_id='$servicecategory_id' ORDER BY medicalservice");
                                                        while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                                            $medicalservice_id = $row1['medicalservice_id'];
                                                            $medicalservice = $row1['medicalservice'];
                                                            $charge = $row1['charge'];
                                                        ?>
                                                            <div class="col-lg-6">
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label" style="font-size:14px">
                                                                        <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="services[]"><?php echo $medicalservice; ?>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group"><label class="control-label">* More Details if any</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details"></textarea>
                                            </div>
                                            <div class="form-group pull-left">
                                                <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                            </div>
                                            <div class="form-group pull-right">
                                                <button class="btn btn-primary" type="submit">Proceed</button>
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
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('#destination').change(function() {
            if (($(this).val() !== '')) {
                //       	 $(this).closest("form").attr('action',  $(this).val());

                $(".medicalservices").each(function(index) {

                    // console.log(this.id);
                    $("#" + this.id).hide();


                });

                $("#medicalservice" + $('#destination').val()).show();
                //         var townid=  $("#description"+ $('#code').val());
                //         $('.descriptions').change(function() {                               
                //             	 $(this).closest("form").attr('action',  $(this).val());                  
                //                    });
            } else {
                $(".medicalservices").hide();
            }
        });
        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Type (e.g Weight)</label>    <input type="text"  name="type[]" class="form-control " placeholder="Enter type"></div>  <div class="form-group col-lg-6"> <label>Value</label>   <input type="text"  name="measurement[]" class="form-control " placeholder="Enter value"></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
        });
        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    </script>
</body>

</html>