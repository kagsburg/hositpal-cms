<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
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
    <title>Edit Employee</title>
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
                            <h4>Edit Employee</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="employees">Employees</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit employee</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Employee</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['fullname'], $_POST['gender'], $_POST['phone'], $_FILES['image'], $_POST['designation'], $_POST['email'], $_POST['department'], $_POST['email'])) {

                                        $image_name = $_FILES['image']['name'];
                                        $image_size = $_FILES['image']['size'];
                                        $image_temp = $_FILES['image']['tmp_name'];
                                        $allowed_ext = array('jpg', 'jpeg', 'png', 'PNG', 'gif', 'JPG', 'PNG', 'GIF', 'JPEG', '');
                                        $imgext = explode('.', $image_name);
                                        $image_ext = end($imgext);
                                        $fullname = mysqli_real_escape_string($con, trim($_POST['fullname']));
                                        $contractstart = mysqli_real_escape_string($con, strtotime($_POST['contractstart']));
                                        $contractend = mysqli_real_escape_string($con, strtotime($_POST['contractend']));
                                        // $salary = $_POST['salary'];
                                        $gender = $_POST['gender'];
                                        $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                                        $email = mysqli_real_escape_string($con, trim($_POST['email']));
                                        $designation = $_POST['designation'];
                                        $department = $_POST['department'];
                                        $education = $_POST['education'];
                                        $qualification = $_POST['qualification'];
                                        $emergency_contact = $_POST['emergency_contact'];
                                        $emergency_contact_relationship = $_POST['emergency_contact_relationship'];
                                        $emergency_contact_phone = $_POST['emergency_contact_phone'];
                                        $emergency_contact_address = $_POST['emergency_contact_address'];
                                        $salarylevel = $_POST['salarylevel'];

                                        if (!empty($email)) {
                                            $check = mysqli_query($con, "SELECT * FROM staff WHERE email='$email' AND status=1 AND staff_id!='$id'");
                                            if (mysqli_num_rows($check) > 0) {
                                                $errors[] = 'Email Already Exists';
                                            }
                                        }
                                        if (!empty($image_name)) {
                                            if (in_array($image_ext, $allowed_ext) === false) {
                                                $errors[] = 'Image File type not allowed';
                                            }
                                            if ($image_size > 5097152) {
                                                $errors[] = 'Maximum Image size is 5Mb';
                                            }
                                        }
                                        if ((empty($gender)) || (empty($department)) || (empty($designation))) {
                                            $errors[] = 'Some Fields Not Selected';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                    ?>
                                                <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php
                                            }
                                        } else {
                                            include 'includes/thumbs3.php';

                                            if (!empty($image_name)) {
                                                $editemployee =  mysqli_query($con, "UPDATE staff SET fullname='$fullname',phone='$phone',gender='$gender',email='$email',ext='$image_ext',designation_id='$designation',department_id='$department',contractstart='$contractstart',contractend='$contractend',salary='$salarylevel',education='$education',qualification='$qualification',emergency_contact='$emergency_contact',emergency_contact_relationship='$emergency_contact_relationship',emergency_contact_phone='$emergency_contact_phone',emergency_contact_address='$emergency_contact_address',salarylevel='$salarylevel' WHERE staff_id='$id'");
                                                $image_file =  md5($id) . '.' . $image_ext;
                                                move_uploaded_file($image_temp, 'images/employees/' . $image_file) or die(mysqli_error($con));
                                                create_thumb('images/employees/', $image_file, 'images/employees/thumbs/');
                                            } else {
                                                $editemployee =  mysqli_query($con, "UPDATE staff SET fullname='$fullname',phone='$phone',gender='$gender',email='$email',designation_id='$designation',department_id='$department',contractstart='$contractstart',contractend='$contractend',salary='$salarylevel',education='$education',qualification='$qualification',emergency_contact='$emergency_contact',emergency_contact_relationship='$emergency_contact_relationship',emergency_contact_phone='$emergency_contact_phone',emergency_contact_address='$emergency_contact_address',salarylevel='$salarylevel' WHERE staff_id='$id'");
                                            }

                                            echo '<div class="alert alert-success">Staff Member successfully Edited</div>';
                                        }
                                    }
                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND staff_id='$id'");
                                    $row = mysqli_fetch_array($getstaff);
                                    $staff_id = $row['staff_id'];
                                    $fullname = $row['fullname'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $gender = $row['gender'];
                                    $designation_id = $row['designation_id'];
                                    $department_id = $row['department_id'];
                                    $status = $row['status'];
                                    $salary_id = $row['salary'];
                                    $contractstart = $row['contractstart'];
                                    $contractend = $row['contractend'];
                                    $education = $row['education'];
                                    $qualification = $row['qualification'];
                                    $emergency_contact = $row['emergency_contact'];
                                    $emergency_contact_relationship = $row['emergency_contact_relationship'];
                                    $emergency_contact_phone = $row['emergency_contact_phone'];
                                    $emergency_contact_address = $row['emergency_contact_address'];
                                    $salarylevel = $row['salarylevel'];
                                    $ext = $row['ext'];
                                    $getdepartment =  mysqli_query($con, "SELECT * FROM departments WHERE status=1 AND department_id='$department_id'");
                                    $row1 =  mysqli_fetch_array($getdepartment);
                                    $department_id = $row1['department_id'];
                                    $department = $row1['department'];
                                    $getdesignation =  mysqli_query($con, "SELECT * FROM designations WHERE status=1 AND designation_id='$designation_id'");
                                    $row2 =  mysqli_fetch_array($getdesignation);
                                    $designation = $row2['designation'];
                                    $getsalaries =  mysqli_query($con, "SELECT * FROM salaries WHERE status=1 AND  salary_id='$salarylevel'");
                                    if (mysqli_num_rows($getsalaries)==0){
                                        $salary = '';
                                    }else{
                                        $row3 =  mysqli_fetch_array($getsalaries);
                                        $salary = $row3['salary'];
                                    }
                                    ?>

                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-6"><label class="control-label">* Full Name</label>
                                                <input type="text" name='fullname' class="form-control" placeholder="Enter fullname" required="required" value="<?php echo $fullname; ?>">
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label">* Gender</label>

                                                <select name="gender" class="form-control">
                                                    <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <div id='form_gender_errorloc' class='text-danger'></div>
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label">* Department</label>

                                                <select name="department" class="form-control">
                                                    <option value="<?php echo $department_id; ?>"><?php echo $department; ?></option>
                                                    <?php
                                                    $getdepartment =  mysqli_query($con, "SELECT * FROM departments WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getdepartment)) {
                                                        $department_id = $row1['department_id'];
                                                        $department = $row1['department'];
                                                    ?>
                                                        <option value="<?php echo $department_id; ?>"><?php echo $department; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div id='form_department_errorloc' class='text-danger'></div>
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label">*Phone</label>

                                                <input type="text" name="phone" class="form-control" placeholder="Enter  phone Number" required="required" value="<?php echo $phone; ?>">

                                            </div>

                                            <div class="form-group col-lg-6"><label class=" control-label">*Designation</label>
                                                <select name="designation" class="form-control">
                                                    <option value="<?php echo $designation_id; ?>"><?php echo $designation; ?></option>
                                                    <?php
                                                    $getdesignations =  mysqli_query($con, "SELECT * FROM designations WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getdesignations)) {
                                                        $designation_id = $row1['designation_id'];
                                                        $designation = $row1['designation'];
                                                    ?>
                                                        <option value="<?php echo $designation_id; ?>"><?php echo $designation; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div id='form_designation_errorloc' class='text-danger'></div>
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label"> Profile picture (Leave blank if not changing)</label>
                                                <input type="file" name="image" class="form-control " style="padding: 0px">
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label"> Email Address</label>
                                                <input type="email" name="email" class="form-control " placeholder="Enter a valid email address" value="<?php echo $email; ?>">
                                                <div id='form_email_errorloc' class='text-danger'></div>
                                            </div>
                                            
                                            <div class="form-group col-lg-6"><label class="control-label">Start of contract</label>
                                                <input type="date" name="contractstart" class="form-control " placeholder="Enter Contract Start" value="<?php echo date('Y-m-d', $contractstart); ?>">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">End of contract</label>
                                                <input type="date" name="contractend" class="form-control " placeholder="Enter Contract End" value="<?php echo date('Y-m-d', $contractend); ?>">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="control-label">Education Level</label>
                                                <select name="education" class="form-control">
                                                    <?php if(!empty($education)) { ?>
                                                    <option value="<?php echo $education; ?>"><?php echo $education; ?></option>
                                                    <?php } ?>
                                                    <option value="">select education level...</option>
                                                    <option value="Post Graduate">Post Graduate</option>
                                                    <option value="Bachelor Degree">Bachelor Degree</option>
                                                    <option value="Diploma">Diploma</option>
                                                    <option value="Certificate">Certificate</option>
                                                    <option value="Form six level">Form six level</option>
                                                    <option value="Form four level">Form four level</option>
                                                    <option value="Standard seven level">Standard seven level</option>
                                                    <option value="None">None</option>
                                                </select>
                                                <div id='form_education_errorloc' class='text-danger'></div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class=" control-label">Salary Level</label>
                                                <select name="salarylevel" class="form-control">
                                                    <option value="">select salary level...</option>
                                                    <?php
                                                    $getsalarylevels =  mysqli_query($con, "SELECT * FROM salaries WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getsalarylevels)) {
                                                        $salarylevel_id = $row1['salary_id'];
                                                        $salarylevelname = $row1['salary'];
                                                    ?>
                                                        <option value="<?php echo $salarylevel_id; ?>" <?php if($salarylevel_id == $salarylevel) echo "selected"; ?>><?php echo $salarylevelname; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div id='form_salarylevel_errorloc' class='text-danger'></div>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="control-label">Qualification</label>
                                                <input type="text" name="qualification" class="form-control" placeholder="Enter qualification" value="<?php echo $qualification; ?>">
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <h4> Emergency Information</h4>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="control-label">Emergency Contact</label>
                                                <input type="text" name="emergency_contact" class="form-control" placeholder="Enter emergency contact's name" value="<?php echo $emergency_contact; ?>">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="control-label">Relationship</label>
                                                <input type="text" name="emergency_contact_relationship" class="form-control" placeholder="Enter relationship to emergency contact" value="<?php echo $emergency_contact_relationship; ?>">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="control-label">Phone number</label>
                                                <input type="text" name="emergency_contact_phone" class="form-control" placeholder="Enter emergency contact's phone" value="<?php echo $emergency_contact_phone; ?>">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label class="control-label">Address</label>
                                                <input type="text" name="emergency_contact_address" class="form-control" placeholder="Enter emergency contact's address" value="<?php echo $emergency_contact_address; ?>">
                                            </div>
                                           
                                            


                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Edit Staff Member</button>
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
        var frmvalidator = new Validator("form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("email", "email", "*Enter a valid  email address");
        frmvalidator.addValidation("gender", "req", "*Gender is required");
        frmvalidator.addValidation("department", "req", "*Department is required");
        frmvalidator.addValidation("designation", "req", "*Designation is required");
    </script>
</body>

</html>