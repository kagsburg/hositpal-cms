<?php
include 'includes/conn.php';
include 'utils/services.php';
include 'utils/bills.php';
if (($_SESSION['elcthospitallevel'] != 'insurance officer')) {
   header('Location:login.php');
} else {
   $id = $_GET['id'];

?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Verify Insurance</title>
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
                        <h4>Insurance Verification</h4>

                     </div>
                  </div>
                  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item"><a href="insurancepending">Pending</a></li>
                        <li class="breadcrumb-item active"><a href="#">Verification</a></li>
                     </ol>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="basic-form">

                              <?php
                              if (isset($_POST['insurancecompany'], $_POST['subscriptiontype'])) {
                                 $insurancecompany = mysqli_real_escape_string($con, trim($_POST['insurancecompany']));
                                 $maximum_coverage = mysqli_real_escape_string($con, trim($_POST['maximum_coverage']));
                                 $subscriptiontype = mysqli_real_escape_string($con, trim($_POST['subscriptiontype']));
                                 $membernumber = mysqli_real_escape_string($con, trim($_POST['membernumber']));
                                 $primary_name = mysqli_real_escape_string($con, trim($_POST['primary_name']));
                                 $primary_org = mysqli_real_escape_string($con, trim($_POST['primary_org']));
                                 $primary_contact = mysqli_real_escape_string($con, trim($_POST['primary_contact']));
                                 $primary_relationship = mysqli_real_escape_string($con, trim($_POST['primary_relationship']));
                                 $firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
                                 $secondname = mysqli_real_escape_string($con, trim($_POST['secondname']));
                                 $thirdname = mysqli_real_escape_string($con, trim($_POST['thirdname']));
                                 $gender = mysqli_real_escape_string($con, trim($_POST['gender']));
                                 $dob = mysqli_real_escape_string($con, strtotime($_POST['dob']));
                                 $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                                 $vote = mysqli_real_escape_string($con, trim($_POST['vote']));
                                 $contact = "";
                                 $employmentstatus = "";
                                 $employername = mysqli_real_escape_string($con, trim($_POST['employername']));
                                 $employernumber = mysqli_real_escape_string($con, trim($_POST['employernumber']));

                                 $getpatients = mysqli_query($con, "SELECT patients.* FROM paymethod LEFT JOIN patients ON patients.patient_id=paymethod.patient_id WHERE paymethod.method='insurance' AND paymethod_id='$id'");
                                 $row = mysqli_fetch_array($getpatients);
                                 $patient_id = $row['patient_id'];

                                 if (!empty($errors)) {
                                    foreach ($errors as $error) {
                                       echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }
                                 } else {
                                    mysqli_query($con, "UPDATE patients SET vote='$vote', insurancecompany='$insurancecompany',policyidnumber='$membernumber',maximum_coverage='$maximum_coverage',subscriptiontype='$subscriptiontype',primary_name='$primary_name',primary_org='$primary_org',primary_contact='$primary_contact',primary_relationship='$primary_relationship',firstname='$firstname',secondname='$secondname',thirdname='$thirdname',gender='$gender',dob='$dob',phone='$phone',contact='$contact',employmentstatus='$employmentstatus',employername='$employername',employernumber='$employernumber' WHERE patient_id='" . $patient_id . "'") or die(mysqli_error($con));
                                    mysqli_query($con, "UPDATE paymethod SET status='1' WHERE paymethod_id='" . $id . "'") or die(mysqli_error($con));
                                    // $paymenttype = 'insurance';
                                    
                                    // $service = get_registration_service($pdo);
                                    // $registration_bill = get_bill_by_type_and_patient($pdo, "unselective", $service['id'], $patient_id, 1);
                                    // if (!empty($registration_bill)) {
                                    //    $service_charge = get_service_charge($pdo, $service['id'], $paymenttype, $insurancecompany, 2);
                                    //    update_bill($pdo, $registration_bill['bill_id'], [
                                    //       "payment_method" => $service_charge['payment_type'],
                                    //       "amount" => $service_charge['charge'],
                                    //    ]);
                                    // }
                                    echo '<div class="alert alert-success">Insurance Information Added Successfully</div>';
                                 }
                              } else {

                              

                              $getpatients = mysqli_query($con, "SELECT patients.* FROM paymethod LEFT JOIN patients ON patients.patient_id=paymethod.patient_id WHERE paymethod.status='2' AND paymethod.method='insurance' AND paymethod_id='$id'");
                              $row = mysqli_fetch_array($getpatients);
                              $patient_id = $row['patient_id'];
                              $policyidnumber = $row['policyidnumber'];
                              $insurancecompany = $row['insurancecompany'];
                              $admin_id = $row['admin_id'];
                              $firstname = $row['firstname'];
                              $secondname = $row['secondname'];
                              $thirdname = $row['thirdname'];
                              $dob = $row['dob'];
                              $phone = $row['phone'];
                              $gender = $row['gender'];
                              $employmentstatus = $row['employmentstatus'];
                              $employername = $row['employername'];
                              $employernumber = $row['employernumber'];
                              $timestamp = $row['timestamp'];
                              if(isset($company)) {
                                 $getcompany =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurancecompany'");
                                 $row1 =  mysqli_fetch_array($getcompany);
                                 $company = $row1['company'];
                              } else {
                                 $company = "";
                              }
                              $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'");
                              $row2 = mysqli_fetch_array($getstaff);
                              $fullname = $row2['fullname'];
                              ?>
                              <form action="" method="POST">
                                 <div class="row">
                                    <div class="form-group col-lg-6">
                                       <label class="control-label">* Insurance Company</label>
                                       <select name="insurancecompany" class="form-control">
                                          <option value="">select company...</option>
                                          <?php
                                          $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                          while ($row1 =  mysqli_fetch_array($getcompanies)) {
                                             $insurancecompany_id = $row1['insurancecompany_id'];
                                             $company = $row1['company'];
                                          ?>
                                             <option value="<?php echo  $insurancecompany_id; ?>"><?php echo $company; ?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                    <div class="form-group col-lg-6"><label class="control-label">Maximum Coverage</label>
                                       <input type="text" name="maximum_coverage" class="form-control " placeholder="Enter Maximum coverage">
                                    </div>

                                    <div class="form-group col-lg-6">
                                       <label class="control-label">* Subscription Type</label>
                                       <select name="subscriptiontype" id="subscriptiontype" class="form-control">
                                          <option value="">select type...</option>
                                          <option value="primary">Primary Subscriber</option>
                                          <option value="secondary">Beneficiary</option>
                                       </select>
                                    </div>

                                    <div class="form-group col-lg-6 all"><label class="control-label">Membership ID</label>
                                       <input type="text" name="membernumber" class="form-control " placeholder="Enter M/Ship ID">
                                    </div>

                                    <div class="col-lg-12 forprimary" style="display: none">
                                       <div class="row">
                                          <!-- <div class="form-group col-lg-6"><label class="control-label">Primary Subscriber Name</label>
                                             <input type="text" name="primary_name" class="form-control " placeholder="Enter primary subsriber's name">
                                          </div> -->
                                          <div class="form-group col-lg-6"><label class="control-label">Employer Name/ Organization Name</label>
                                             <input type="text" name="primary_org" class="form-control " placeholder="Enter organization">
                                          </div>
                                          <div class="form-group col-lg-6"><label class="control-label">Contact Details</label>
                                             <input type="text" name="primary_contact" class="form-control " placeholder="Enter contact details">
                                          </div>
                                          <div class="form-group col-lg-6"><label class="control-label">Relationship with Employee </label>
                                             <input type="text" name="primary_relationship" class="form-control " placeholder="Enter relationship">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-12 forsecondary" style="display: none">
                                       <div class="row">
                                          <!-- <div class="form-group col-lg-6"><label class="control-label">Primary Subscriber Name</label>
                                             <input type="text" name="primary_name" class="form-control " placeholder="Enter primary subsriber's name">
                                          </div> -->
                                          <div class="form-group col-lg-6"><label class="control-label">Relationship With Primary Subscriber</label>
                                             <input type="text" name="primary_name" class="form-control " placeholder="relationship with primary subscriber">
                                          </div>
                                          <!-- <div class="form-group col-lg-6"><label class="control-label">Contact Details</label>
                                             <input type="text" name="primary_contact" class="form-control " placeholder="Enter contact details">
                                          </div>
                                          <div class="form-group col-lg-6"><label class="control-label">Relationship with Employee </label>
                                             <input type="text" name="primary_relationship" class="form-control " placeholder="Enter relationship">
                                          </div> -->
                                       </div>
                                    </div>

                                    <div class="form-group col-lg-4 all"><label class="control-label">* First Name</label>
                                       <input type="text" name='firstname' class="form-control" placeholder="Enter firstname" required="required" value="<?php echo $firstname; ?>">
                                    </div>
                                    <div class="form-group col-lg-4"><label class="control-label">* Second Name</label>
                                       <input type="text" name='secondname' class="form-control" placeholder="Enter second name" required="required" value="<?php echo $secondname; ?>">
                                    </div>
                                    <div class="form-group col-lg-4"><label class="control-label">Third Name</label>
                                       <input type="text" name='thirdname' class="form-control" placeholder="Enter Third name" value="<?php echo $thirdname; ?>">
                                    </div>

                                    <div class="form-group col-lg-6"><label class="control-label">* Gender</label>

                                       <select name="gender" class="form-control">
                                          <option value="">select gender...</option>
                                          <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
                                          <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
                                       </select>
                                       <div id='form_gender_errorloc' class='text-danger'></div>
                                    </div>

                                    <div class="form-group col-lg-6"><label class="control-label">Date of Birth</label>
				    
   					<input type="date" name="dob" class="form-control" placeholder="Enter  date of birth" value="<?php if (!empty($dob)) echo date('Y-m-d', $dob); ?>">
                                    </div>

                                    <div class="form-group col-lg-6"><label class="control-label">* Phone Number</label>
                                       <input type="text" name="phone" class="form-control " placeholder="Enter your Phone Number" value="<?php echo $phone; ?>">
                                    </div>

                                    <div class="form-group col-lg-6"><label class="control-label">Vote Number</label>
                                       <input type="text" name="vote" class="form-control " placeholder="Enter Vote Number">
                                    </div>

                                    <!-- <div class="forprimary" style="display: none; width: 100%">
                                       <div class="form-group col-lg-6"><label class="control-label">* Employment Status</label>

                                          <select name="employmentstatus" class="form-control employmentstatus">

                                             <option value="">select status...</option>
                                             <option value="Full time" <?php if ($employmentstatus == "Full time") echo "selected"; ?>>Full time</option>
                                             <option value="Part time" <?php if ($employmentstatus == "Part time") echo "selected"; ?>>Part time</option>
                                             <option value="Unemployed" <?php if ($employmentstatus == "Unemployed") echo "selected"; ?>>Unemployed</option>
                                             <option value="Retired" <?php if ($employmentstatus == "Retired") echo "selected"; ?>>Retired</option>
                                             <option value="Student" <?php if ($employmentstatus == "Student") echo "selected"; ?>>Student</option>
                                             <option value="Others" <?php if ($employmentstatus == "Others") echo "selected"; ?>>Others</option>
                                          </select>
                                          <div id='form_employmentstatus_errorloc' class='text-danger'></div>
                                       </div>

                                       <div class="foremployed" style="display: none">
                                          <div class="form-group col-lg-6"><label class="control-label">*Employer Name</label>
                                             <input type="text" name="employername" class="form-control " placeholder="Enter Employer Name">
                                          </div>

                                          <div class="form-group col-lg-6"><label class="control-label">*Employer Number</label>
                                             <input type="text" name="employernumber" class="form-control " placeholder="Enter Employer Number">
                                          </div>
                                       </div>

                                    </div> -->
                                 </div>
                                 <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                 </div>


                              </form>

                              <?php } ?>
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


      </div>

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
         $(function() {
            $('#subscriptiontype').on('change', function() {
               var sub = $(this).val();
               $('.forsecondary').hide();
               $('.forprimary').hide();

               if (sub == "secondary") {
                  $('.forsecondary').show();
               } else if (sub == "primary") {
                  $('.forprimary').show();
               }
            })

            $('.employmentstatus').on('change', function() {
               var getselect = $(this).val();
               if ((getselect == 'Full time') || (getselect == 'Part time')) {
                  $('.foremployed').show();
               } else {
                  $('.foremployed').hide();

               }
            });
         })
      </script>
   </body>

   </html>
<?php } ?>
