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
    <title>Request Medication</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
           <link href="css/chosen/chosen.css" rel="stylesheet">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
 
	<link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
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

    <div id="main-wrapper">
<?php 
include 'includes/header.php';
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
  include 'fr/requestmedication.php';                     
  }else{
?>
  <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-5 p-md-0">
                        <div class="welcome-text">
                            <h4>Request Medication</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-7 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="admitted">Admitted Patients</a></li>
                            <li class="breadcrumb-item"><a href="admission?id=<?php echo $id; ?>">Details</a></li>
                            <li class="breadcrumb-item active"><a href="#">Request Medication</a></li>
                        </ol>
                    </div>
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
                                $firstname=$row2['firstname'];    
                            $headfirstname= $row2['headfirstname'];    
                            $lastname= $row2['lastname'];    
                            $headlastname=$row2['headlastname'];    
                              $age=$row2['age'];    
                              $agecategory=$row2['agecategory'];    
                            $gender=$row2['gender'];    
                            $referred=$row2['referred'];   
                            $province=$row2['province'];    
                            $town=$row2['town'];    
                            $zone=$row2['zone'];    
                              $quarter=$row2['quarter'];    
                             $agegroup=$row2['agegroup'];    
                            $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));                        
                            $rows= mysqli_fetch_array($getstaff);
                            $fullname=$rows['fullname'];
                 $getbed= mysqli_query($con,"SELECT * FROM beds WHERE bed_id='$bed_id' AND status=1") or die(mysqli_error($con));
     $rowb= mysqli_fetch_array($getbed);
     $ward_id=$rowb['ward_id'];
     $bednumber=$rowb['bednumber'];
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
     $getgroups= mysqli_query($con,"SELECT * FROM agegroups WHERE status=1 AND agegroup_id='$agegroup'") or die(mysqli_error($con));
                                           $row1= mysqli_fetch_array($getgroups);
                                                $agegroup_id=$row1['agegroup_id'];
                                                $agegroup1=$row1['agegroup'];
                                                $code1=$row1['code'];
                   ?>
       		<div class="row">
                     <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Request Medication for <?php echo $firstname.' '.$lastname; ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                  <?php
   if(isset($_POST['submit'])){
             $items=$_POST['items']; 
            $quantity=$_POST['quantity']; 
   $alldrugs= sizeof($items);
   $addorder=  mysqli_query($con,"INSERT INTO nurseorders(admitted_id,admin_id,timestamp,status) VALUES('$id','".$_SESSION['elcthospitaladmin']."','$timenow','0')") or die(mysqli_error($con));
   $last_id= mysqli_insert_id($con);
   for($i=0;$i<$alldrugs;$i++){
       $splitit= explode('_',$items[$i]);
       $item_id= current($splitit);
       $unitprice= end($splitit);
    mysqli_query($con,"INSERT INTO nurseordereditems(nurseorder_id,item_id,quantity,unitprice,status) VALUES('$last_id','$item_id','$quantity[$i]','$unitprice','1')") or die(mysqli_error($con));
}  
   echo '<div class="alert alert-success">Order successfully Added.</div>';                
            }
         ?>
   <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
       <div class='subobj'>
                         <div class='row'>
                   <div class="col-lg-12"><h3>Order Medication</h3></div>       
                              <div class="col-lg-6 form-group">
                   <label>Item (Form)</label>
                <select name="items[]" data-placeholder="Choose item..." class="form-control chosen-select" style="width:100%;">
                    <option value="" selected="selected">select item...</option>
                     <?php 
                                 $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ");  
                                     while ($row = mysqli_fetch_array($getitems)) {
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $pharmacologicalclass_id=$row['pharmacologicalclass_id'];
                                          $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                          $dosage=$row['dosage'];
                                          $unitprice=$row['unitprice'];
                                                   $getcats=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                          $row1=  mysqli_fetch_array($getcats);
                                          $pharmaceuticalform=$row1['pharmaceuticalform'];
                                                  ?>
                    <option value="<?php echo $pharmacyitem_id.'_'.$unitprice; ?>"><?php echo $commercialname.' ('.$pharmaceuticalform.')'; ?></option>
                                     <?php }?>
           </select>
                   </div>
              <div class="col-lg-5 form-group">
                  <label>Quantity</label>
                  <input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity">
              </div>
              
                <div class="form-group col-lg-1">
                                                         <a href='#' class="subobj_button btn btn-success btn-xs" style="margin-top:30px">+</a>                                              
                                            </div> 
                                            </div> 
                                </div>
           <div class="form-group">
               <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                                                  </div>
                            </form>
                                </div>
                            </div>
                        </div>
	</div>
                     
                            </div>
			   </div>
            </div>
                                       <?php }?>
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
   <script src="js/chosen/chosen.jquery.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
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
        $('.subobj').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row"> <div class="col-lg-6 form-group"> <label>Item (Form)</label><select name="items[]" data-placeholder="Choose item..." class="chosen-select" style="width:100%;"> <option value="" selected="selected">select item...</option>   <?php          $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ");    while ($row = mysqli_fetch_array($getitems)) {      $pharmacyitem_id=$row['pharmacyitem_id'];   $commercialname=$row['commercialname'];   $dosage=$row['dosage'];    $pharmaceuticalform_id=$row['pharmaceuticalform_id'];           $getcats=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");   $row1=  mysqli_fetch_array($getcats);               $pharmaceuticalform=$row1['pharmaceuticalform'];  ?>     <option value="<?php echo $pharmacyitem_id.'_'.$unitprice; ?>"><?php echo trim(preg_replace('/[^a-zA-Z0-9\-]/', ' ', $commercialname)).' ('.$pharmaceuticalform.')'?></option>  <?php }?>  </select>     </div><div class="form-group col-lg-6"><label>Quantity</label>    <input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity"> </div> </div> </div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:30px"><i class="fa fa-minus"></i></button></div>'); //add input box
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