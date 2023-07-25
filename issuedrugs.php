<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='pharmacist')){
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
    <title>Issue Drugs</title>
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
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Issue Drugs</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="pharmacywaiting">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Issue Drugs</a></li>
                        </ol>
                    </div>
                </div>
       	<div class="row">
                     <?php
                         $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'");  
                                    $row = mysqli_fetch_array($getque);
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $prev_id=$row['prev_id'];
                                          $room=$row['room'];
                                               $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                     $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                                $firstname=$row2['firstname'];    
                            $secondname=$row2['secondname'];    
                            $thirdname=$row2['thirdname'];    
                            $gender=$row2['gender'];    
                               $ext=$row2['ext']; 
                               $getprevque=mysqli_query($con,"SELECT * FROM patientsque WHERE admission_id='$admission_id'   AND status=1  ORDER BY patientsque_id DESC");  
              $rowp= mysqli_fetch_array($getprevque);
             $attendant=$rowp['attendant'];
             $patientsque_id2=$rowp['patientsque_id'];
             
                  $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));                        
                 $rows= mysqli_fetch_array($getstaff);
                      $fullname=$rows['fullname'];    
                                if(strlen($patient_id)==1){
      $pin='000'.$patient_id;
     }
       if(strlen($patient_id)==2){
      $pin='00'.$patient_id;
     }
        if(strlen($patient_id)==3){
      $pin='0'.$patient_id;
     }
  if(strlen($patient_id)>=4){
      $pin=$patient_id;
     }       
                               ?>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">
                  
                                  <div class="profile-blog mb-5">
                                    <img src="images/patients/thumbs/<?php echo md5($patient_id).'.'.$ext.'?'.  time(); ?>" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname.' '.$secondname.' '.$thirdname; ?></h4>
                                                               
                                           </div>
                                </div>
                                </div>
                                </div>
                     <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Issue Drugs</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php                                
                                if(isset($_POST['drug'],$_POST['quantity'])){
                                      $drug=$_POST['drug'];
                                      $quantity=$_POST['quantity'];
                                    $serviceorder_id=$_POST['serviceorder_id'];
                                        $alldrugs=sizeof($drug);    
                                        mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                        for($i=0;$i<$alldrugs;$i++){   
                                            mysqli_query($con,"INSERT INTO issueddrugs(drug,quantity,patientsque_id,admin_id,status) VALUES('$drug[$i]','$quantity[$i]','$id','".$_SESSION['elcthospitaladmin']."','1')") or die(mysqli_error($con));
                                            // update the status of the ordered items
                                            mysqli_query($con,"UPDATE pharmacyordereditems SET status='2' WHERE pharmacyorder_id='$serviceorder_id' AND item_id='$drug[$i]'") or die(mysqli_error($con));
                                            // update the inventory items quantity
                                            mysqli_query($con,"UPDATE inventoryitems SET minimum=minimum-'$quantity[$i]' WHERE inventoryitem_id ='$drug[$i]'") or die(mysqli_error($con));
                                        } 
                                        $_SESSION['success'] =  '<div class="alert alert-success">Drugs Successfully Issued</div>';
                                        // redirect to doctorwaiting
                                        echo '<script>window.location.href = "pharmacywaiting";</script>'; 
                                       
                                }
                                ?>  
       
       <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
           
           <?php
               $getorder= mysqli_query($con, "SELECT * FROM pharmacyorders WHERE patientsque_id='$id'") or die(mysqli_error($con));
               $rowo = mysqli_fetch_array($getorder);
               $timestamp = $rowo['timestamp'];
               $serviceorder_id = $rowo['pharmacyorder_id'];
               $getordered = mysqli_query($con, "SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
               while ($row = mysqli_fetch_array($getordered)) {
                $medicalservice_id = $row['item_id'];
                $quantity = $row['quantity'];
                $prescription = $row['prescription'];
                $stotal =0; 
                $getdoctornotes= mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$prev_id' and drug!=''") or die(mysqli_error($con));
                $row12 = mysqli_fetch_array($getdoctornotes);
                $details = $row12['details'];

                $getservice = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id ='$medicalservice_id'");
                $row2 = mysqli_fetch_array($getservice);
                $medicalservice = $row2['itemname'];
                $measurement_id = $row2['measurement_id'];
                $unitcharge = $row2['unitprice'];
                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                $row2 =  mysqli_fetch_array($getunit);
                $measurement = $row2['measurement'];   
               ?>   
               
               <div class="row">
                <div class="col-sm-4">
                   <p><strong><?php echo $medicalservice.' : '.$prescription; ?></strong></p>
                </div>
                <div class="col-sm-4">
                      <p><strong>Dosage : <?php echo $quantity .' ('.$measurement.')' ?> </strong></p>
                </div>
                <div class="col-sm-3">
                        <p><strong>Doctor's Notes : <?php echo $details; ?></strong></p>
                </div>
                </div>
               </div>

                 
             <div class="row"> 
                <input type="hidden" name='drug[]' class="form-control"  value="<?php echo $medicalservice_id; ?>">                
                <input type="hidden" name='serviceorder_id' class="form-control"  value="<?php echo $serviceorder_id; ?>">                
                 <input type="text" class="form-control" placeholder="Enter Drug Quantity" required="required" readonly value="<?php echo $medicalservice; ?>"> 
                <div class="form-group col-lg-6">                 
               <label>Quantity</label>
                <input type="number" name='quantity[]' class="form-control" placeholder="Enter Drug Quantity" required="required">                                                                          
          </div>
	                    </div>
               <?php }?>
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
                   $('.reference').on('change', function() {
               var getselect=$(this).val();
                  if((getselect=='')){
                $('.pharmacy').hide();
           $('.forlab').hide();       
                  }
                   if((getselect=='pharmacy')){ 
                 $('.pharmacy').show();
             $('.subobj1_button').click(function(e){ //on add input button click
        e.preventDefault();  
        $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Drug Name</label>    <input type="text"  name="drug[]" class="form-control " placeholder="Enter Drug Name"></div>  <div class="form-group col-lg-6"> <label>Prescription</label>   <input type="text"  name="prescription[]" class="form-control " placeholder="Enter Prescription"></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
         });
          $('.subobj1').on("click",".remove_subobj1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
      $('.forlab').hide();
       }
          if((getselect=='lab')){
        $('.pharmacy').hide();
           $('.forlab').show();
          } 
        
     });
        </script>
</body>

</html>