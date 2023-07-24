<?php
include 'includes/conn.php';
include 'utils/patients.php';
if (($_SESSION['elcthospitallevel'] != 'nurse')) {
    header('Location:login.php');
}
$reqid = $_GET['id'];
$registration_request = get_registration_request($pdo, $reqid);
$patient = $registration_request['patient'];
$patient_id = $patient['patient_id'];
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
                            <li class="breadcrumb-item"><a href="registrationrequests.php">Patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Patient</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Patient : (Medication Information)</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <?php
                                    if (isset($_POST['bloodgroup'], $_POST['weight'], $_POST['height'], $_POST['allergies'], $_POST['diseases'], $_POST['pregnancies'])) {
                                        $bloodgroup = mysqli_real_escape_string($con, trim($_POST['bloodgroup']));
                                        $weight = mysqli_real_escape_string($con, trim($_POST['weight']));
                                        $height = mysqli_real_escape_string($con, trim($_POST['height']));
                                        $allergies = mysqli_real_escape_string($con, trim($_POST['allergies']));
                                        $diseases = mysqli_real_escape_string($con, trim($_POST['diseases']));
                                        $pregnancies = mysqli_real_escape_string($con, trim($_POST['pregnancies']));
                                        mysqli_query($con, "UPDATE patients SET bloodgroup='$bloodgroup',weight='$weight',height='$height',allergies='$allergies',diseases='$diseases',pregnancies='$pregnancies',level=2 WHERE patient_id='" . $patient_id . "'") or die(mysqli_error($con));
                                        if (isset($_POST['month'], $_POST['year'])) {
                                            $month = $_POST['month'];
                                            $year = $_POST['year'];
                                            $allsurgeries = sizeof($month);
                                            for ($i = 0; $i < $allsurgeries; $i++) {
                                                mysqli_query($con, "INSERT INTO surgeryhistory(month,year,patient_id,status) VALUES('$month[$i]','$year[$i]','" . $patient_id . "','1')") or die(mysqli_error($con));
                                            }
                                        }
                                        clear_registration_request($pdo, $reqid);
                                    ?>
                                        
                                    <?php
                                        echo '<div class="alert alert-success">Patient Information Successfully Added.</div>';
                                    }
                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-4"><label class="control-label">Blood Group</label>
                                                <input type="text" name="bloodgroup" class="form-control " placeholder="Enter Blood Group">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Weight (kgs)</label>
                                                <input type="text" name="weight" class="form-control " placeholder="Enter Weight">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Height</label>
                                                <input type="text" name="height" class="form-control " placeholder="Enter Height">
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label">Allergies to Medication or Food (If Any)</label>
                                                <textarea name="allergies" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">Any existing disease (seperate with commas)</label>
                                                <textarea name="diseases" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">Number of Pregnancies (if Female)</label>
                                                <input type="number" name="pregnancies" class="form-control " placeholder="Enter Number of Pregnancies">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h4>Surgery history (if YES)</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class='subobj1'>
                                                <div class='row'>
                                                    <div class="form-group col-lg-6">
                                                        <label>Month</label>
                                                        <select class="form-control" name="month[]">
                                                            <option value="" selected="selected">Select Month</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-5">
                                                        <label>Year</label>
                                                        <select name="year[]" class="form-control">
                                                            <option value="">select year...</option>
                                                            <option value="<?php echo date('Y', $timenow); ?>"><?php echo date('Y', $timenow); ?></option>
                                                            <?php
                                                            $datenow = date('Y', $timenow);
                                                            for ($x = 0; $x <= 80; $x++) {
                                                                $datenow = $datenow - 1;
                                                                echo '<option value="' . $datenow . '">' . $datenow . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-lg-1">
                                                        <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pull-left">
                                            <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
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
        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Month</label>   <select class="form-control" name="month[]"><option value="" selected="selected">Select Month</option> <option value="January">January</option> <option value="February">February</option> <option value="March">March</option> <option value="April">April</option><option value="May">May</option> <option value="June">June</option> <option value="July">July</option> <option value="August">August</option><option value="September">September</option> <option value="October">October</option> <option value="November">November</option><option value="December">December</option></select></div>  <div class="form-group col-lg-6"> <label>Year</label> <select name="year[]" class="form-control"> <option value="">select  year...</option><option value="<?php echo date("Y", $timenow); ?>"><?php echo date("Y", $timenow); ?></option> <?php $datenow = date("Y", $timenow);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    for ($x = 0; $x <= 80; $x++) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $datenow = $datenow - 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<option value="' . $datenow . '">' . $datenow . '</option>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }                   ?>          </select></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
        });
        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
        
    </script>
</body>

</html>