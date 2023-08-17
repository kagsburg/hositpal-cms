<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'nurse')) {
   header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Add client</title>
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
                     <h4>Add Clinic Client</h4>

                  </div>
               </div>
               <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index">Home</a></li>
                     <li class="breadcrumb-item"><a href="creditclients">Clinic Clients</a></li>
                     <li class="breadcrumb-item active"><a href="addcreditclient">Add client</a></li>
                  </ol>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-8">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Add client</h4>
                     </div>
                     <div class="card-body">
                        <div class="basic-form">
                           <?php
                           if (isset($_POST['submit'])) {
                              $name = mysqli_real_escape_string($con, trim($_POST['name']));
                              $location = mysqli_real_escape_string($con, trim($_POST['location']));
                              $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                              $weight = mysqli_real_escape_string($con, trim($_POST['weight']));
                              $bloodgroup = mysqli_real_escape_string($con, trim($_POST['bloodgroup']));
                              $pregnancy_month = mysqli_real_escape_string($con, trim($_POST['pregnancy_month']));
                              $partner_name = mysqli_real_escape_string($con, trim($_POST['partner_name']));
                              $partner_mobile = mysqli_real_escape_string($con, trim($_POST['partner_mobile']));
                             
                              
                              if ((empty($name)) || (empty($location)) || (empty($phone))) {
                                 echo '<div class="alert alert-danger">Some fields are empty</div>';
                              } else {
                                 mysqli_query($con, "INSERT INTO clinic_clients(name,location,phone,weight,bloodgroup,pregnancy_month,partner_name,partner_mobile,user_id,timestamp,status) VALUES('$name','$location','$phone','$weight','$bloodgroup','$pregnancy_month','$partner_name','$partner_mobile','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
                                 echo '<div class="alert alert-success">Client Successfully Added</div>';
                              }
                           }
                           ?>
                           <form method="post" name='form' class="form" enctype="multipart/form-data">

                              <div class="form-group"><label class="control-label">*Full Name</label>
                                 <input type="text" name='name' class="form-control" placeholder="Enter client name" required="required">
                              </div>
                              <div class="form-group"><label class="control-label">* Location/Address</label>
                                 <input type="text" name='location' class="form-control" placeholder="Enter location" required="required">
                              </div>

                              <div class="form-group"><label class="control-label">* Mobile Number</label>
                                 <input type="text" name='phone' class="form-control" placeholder="Enter contacts" required="required">
                              </div>
                              <div class="form-group"><label class="control-label">Weight</label>
                                 <input type="text" name='weight' class="form-control" placeholder="Enter weight">
                              </div>
                              <div class="form-group"><label class="control-label">Blood Group</label>
                                 <input type="text" name='bloodgroup' class="form-control" placeholder="Enter blood group">
                              </div>
                              <div class="form-group"><label class="control-label">Month Of Pregnancy</label>
                                 <input type="text" name='pregnancy_month' class="form-control" placeholder="Enter month of pregnancy">
                              </div>
                              <div class="form-group"><label class="control-label">Partner/Husband Names</label>
                                 <input type="text" name='partner_name' class="form-control" placeholder="Enter partner's name">
                              </div>
                              <div class="form-group"><label class="control-label">Partner/Husband Mobile</label>
                                 <input type="text" name='partner_mobile' class="form-control" placeholder="Enter partner's mobile number"></textarea>
                              </div>
                             
                              <div class="form-group">
                                 <button class="btn btn-primary" type="submit" name="submit">Add Client</button>
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
   <script type="text/javascript">
      $(document).ready(function() {
         $(".clinic").change(function() {
            var clinic = $(this).val();
            if (clinic == "insurance") {
               $(".forinsurance").show();
               $(".forcredit").hide();
            } else if (clinic == "credit") {
               $(".forcredit").show();
               $(".forinsurance").hide();
            } else {
               $(".forcredit").hide();
               $(".forinsurance").hide();
            }
         });
      });
     
   </script>
</body>

</html>