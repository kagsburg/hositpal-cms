<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Service Prices</title>
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
                            <h4>Medical Service Prices</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="serviceprices">Service Prices</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		
                            <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Insurance companies</h4>
                            </div>
                            <div class="card-body">
                 <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home1"><i class="fa fa-leaf mr-2"></i> Insured Services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile1"><i class="fa fa-heart-o mr-2"></i> Non Insured Services</a>
                                        </li>
                                     
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                            <div class="pt-4">
                                           <table id="example5" class="display" class="table table-striped"  style="width:100%;">
                        <thead>
                          <tr>                                        
                            <th>Company</th>                       
                              <th>Services</th>       
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getinsured=  mysqli_query($con,"SELECT * FROM insuredservices WHERE status=1 GROUP BY insurancecompany_id");
                            while( $row1=  mysqli_fetch_array($getinsured)){
                                              $insuredservice_id=$row1['insuredservice_id'];
                                              $insurancecompany_id=$row1['insurancecompany_id'];
                                       
                                   $getcompanies=  mysqli_query($con,"SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id");
                                         $row2=  mysqli_fetch_array($getcompanies);
                                        $company=$row2['company'];
                          
                                                         ?>
                          <tr>
                            <td><?php echo $company; ?></td>
                            <td><?php 
                              $getcompanyservices=mysqli_query($con,"SELECT * FROM insuredservices WHERE status=1 AND  insurancecompany_id='$insurancecompany_id'");    
                         $servicesarray=array();
                              while($row4= mysqli_fetch_array($getcompanyservices)){
                              $medicalservice_id=$row4['medicalservice_id'];
                                          $getmedicalservice=  mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                          $row3=  mysqli_fetch_array($getmedicalservice);
                                       $medicalservice=$row3['medicalservice'];
                                         array_push($servicesarray,$medicalservice);
                                                    }
                                                    $List = implode(', ', $servicesarray);   
print_r($List);
                            ?></td>
                        
                          
                            <td>
                                <button data-toggle="modal" data-target="#basicModal<?php echo $insuredservice_id; ?>"  class="btn btn-xs btn-info">Edit</button>
                                <a href="removeinsurancecompany?id=<?php echo $insuredservice_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $insuredservice_id;?>()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete<?php echo $insuredservice_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <div class="modal fade" id="basicModal<?php echo $insuredservice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Insurance company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editinsurancecompany?id=<?php echo $insurancecompany_id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Company</label>
                              <input type="text" class="form-control" name="company" required="required" value="<?php echo $company; ?>">
	                    </div>
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>                 
                          </form>
              </div>
           
            </div>
          </div>
        </div>
                            <?php }?>
                        </tbody>
                        </table>               
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile1">
                                            <div class="pt-4">
                                                                          <table id="example5" class="display" class="table table-striped"  style="width:100%;">
                        <thead>
                          <tr>                  
                              <th>Service</th>       
                              <th>Charge</th>       
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getnoninsured=  mysqli_query($con,"SELECT * FROM noninsuredservices WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getnoninsured)){
                                              $noninsuredservice_id=$row1['noninsuredservice_id'];
                                              $medicalservice_id=$row1['medicalservice_id'];                                       
                                              $charge=$row1['charge'];                                       
                              $getmedicalservice=  mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                          $row3=  mysqli_fetch_array($getmedicalservice);
                                       $medicalservice=$row3['medicalservice'];
                                                         ?>
                          <tr>
                            <td><?php echo $medicalservice; ?></td>
                            <td><?php echo $charge; ?></td>
                          
                            <td>
                                <button data-toggle="modal" data-target="#noninsured<?php echo $noninsuredservice_id; ?>"  class="btn btn-xs btn-info">Edit</button>
                                <a href="removenoninsuredservice?id=<?php echo $noninsuredservice_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $noninsuredservice_id;?>()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete<?php echo $noninsuredservice_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <div class="modal fade" id="noninsured<?php echo $noninsuredservice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Insurance company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editinsurancecompany?id=<?php echo $insurancecompany_id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Company</label>
                              <input type="text" class="form-control" name="company" required="required" value="<?php echo $company; ?>">
	                    </div>
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>                 
                          </form>
              </div>
           
            </div>
          </div>
        </div>
                            <?php }?>
                        </tbody>
                        </table>   
                                            </div>
                                        </div>
                                     
                                    </div>
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