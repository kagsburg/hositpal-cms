<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Ambulant Patient Order</title>
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
  include 'fr/addambulantorder.php';                     
  }else{
?>
  <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Ambulant Patient Order</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="ambulantpatients">Ambulant Patients orders</a></li>
                            <li class="breadcrumb-item active"><a href="additem">Add order</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Item</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                  <?php
   if(isset($_POST['patientname'])){
    $patientname=mysqli_real_escape_string($con,trim($_POST['patientname']));
           $items=$_POST['items']; 
           $cpfigure=$_POST['cpfigure']; 
           $quantity=$_POST['quantity']; 
 if(empty($patientname)){
   $errors[]='Some Fields Are empty'; 
}

if(!empty($errors)){
foreach($errors as $error){ 
 ?>
 <div class="alert alert-danger"><?php echo $error; ?></div>
<?php 
}         }else{    
    $alldrugs= sizeof($items);
   $addorder=  mysqli_query($con,"INSERT INTO ambulantorders(patientname,processed,admin_id,timestamp,status) VALUES('$patientname','no','".$_SESSION['elcthospitaladmin']."','$timenow','0')") or die(mysqli_error($con));
   $last_id= mysqli_insert_id($con);
   for($i=0;$i<$alldrugs;$i++){
       $splitit= explode('_',$items[$i]);
       $item_id= current($splitit);
       $unitprice= end($splitit);
    mysqli_query($con,"INSERT INTO ambulantordereditems(ambulantorder_id,item_id,quantity,cpfigure,unitprice,status) VALUES('$last_id','$item_id','$quantity[$i]','$cpfigure[$i]','$unitprice','1')") or die(mysqli_error($con));
}  
   echo '<div class="alert alert-success">Order successfully Added.Click <a href="ambulantinvoice?id='.$last_id.'" target="_blank">Here</a> to Print Invoice</div>';                
         }
                                }
                                    ?>
   <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
           <div class='row'>
            <div class="form-group col-lg-8"><label class="control-label">*Patient's Name</label>
<input type="text" name='patientname' class="form-control" placeholder="Enter Patient's name" required="required">                                                                          
                                </div>
                                </div>
          
                                
         <div class='subobj'>
                         <div class='row'>
                   <div class="col-lg-12"><h3>Ordered Drugs</h3></div>       
                              <div class="col-lg-4 form-group">
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
                    <option value="<?php echo $pharmacyitem_id.'_'.$unitprice; ?>"><?php echo $commercialname.' ('.$pharmaceuticalform.')'?></option>
                                     <?php }?>
           </select>
                   </div>
              <div class="col-lg-4 form-group">
                  <label>Quantity</label>
                  <input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity">
              </div>
                <div class="col-lg-3 form-group">
                 <label>CP Figure</label>
                  <input type="text" class="form-control" name="cpfigure[]" placeholder="Enter CP Figure">
                                   </div>
                <div class="form-group col-lg-1">
                                                         <a href='#' class="subobj_button btn btn-success btn-xs" style="margin-top:30px">+</a>                                              
                                            </div> 
                                            </div> 
                                </div>
           <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add Item</button>
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
        $('.subobj').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row"> <div class="col-lg-4 form-group"> <label>Item (dosage)</label><select name="items[]" data-placeholder="Choose item..." class="chosen-select" style="width:100%;"> <option value="" selected="selected">select item...</option>   <?php          $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ");    while ($row = mysqli_fetch_array($getitems)) {      $pharmacyitem_id=$row['pharmacyitem_id'];   $commercialname=$row['commercialname'];   $dosage=$row['dosage'];    $pharmaceuticalform_id=$row['pharmaceuticalform_id'];           $getcats=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");   $row1=  mysqli_fetch_array($getcats);               $pharmaceuticalform=$row1['pharmaceuticalform'];  ?>     <option value="<?php echo $pharmacyitem_id.'_'.$unitprice; ?>"><?php echo trim(preg_replace('/[^a-zA-Z0-9\-]/', ' ', $commercialname)).' ('.$pharmaceuticalform.')'?></option>  <?php }?>  </select>     </div><div class="form-group col-lg-4"><label>Quantity</label>    <input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity"> </div> <div class="form-group col-lg-4">  <label>CP Figure</label>    <input type="text" class="form-control" name="cpfigure[]" placeholder="Enter CP Figure"></div></div> </div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:22px"><i class="fa fa-minus"></i></button></div>'); //add input box
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