<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='nurse')){
header('Location:login.php');
   }
  $id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Patient Observation Sheet</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
     <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
        <link href="css/chosen/chosen.css" rel="stylesheet">
    	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
   <style>
            .chosen-container-single .chosen-single {
    position: relative;
    display: block;
    overflow: hidden;
    padding: 4px 0 0 8px;
    height: 36px;
            }
            .chosen-container-active.chosen-with-drop .chosen-single div b {
    background-position: -18px 10px;
            }
        </style>	
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
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/addnursingsheet.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Patient Observation and Fluids Sheet</h4>
                    </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="admitted">Admitted Patients</a></li>
                            <li class="breadcrumb-item"><a href="admission?id=<?php echo $id; ?>">Details</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Sheet</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                    <div class="col-lg-12">
                     
                                      
                    </div>
                      <?php      
                              $getadmitted= mysqli_query($con,"SELECT * FROM admitted WHERE status IN (1,2) AND admitted_id='$id'");
                  $row = mysqli_fetch_array($getadmitted);
                  $admission_id=$row['admission_id'];    
                  $admitted_id=$row['admitted_id'];    
                  $bed_id=$row['bed_id'];    
                  $price=$row['price'];    
                  $status=$row['status'];    
                  $admissiondate=$row['admissiondate'];    
                  $dischargedate=$row['dischargedate'];    
                  $admin_id=$row['admin_id'];    
                  $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                              $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                               $firstname = $row2['firstname'];
                               // $headfirstname = $row2['headfirstname'];
                               $lastname = $row2['secondname'];
                               // $headlastname = $row2['headlastname'];
                               $age = $row2['dob'];
                               // $agecategory = $row2['agecategory'];
                               $gender = $row2['gender'];
                               // $referred = $row2['referred'];
                               // $province = $row2['province'];
                               $town = $row2['address'];
                               // $zone = $row2['zone'];
                               // $quarter = $row2['quarter'];
                               // $agegroup = $row2['agegroup'];   
                            $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));                        
                            $rows= mysqli_fetch_array($getstaff);
                            $fullname=$rows['fullname'];
                 $getbed= mysqli_query($con,"SELECT * FROM beds WHERE bed_id='$bed_id' AND status=1") or die(mysqli_error($con));
     $rowb= mysqli_fetch_array($getbed);
     $ward_id=$rowb['ward_id'];
     $bednumber=$rowb['bedname'];
      $getward=  mysqli_query($con,"SELECT * FROM wards WHERE status=1 AND ward_id='$ward_id'");
      $roww= mysqli_fetch_array($getward);
       $wardname=$roww['wardname'];
      if(strlen($patient_id)==1){
      $pin='0000'.$patient_id;
     }
       if(strlen($patient_id)==2){
      $pin='000'.$patient_id;
     }
        if(strlen($patient_id)==3){
      $pin='00'.$patient_id;
     }
        if(strlen($patient_id)==4){
      $pin='0'.$patient_id;
     }
  if(strlen($patient_id)>=5){
      $pin=$patient_id;
     } 
     
                   ?>
                
             <div class="col-lg-12">
                        <div class="card">
                             <div class="card-header">
                                <h4 class="card-title">Add Observation Sheet for <?php echo $firstname.' '.$lastname; ?></h4>
                            </div>
                            <div class="card-body">
                              <?php
                               if(isset($_POST['submit'])){
                                     $date= mysqli_real_escape_string($con,strtotime($_POST['date']));  
                                     $time= mysqli_real_escape_string($con,strtotime($_POST['time']));
                                     $bp= mysqli_real_escape_string($con,trim($_POST['bp']));
                                     $t= mysqli_real_escape_string($con,trim($_POST['t']));
                                     $p= mysqli_real_escape_string($con,trim($_POST['p']));
                                     $r= mysqli_real_escape_string($con,trim($_POST['r']));
                                     $fluid= mysqli_real_escape_string($con,trim($_POST['fluid']));
                                     $oral= mysqli_real_escape_string($con,trim($_POST['oral']));
                                     $iv= mysqli_real_escape_string($con,trim($_POST['iv']));
                                     $total= mysqli_real_escape_string($con,trim($_POST['total']));
                                     $urine= mysqli_real_escape_string($con,trim($_POST['urine']));
                                     $vomit= mysqli_real_escape_string($con,trim($_POST['vomit']));
                                     $aspirate= mysqli_real_escape_string($con,trim($_POST['aspirate']));
                                     $total2= mysqli_real_escape_string($con,trim($_POST['total2']));
                                     $bal= mysqli_real_escape_string($con,trim($_POST['bal']));

                                       if(empty($date)){
                                   $errors[]='Some Fields are Empty';
                                        }
                                 if(!isset($_POST['time'])){
                                 $errors[]='Time of Admission not Selected';      
                                   }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
                                 $date = $_POST['date'];
                                    $time = $_POST['time'];
                                    $insert=mysqli_query($con,"INSERT INTO observationsheets (admitted_id,date,time,bp,t,p,r,fluid,oral,iv,tot,urine,vomit,aspirate,total2,balance,admin_id,status) VALUES('$admitted_id','$date','$time','$bp','$t','$p','$r','$fluid','$oral','$iv','$total','$urine','$vomit','$aspirate','$total2','$bal','".$_SESSION['elcthospitaladmin']."',1)") or die(mysqli_error($con));
                                    if($insert){
                                        echo '<div class="alert alert-success">Observation Sheet Added Successfully</div>';
                                    }else{
                                        echo '<div class="alert alert-danger">Error Occured</div>';
                                    }
                             
                                }             
                            }             
                
   ?>
    <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
      <div class="row">
                  <div class=" col-lg-6">
           <div class="form-group"><label class="control-label">Date*</label>
        <input type="date" name='date' class="form-control" placeholder="Enter  date" value="<?php echo date('Y-m-d',$timenow); ?>">                                                                                 
                                </div>
                                </div>
        <div class=" col-lg-6">
            <div class="form-group">
                <label class="control-label">Time *</label>
                <input type="time" name="time" class="form-control" placeholder="Enter time" value="<?php echo date('H:i',$timenow); ?>">
            </div>
         
        </div>   
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">BP*</label>
                <input type="text" name="bp" class="form-control" placeholder="Enter BP">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">T</label>
                <input type="text" name="t" class="form-control" placeholder="Enter T">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">PR</label>
                <input type="text" name="p" class="form-control" placeholder="Enter P">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">RR</label>
                <input type="text" name="r" class="form-control" placeholder="Enter R">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">Nature of Fluid</label>
                <input type="text" name="fluid" class="form-control" placeholder="Enter Nature of Fluid">
            </div>
        </div>            
        </div>
        <hr>
        <div class="row">            
                <div class="col-lg-12"><p><strong>IN TAKE</strong></p></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label">Oral</label>
                        <input type="text" name="oral" class="form-control" placeholder="Enter Oral">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label">I.V</label>
                        <input type="text" name="iv" class="form-control" placeholder="Enter IV">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label">Total</label>
                        <input type="text" name="total" class="form-control" placeholder="Enter Total">
                    </div>
                </div>     

        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Urine</label>
                    <input type="text" name="urine" class="form-control" placeholder="Enter Urine">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Vomit</label>
                    <input type="text" name="vomit" class="form-control" placeholder="Enter Vomit">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Aspirate</label>
                    <input type="text" name="aspirate" class="form-control" placeholder="Enter Aspirate">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Total</label>
                    <input type="text" name="total2" class="form-control" placeholder="Enter Total">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Balance</label>
                    <input type="text" name="bal" class="form-control" placeholder="Enter Balance">
                </div>
            </div>
        </div>
           
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                 </form>
                            </div>
                            </div>
                            </div>
            </div>
        </div>
                                       <?php } ?>
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
       <script src="js/chosen/chosen.jquery.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
        <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
        <script>
                  var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }    
              $('.subobj_button').click(function(e){ //on add input button click
        e.preventDefault();  
        $('.subobj').append(`<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row"> <div class="col-lg-3 form-group">   <label>Medication</label><select name="medications[]" data-placeholder="Choose item..." class="chosen-select" style="width:100%;"> <option value="" selected="selected">select item...</option>   <?php          $getitems=mysqli_query($con,"SELECT * FROM inventoryitems WHERE status=1 ");    while ($row = mysqli_fetch_array($getitems)) {      $inventoryitem_id = $row['inventoryitem_id'];
                                        $itemname = $row['itemname'];
                                        // $category_id = $row['category_id'];
                                        $measurement_id = $row['measurement_id'];
                                        // $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                        // $row1 =  mysqli_fetch_array($getcat);
                                        // $category = $row1['category'];
                                        $type = $row['type'];
                                        $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                        $row2 =  mysqli_fetch_array($getunit);
                                        $measurement = $row2['measurement'];
                                        if ($type == 'Medical') {  ?>  <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option> <?php }}?>  </select>  </div> <div class="col-lg-3 form-group">     <label>Dosage</label>    <input type="text" class="form-control" name="consumption[]" placeholder="Enter consumption"></div><div class="col-lg-3 form-group">
                                    <label>Frequency</label>
                                    <input type="text" class="form-control" name="frequency[]" placeholder="Enter Frequency">
                                   </div><div class="col-lg-3 form-group"><div class="form-group"> <label>Root of Admission*</label> <select class="form-control reference" name="admissionroot[]"><option selected="selected" value="">Select Root..</option><option value="  IVD"> IVD</option> <option value="IVL">IVL</option><option value="IM">IM</option><option value="SC">SC</option><option value="Oral">Oral</option>  </select> </div>    </div> </div> </div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:30px"><i class="fa fa-minus"></i></button></div>`); //add input box
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
       });
          $('.subobj').on("click",".remove_subobj", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
            </script>
</body>

</html>