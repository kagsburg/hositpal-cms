<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'anesthesiologist')) {
    header('Location:login.php');
}
$patient_id=$_GET['id'];
if (isset($_SESSION['patientreg'])) {
    $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='" . $_SESSION['patientreg'] . "'");
    $row =  mysqli_fetch_array($getpatient);
    $level = $row['level'];
    if ($level == 1) {
        header("Location:addpatient1.php");
    }
    // if ($level == 2) {
    //     header("Location:addpatient2.php");
    // }
    // if ($level == 3) {
    //     header("Location:addpatient3.php");
    // }
    // if ($level == 4) {
    //     header("Location:addpatient4.php");
    // }
    // if ($level == 5) {
    //     header("Location:addpatient5.php");
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Patient Report </title>
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
                            <h4>Add Pre-operative Assessment </h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="anaethwaiting">Waiting</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Pre-operative</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Pre-operative </h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <?php
                                    if (isset($_POST['submit'])) {
                                        
                                        $procedure = mysqli_real_escape_string($con, trim($_POST['procedure']));
                                        $surgeon = mysqli_real_escape_string($con, trim($_POST['surgeon']));
                                        $weight = mysqli_real_escape_string($con, trim($_POST['weight']));
                                        $npo = mysqli_real_escape_string($con, trim($_POST['npo']));
                                        $allergy = mysqli_real_escape_string($con, trim($_POST['allergy']));
                                        $mallampati = mysqli_real_escape_string($con, trim($_POST['mallampati']));
                                        $prevhx = mysqli_real_escape_string($con, trim($_POST['prevhx']));
                                        $name = $_POST['name'];
                                        $vitals = $_POST['namevita'];
                                        $cns = $_POST['namecns'];
                                        $pe = $_POST['namepe'];
                                        $renal = $_POST['namerena'];
                                        $hem = $_POST['namehem'];
                                        $onc = $_POST['nameonc'];
                                        $pul = $_POST['namepul'];
                                        $pla = $_POST['namepla'];
                                        $oth = $_POST['nameoth'];
                                        $anaesthesiologist = mysqli_real_escape_string($con, trim($_POST['anaesthesiologist']));
                                        $comment = mysqli_real_escape_string($con, trim($_POST['comment']));
                                        $date = date('Y-m-d');  
                                        $time = date('H:i:s');
                                        $insert = mysqli_query($con, "INSERT INTO anaesthesiareport(patient_id,procedure,surgeon,weight,npo,allergy,mallampati,prevhx,admin_id,comment,date,time,status) VALUES('$patient_id','$procedure','$surgeon','$weight','$npo','$allergy','$mallampati','$prevhx','$anaesthesiologist','$comment','$date','$time','1')");
                                        if ($insert) {
                                            $last_id = mysqli_insert_id($con);
                                            foreach ($name['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $name['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportlabs(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($vitals['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $vitals['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportvitals(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($cns['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $cns['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportcns(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($pe['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $pe['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportpe(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($renal['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $renal['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportrenal(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($hem['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $hem['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareporthem(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($onc['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $onc['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportonc(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($pul['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $onc['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportpul(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($pla['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $onc['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportpla(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($oth['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $onc['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportoth(anaesthesiareport_id,type,result) VALUES('$last_id','$type','$result')");
                                            }

                                        }
                                    ?>
                                           
                                    <?php
                                    //         echo '<div class="alert alert-success">Patient Information Successfully Added.Click <a href="addpatient2.php">here</a> to proceed</div>';
                                    //     }
                                    // }
                                        }
                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                        <?php
                                        $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='$patient_id'");
                                        $row =  mysqli_fetch_array($getpatient);
                                        $firstname = $row['firstname'];
                                        $secondname = $row['secondname'];
                                        $gender = $row['gender'];   
                                        $dob = $row['dob'];
                                        $weight=$row['weight'];
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

                                        <div class="row">
                                            <div class="form-group col-lg-4"><label class="control-label">* First Name</label>
                                                <input type="text" name='firstname' class="form-control" value="<?php echo $firstname; ?>" disabled>
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">* Second Name</label>
                                                <input type="text" name='secondname' class="form-control" value="<?php echo $secondname; ?>" disabled >
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">* FileNumber </label>
                                                <input type="text" name='filenumber' class="form-control" value="<?php echo $pin; ?>" disabled >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-4"><label class="control-label">* Gender</label>
                                            <input type="text" name='gender' class="form-control" value="<?php echo $gender; ?>" disabled/>
                                            </div>

                                            <div class="form-group col-lg-4"><label class="control-label">Date of Birth</label>

                                                <input type="date" name="dob" class="form-control" value="" disabled>
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">* Ward</label>
                                            <input type="text" name='ward' class="form-control" value="<?php echo $gender; ?>" disabled/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4"><label class="control-label"> Procedure</label>
                                            <input type="text" name='procedure' class="form-control" value="" />
                                            </div>

                                            <div class="form-group col-lg-4"><label class="control-label">Surgeon</label>

                                                <input type="text" name="surgeon" class="form-control" value="" >
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Weight</label>
                                            <input type="text" name='weight' class="form-control" value="<?php echo $weight; ?>"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6"><label class="control-label"> NPO duration(hours)</label>
                                                <input type="text" name="npo" class="form-control " placeholder="Enter your Occupation">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label"> Allergy (If yes, specify)</label>
                                                <input type="text" name="allergy" class="form-control " placeholder="Enter your Adress">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label"> Mallampati</label>
                                                <input type="text" name="mallampati" class="form-control " placeholder="Enter your Phone Number">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label"> Medical hx of a patient</label>
                                                <input type="text" name="medhx" class="form-control " placeholder="Enter your Phone Number">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label"> Previous hx of anaesthesia</label>
                                                <select class="form-control" name="prevhx" >
                                                    <option selected value="0">Select HX of anaesthesia</option>
                                                    <option value="yes">YES</option>
                                                    <option value="no">NO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label> <h3>LABS</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainer" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="name[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="name[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtn" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>VITALS</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainervital" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namevita[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namevita[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnvital" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>CNS</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainercns" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namecns[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namecns[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtncns" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>PE</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainerpe" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namepe[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namepe[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnpe" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>RENAL</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainerrena" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namerena[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namerena[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnrena" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>HEM</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainerhem" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namehem[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namehem[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnhem" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>ONC</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContaineronc" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="nameonc[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="nameonc[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnonc" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>PULM</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainerpul" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namepul[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namepul[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnpul" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>Planned anaesthesia</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainerpla" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="namepla[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namepla[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnpla" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>Other</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContaineroth" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="nameoth[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="nameoth[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtnoth" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label> <h3>Anaesthesiologist review</h3></label>
                                            <textarea class="form-control" rows="5" id="comment"></textarea>
                                        </div>
                                        <div class="form-group pull-right">
                                            <!-- <a href="canceladdpatient" class="btn btn-danger" onclick="return cancelpatient()">Cancel</a> -->
                                            <button class="btn btn-primary" type="submit" name="submit">save</button>
                                           
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
        $('.maritalstatus').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'married')) {
                $('.forspouse').show();
            } else {
                $('.forspouse').hide();

            }
        });
        var frmvalidator = new Validator("form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("gender", "req", "*Gender is required");
        frmvalidator.addValidation("maritalstatus", "req", "*Marital Status is required");
    </script>
    <script>
  $(document).ready(function() {
    // Counter for unique field names
    var fieldCounter = 1;

    // Function to add form fields
    function addFormField() {
      fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field${fieldCounter}">Type:</label>
                                                <input type="text" name="name[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="name[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainer").append(newField);
    }
    function addFormFieldvital() {
      fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namevita[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namevita[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn2  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainervital").append(newField);
    }
    function addFormFieldcns(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namecns[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namecns[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn3  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainercns").append(newField);

    }
    function addFormFieldpe(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namepe[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namepe[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn4  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainerpe").append(newField);
    }
    function addFormFieldrena(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namerena[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namerena[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn5  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainerrena").append(newField);
    }
    function addFormFieldhem(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namehem[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namehem[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn6  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainerhem").append(newField);
    }
    function addFormFieldonc(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="nameonc[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="nameonc[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn7  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContaineronc").append(newField);
    }
    function addFormFieldpul(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namepul[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namepul[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn8  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainerpul").append(newField);
    }
    function addFormFieldpla(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="namepla[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="namepla[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn9  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContainerpla").append(newField);
    }
    function addFormFieldoth(){
        fieldCounter++;
      var newField = `
      <div class="row" style="margin-left:50px;">
                                            <div class="form-group col-lg-5">
                                                <label for="field2${fieldCounter}">Type:</label>
                                                <input type="text" name="nameoth[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="nameoth[result][]" class="form-control">
                                            </div>
                                            <button class="removeFieldBtn10  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
          
        </div>
        
      `;
      $("#formFieldsContaineroth").append(newField);
    }

    // Function to remove form fields
    $(document).on("click", ".removeFieldBtn", function() {
      $(this).parent().remove();
    });
    $(document).on("click", ".removeFieldBtn2", function() {
      $(this).parent().remove();
    });
    $(document).on("click", ".removeFieldBtn3", function() {
      $(this).parent().remove();
    });
    $(document).on("click", '.removeFieldBtn4',function(){
        $(this).parent().remove();
    })
    $(document).on("click", '.removeFieldBtn5',function(){
        $(this).parent().remove();
    })
    $(document).on("click", '.removeFieldBtn6',function(){
        $(this).parent().remove();
    })
    $(document).on("click", '.removeFieldBtn7',function(){
        $(this).parent().remove();
    })
    $(document).on("click", '.removeFieldBtn8',function(){
        $(this).parent().remove();
    })
    $(document).on("click", '.removeFieldBtn9',function(){
        $(this).parent().remove();
    });
    $(document).on("click", '.removeFieldBtn10',function(){
        $(this).parent().remove();
    });
    // Event listener for the "Add Field" button
    $("#addFieldBtn").on("click", function() {
      addFormField();
    });
    $("#addFieldBtnvital").on("click", function() {
      addFormFieldvital();
    });
    $('#addFieldBtncns').on("click",function(){
        addFormFieldcns();
    });
    $('#addFieldBtnpe').on("click", function(){
        addFormFieldpe();
    })
    $('#addFieldBtnrena').on("click", function(){
        addFormFieldrena();
    })
    $('#addFieldBtnhem').on("click", function(){
        addFormFieldhem();
    })
    $('#addFieldBtnonc').on("click", function(){
        addFormFieldonc();
    })
    $('#addFieldBtnpul').on("click", function(){
        addFormFieldpul();
    })
    $('#addFieldBtnpla').on("click", function(){
        addFormFieldpla();
    })
    $('#addFieldBtnoth').on("click", function(){
        addFormFieldoth();
    })
  });
</script>


</body>

</html>
