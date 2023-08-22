<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
   header('Location:login.php');
}
$id = $_GET['id'];
$getinvestigation =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$id'");
$row1 =  mysqli_fetch_array($getinvestigation);
$investigation_id = $row1['investigationtype_id'];
$investigation = $row1['investigationtype'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title><?php echo $investigation; ?> Answers</title>
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
                     <h4><?php echo $investigation; ?> Answers</h4>

                  </div>
               </div>
               <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index">Home</a></li>
                     <li class="breadcrumb-item"><a href="investigationtypes">Investigation Types</a></li>
                     <li class="breadcrumb-item active"><a href="#">Answer</a></li>
                  </ol>
               </div>
            </div>

            <div class="row mb-2">
               <div class="col-sm-12">
                  <button type="button" data-toggle="modal" data-target="#addPriceModal" class="btn btn-xs btn-info">Add Answer</button>
               </div>   
            </div>

            <div class="row">

               <div class="col-lg-10">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title"><?php echo $investigation; ?> Answer</h4>
                     </div>
                     <div class="card-body">

                        <table id="example5" class="display" class="table table-striped" style="width:100%;">
                           <thead>
                              <tr>
                                 <th>Answer</th>
                                 <!-- <th>Normal</th>
                                 <th>High</th> -->
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $getinsured =  mysqli_query($con, "SELECT * FROM investigationselect WHERE status=1 AND investigationtype_id='$id'");
                              while ($row1 =  mysqli_fetch_array($getinsured)) {
                                 $insured_id = $row1['investigationselect_id'];
                                 $answer = $row1['answer'];
                                                                   
                              ?>
                                 <tr>
                                    <td><?php echo $answer; ?></td>
                                    

                                    <td>
                                       <button data-toggle="modal" data-target="#basicModal<?php echo $insured_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                       <a href="removeanswer?id=<?php echo $insured_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $insured_id; ?>()">Remove</a>

                                       <script type="text/javascript">
                                          function confirm_delete<?php echo $insured_id; ?>() {
                                             return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                          }
                                       </script>

                                    </td>
                                 </tr>
                                 <div class="modal fade" id="basicModal<?php echo $insured_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">Edit Range Value</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form action="editanswerinvest?id=<?php echo $insured_id ?>" method="POST">
                                               
                                                <div class="form-group">
                                                    <label>Answer</label>
                                                    <input type="text" class="form-control" name="answer2" value="<?php echo $answer ?>" required="required">
                                                </div>
                                            
                                                <div class="form-group">
                                                   <button class="btn btn-primary" type="submit">Submit</button>
                                                </div>
                                             </form>
                                          </div>

                                       </div>
                                    </div>
                                 </div>
                              <?php } ?>
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
               <h5 class="modal-title" id="addPriceModalLabel">Add Answer</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="addinvestanswer?id=<?php echo $id; ?>" method="POST">
                  
                  <div class="form-group">
                     <label>Answer</label>
                     <input type="text" class="form-control" name="answer" required="required">
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