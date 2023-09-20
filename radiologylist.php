<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'radiographer')) {
   header('Location:login.php');
}
$id = $_GET['id'];
$type = isset($_GET['ty'])?$_GET['ty']:0;
// $getinvestigation =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$id'");
// $row1 =  mysqli_fetch_array($getinvestigation);
// $investigation_id = $row1['investigationtype_id'];
// $investigation = $row1['investigationtype'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Radiology List Tests</title>
   <!-- Favicon icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
   <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
   <!-- Custom Stylesheet -->
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
      ?>

      <div class="content-body">
         <!-- row -->
         <div class="container-fluid">
            <div class="row page-titles mx-0">
               <div class="col-sm-6 p-md-0">
                  <div class="welcome-text">
                     <h4>Radiology List Reports</h4>

                  </div>
               </div>
               <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index">Home</a></li>
                     <!-- <li class="breadcrumb-item"><a href="investigationtypes">Investigation Types</a></li> -->
                     <li class="breadcrumb-item active"><a href="#">Radiology List Reports</a></li>
                  </ol>
               </div>
            </div>

            <div class="row mb-2">
               <div class="col-sm-12">
                  <!-- <button type="button" data-toggle="modal" data-target="#addPriceModal" class="btn btn-xs btn-info">Add Charge</button> -->
               </div>   
            </div>
            <?php 
             if (isset($_SESSION['success'])) {
               echo $_SESSION['success'];
               unset($_SESSION['success']);
            }
            ?>

            <div class="row">

               <div class="col-lg-10">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Radiology List Reports</h4>
                     </div>
                     <div class="card-body">

                        <table id="example5" class="display" class="table table-striped" style="width:100%;">
                           <thead>
                              <tr>
                                 <th>Test</th>
                                 <?php if ($type != 1) {?>
                                 <th>Details</th>
                                 <?php }?>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              if ($type == 1){
                                 $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE room='radiography' AND status in (1,0) AND patientsque_id ='$id' ") or die(mysqli_error($con));
                              }else{
                                 $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE room='radiography' AND status=0 AND patientsque_id ='$id' ") or die(mysqli_error($con));
                              }
                                                
                                                if (mysqli_num_rows($getque) > 0) {
                                                $row = mysqli_fetch_array($getque);
                                                $patientsque_id = $row['patientsque_id'];
                                                $admission_id = $row['admission_id'];
                                                $prev_id = $row['prev_id'];

                                                $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id' and status='1' ");
                                                if (mysqli_num_rows($getadmission) > 0) {
                                                $row1 = mysqli_fetch_array($getadmission);
                                                $patient_id = $row1['patient_id'];
                                                $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                                $row2 = mysqli_fetch_array($getpatient);
                                                $firstname = $row2['firstname'];
                                                $secondname = $row2['secondname'];
                                                $thirdname = $row2['thirdname'];
                                                $gender = $row2['gender'];
                                                $ext = $row2['ext'];
                                                $mode2=$row1['mode'];
                                                $clinic=$row2['clinic'];

                                                $filter = empty($prev_id) ? "AND patientsque_id < '$patientsque_id' ORDER BY patientsque_id DESC" : "AND patientsque_id = '$prev_id'";
                                                $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND status=1 $filter");
                                                if (mysqli_num_rows($getprevque) > 0) {
                                                $rowp = mysqli_fetch_array($getprevque);
                                                $attendant = $_SESSION['elcthospitaladmin'];
                                                $patientsque_id2 = $rowp['patientsque_id'];
                                                $room = $rowp['room'];
                                                }else{
                                                $attendant = $_SESSION['elcthospitaladmin'];
                                                if ($clinic != 0){
                                                   $room = 'clinic';

                                                }
                                                }
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                                $rows = mysqli_fetch_array($getstaff);
                                                $fullname = $rows['fullname'];
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
                                                
                                                $doctorreports = mysqli_query($con, "SELECT * FROM radioorders WHERE  patientsque_id='$id' ") or die(mysqli_error($con));
                                                                       
                                                                        while ($rowo = mysqli_fetch_array($doctorreports)) {
                                                                           // $rowo = mysqli_fetch_array($getorder);
                                                                           $timestamp = $rowo['timestamp'];
                                                                           $serviceorder_id = $rowo['radioorder_id'];
                                                                           if ($type == 1){
                                                                           $getordered2 = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id ='$serviceorder_id' AND status in (3)") or die(mysqli_error($con));
                                                                           }else{
                                                                           $getordered2 = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id ='$serviceorder_id' AND status in (1,2)") or die(mysqli_error($con));
                                                                           }
                                                                           if (mysqli_num_rows($getordered2) > 0) {
                                                                              while ($row = mysqli_fetch_array($getordered2)) {
                                                                                 $medicalservice_id = $row['radioinvestigationtype_id'];
                                                                                 $status = $row['status'];
                                                                               $getitem = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                                               $row1 = mysqli_fetch_array($getitem);
                                                                               $itemname = $row1['investigationtype'];
                                                                               if ($clinic != 0){
                                                                                 $details= '';
                                                                               }else{
                                                                                  $doctorreport_s = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$patientsque_id2' and radiomeasure ='$medicalservice_id'") or die(mysqli_error($con));
                                                                                    $row_o = mysqli_fetch_array($doctorreport_s);
                                                                                    $details = $row_o['details'];
                                                                               }
                                                                           ?>
                                                                              <tr>
                                                                                 <td><?php echo $itemname; ?></td>
                                                                                 <?php if ($type != 1) {?>
                                                                                 <td><?php echo $details; ?></td>
                                                                                 <?php }?>
                                                                                 <td>
                                                                                    <?php if ($status == 1 || $status == 2) { ?>
                                                                                       <a href="addradiologyreport.php?id=<?php echo $patientsque_id; ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-xs btn-info">Add Report </a>
                                                                                    <?php } else { ?>
                                                                                       <a href="radiography?patientsque_id=<?php echo $patientsque_id; ?>&id=<?php echo $patient_id ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-primary btn-sm">View Report</a>
                                                                                   
                                                                                   <?php  }?>

                                                                                 </td>
                                                                              </tr>
                                                                           <?php } }}?>
                             
                                 
                                 
                              <?php }} ?>
                           </tbody>
                        </table>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="addPriceModal" tabindex="-1" role="dialog" aria-labelledby="addPriceModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="addPriceModalLabel">Add Insurance charge</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="addinsuranceinvestigationcharge?id=<?php echo $id; ?>" method="POST">
                  <div class="form-group">
                     <label>Insurance company</label>
                     <select name="company" class="form-control">
                        <option value="">Select company...</option>
                        <?php
                        $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                        while ($row1 =  mysqli_fetch_array($getcompanies)) {
                           $insurancecompany_id = $row1['insurancecompany_id'];
                           $company = $row1['company'];
                        ?>
                           <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Charge</label>
                     <input type="text" class="form-control" name="charge" required="required">
                  </div>
                  <div class="form-group">
                     <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
               </form>
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
   <script src="vendor/global/global.min.js"></script>
   <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
   <script src="vendor/chart.js/Chart.bundle.min.js"></script>
   <script src="js/custom.min.js"></script>
   <script src="js/deznav-init.js"></script>
   <!-- Apex Chart -->
   <script src="vendor/apexchart/apexchart.js"></script>



   <!-- Datatable -->
   <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
   <script src="js/plugins-init/datatables.init.js"></script>
</body>

</html>