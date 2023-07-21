<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'anesthesiologist')) {
    header('Location:login.php');
}
$patient_id=$_GET['id'];
$admin = $_GET['admin'];
$operation_id = $_GET['operation'];
// get admission details 
$admission_details = mysqli_query($con, "SELECT * FROM `admissions`  WHERE patient_id='$patient_id' and status='1'");
$rowadmit = mysqli_fetch_array($admission_details);
$admission_id = $rowadmit['admission_id'];
// get inpatient details
$inpatient = mysqli_query($con, "SELECT * FROM `admitted`  WHERE admission_id='$admission_id' and status='1'");
$rowinpatient = mysqli_fetch_array($inpatient);
$inpatient_id = $rowinpatient['admitted_id'];
// // get patient que
// $patient_que = mysqli_query($con, "SELECT * FROM `patientsque`  WHERE admission_id='$admission_id' and payment='1' AND room='anesthesiology' and status=0 order by patientsque_id DESC");
// $rowpatient_que = mysqli_fetch_array($patient_que);
// $patient_que_id = $rowpatient_que['patientsque_id'];
// $prev_admin_id = $rowpatient_que['admin_id'];

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
                            <h4>ADD INTRAOPERATIVE MONITORING </h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="anaeoperated">Waiting</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Intra-operative</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Intra-operative </h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <?php
                                    if (isset($_POST['submit'])) {
                                        
                                       
                                        $name = $_POST['monitor'];
                                        
                                        $vitals = $_POST['namevita'];
                                        $cns = $_POST['namecns'];
                                        $pe = $_POST['namepe'];
                                        $renal = $_POST['namerena'];
                                        $anaesthesiologist = mysqli_real_escape_string($con, trim( $_SESSION['elcthospitaladmin']));
                                        $comment = mysqli_real_escape_string($con, trim($_POST['comment']));
                                        $date = date('Y-m-d');  
                                        $time = date('H:i:s');
                                        $insert = mysqli_query($con, "INSERT INTO anaesthesiareport2(admission_id,surgeon,admin_id,comment,date,time,status) VALUES('$admission_id','$admin','$anaesthesiologist','$comment','$date','$time','1')");
                                        if ($insert) {
                                            $last_id = mysqli_insert_id($con);
                                            foreach ($name['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $name['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportmont(anaesthesiareport2_id,type,value) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($vitals['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $vitals['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportgen(anaesthesiareport2_id,type,value) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($cns['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $cns['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportven(anaesthesiareport2_id,type,value) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($pe['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $pe['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportreg(anaesthesiareport2_id,type,value) VALUES('$last_id','$type','$result')");
                                            }
                                            foreach ($renal['type'] as $key => $value) {
                                                $type = $value;
                                                $result = $renal['result'][$key];
                                                $insert = mysqli_query($con, "INSERT INTO anaesthesiareportreext(anaesthesiareport2_id,type,value) VALUES('$last_id','$type','$result')");
                                            }
                                            //status 4 means second anaesthesia report added
                                            $update = mysqli_query($con, "UPDATE operations SET anareport2_id='$last_id',status='4' WHERE operation_id='$operation_id'");
                                            echo '<div class="alert alert-success">Patient Anaesthesia Report Successfully Added.Click <a href="anaethwaiting">here</a> to proceed</div>';

                                        }
                                    ?>
                                           
                                    <?php
                                    
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
                                         // get doctor report 
                                        //  $get_patientque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$patque'");
                                        //     $row_patientque = mysqli_fetch_array($get_patientque);
                                        //     $admin_id = $row_patientque['admin_id'];
                                        //     $previd = $row_patientque['prev_id'];
                                        // // get doctor report 
                                        // $get_doctorreport = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$previd' and status='1' order by doctorreport_id desc LIMIT 1");
                                        // $row_doctorreport = mysqli_fetch_array($get_doctorreport);
                                        // $doctorreport_id = $row_doctorreport['doctorreport_id'];
                                        // $details=$row_doctorreport['details'];
                                        // // remove html tags from string
                                        // $details = strip_tags($details);

                                        ?>
                                        <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
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
                                        <label> <h3>Monitoring</h3></label>
                                        <div class="row mb-3">
                                            <div id="formFieldsContainer" class="row">
                                            <!-- Initial form fields -->
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Type:</label>
                                                <input type="text" name="monitor[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="monitor[result][]" class="form-control">
                                            </div>
                                            </div>
                                            <!-- Button to add new form fields -->
                                            <div class="col-lg-4">
                                                <button type="button" id="addFieldBtn" class="btn btn-primary">Add Field</button>
                                            </div>
                                        </div>
                                        <label> <h3>General anaesthesia</h3></label>
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
                                        <label> <h3>Ventilation</h3></label>
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
                                        <label> <h3> Regional anaesthesia</h3></label>
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
                                        <label> <h3>Extubation</h3></label>
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
                                        
                                        <div class="row mb-3">
                                            <label> <h3>Anaesthesiologist review</h3></label>
                                            <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
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
                                                <input type="text" name="monitor[type][]" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="field1">Result:</label>
                                                <input type="text" name="monitor[result][]" class="form-control">
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

  });
</script>


</body>

</html>
