<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';
$roles = array('lab technician', 'nurse', 'lab technologist');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}

$clinic_id = isset($_GET['id']) ? $_GET['id']: null;
$patient = get_active_clinic_patient($pdo, $clinic_id);
                                                        $pin = $patient['pin'];
                                                        $fullname = $patient['name'];
                                                        $location = $patient['location'];
                    $pregnancy_month = $patient['pregnancy_month'];
                    $bloodgroup = $patient['bloodgroup'];
                    $weight = $patient['weight'];
                    $dob = $patient['dob'];
                    $phone = $patient['phone'];
                    $partner_name = $patient['partner_name'];   
                    $partner_no= $patient['partner_mobile'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Nurse Report Services</title>
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
                            <h4>Clinic Patient</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Clinic Patient</a></li>
                        </ol>
                    </div>
                </div>
                <?php 
                    if (isset($_POST['submitclient'])){
                        $clinic_id = $_POST['clinic_id'];
                        $name = mysqli_real_escape_string($con, trim($_POST['name']));
                        $location = mysqli_real_escape_string($con, trim($_POST['location']));
                        $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                        $weight = mysqli_real_escape_string($con, trim($_POST['weight']));
                        $dob = mysqli_real_escape_string($con, trim($_POST['dob']));
                        $bloodgroup = mysqli_real_escape_string($con, trim($_POST['bloodgroup']));
                        $pregnancy_month = mysqli_real_escape_string($con, trim($_POST['pregnancy_month']));
                        $partner_name = mysqli_real_escape_string($con, trim($_POST['partner_name']));
                        $partner_mobile = mysqli_real_escape_string($con, trim($_POST['partner_mobile']));
                       
                        $update = update_clinic_patient($pdo, $clinic_id, $name, $weight, $bloodgroup, $pregnancy_month, $dob, $phone, $partner_name, $partner_mobile, $location);
                        if ($update) {
                            echo "<div class='alert alert-success'>Clinic Patient Updated Successfully</div>";
                        }else{
                            echo "<script>alert('Error Updating Clinic Patient')</script>";
                            echo "<script>location.href='viewnursereport?id=$clinic_id'</script>";
                        }       
                    }
                ?>
                <div class="row">
                <div class="col-lg-4 mb-3">
                        <!-- <a href="printpaidbills.php?id=<?php echo $paymethod ?>&type=<?php echo $payment ?>" class="btn btn-primary">Print</a> -->
                       <?php 
                         if ($patient['status'] == 2 || $patient['status'] == 4) {
                         
                       ?>
                        <div class="mb-3">

                        <a href="clinicclient?id=<?php echo $clinic_id ?>" class="btn btn-primary">Add Clinic Report</a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Clinic Records <?php echo $fullname ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="text-primary mt-4 mb-4">Patient Information</h4>
                                        <div class="profile-blog mb-5">
                                            <address>
                                                <p>Pin : <span><?php echo $pin; ?></span></p>
                                                <p>Full Name : <span><?php echo $fullname; ?></span></p>
                                                <p>Location : <span><?php echo $location; ?></span></p>
                                                <p>Partner Name : <span><?php echo $partner_name; ?></span></p>
                                                <p>Partner Number: <span><?php echo $partner_no; ?></span></p>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <h4 class="text-primary mt-4 mb-4">Medical Information</h4>
                                    <div class="profile-blog mb-5">
                                        <address>
                                            <p>Blood Group : <span><?php echo $bloodgroup; ?></span></p>
                                            <p>Weight (kgs)  : <span><?php echo $weight; ?></span></p>
                                            <p>pregnancy month : <span><?php echo $pregnancy_month; ?></span></p>
                                        </address>
                                    </div>
                                    </div>


                                </div>

                                <div class="mb-3">
                                <button data-toggle="modal" data-target="#basicModal<?php echo $clinic_id; ?>" class="btn btn-xs btn-info">Edit</button>

                                <div class="modal fade" id="basicModal<?php echo $clinic_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Clinic Client</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="clinic_id" value="<?php echo $clinic_id; ?>">
                                                            <div class="form-group"><label class="control-label">*Full Name</label>
                                 <input type="text" name='name' class="form-control" value="<?php echo $fullname ?>" placeholder="Enter client name" required="required">
                              </div>
                              <div class="form-group"><label class="control-label">* Location/Address</label>
                                 <input type="text" name='location' class="form-control"value="<?php echo $location ?>" placeholder="Enter location" required="required">
                              </div>
                              <div class="form-group"><label class="control-label">* Date of Birth</label>
                                 <input type="date" name='dob' class="form-control"value="<?php echo $dob ?>" placeholder="Enter location" required="required">
                              </div>

                              <div class="form-group"><label class="control-label">* Mobile Number</label>
                                 <input type="text" name='phone' value="<?php echo $phone ?>" class="form-control" placeholder="Enter contacts" required="required">
                              </div>
                              <div class="form-group"><label class="control-label">Weight</label>
                                 <input type="text" name='weight' value="<?php echo $weight ?>" class="form-control" placeholder="Enter weight">
                              </div>
                              <div class="form-group"><label class="control-label">Blood Group</label>
                                 <input type="text" name='bloodgroup'value="<?php echo $bloodgroup ?>" class="form-control" placeholder="Enter blood group">
                              </div>
                              <div class="form-group"><label class="control-label">Month Of Pregnancy</label>
                              <select class="form-control" name="pregnancy_month">
                                                            <option value="" selected="selected">Select Month</option>
                                                            <option value="January" <?php if ($pregnancy_month=='January') { ?> selected <?php } ?> >January</option>
                                                            <option value="February" <?php if ($pregnancy_month=='February') { ?> selected <?php } ?>>February</option>
                                                            <option value="March" <?php if ($pregnancy_month=='March') { ?> selected <?php } ?>>March</option>
                                                            <option value="April" <?php if ($pregnancy_month=='April') { ?> selected <?php } ?>>April</option>
                                                            <option value="May" <?php if ($pregnancy_month=='May') { ?> selected <?php } ?>>May</option>
                                                            <option value="June" <?php if ($pregnancy_month=='June') { ?> selected <?php } ?>>June</option>
                                                            <option value="July" <?php if ($pregnancy_month=='July') { ?> selected <?php } ?>>July</option>
                                                            <option value="August" <?php if ($pregnancy_month=='August') { ?> selected <?php } ?>>August</option>
                                                            <option value="September" <?php if ($pregnancy_month=='September') { ?> selected <?php } ?>>September</option>
                                                            <option value="October" <?php if ($pregnancy_month=='October') { ?> selected <?php } ?>>October</option>
                                                            <option value="November" <?php if ($pregnancy_month=='November') { ?> selected <?php } ?>>November</option>
                                                            <option value="December" <?php if ($pregnancy_month=='December') { ?> selected <?php } ?>>December</option>
                                                        </select>
                              </div>
                              <div class="form-group"><label class="control-label">Partner/Husband Names</label>
                                 <input type="text" name='partner_name'value="<?php echo $partner_name ?>" class="form-control" placeholder="Enter partner's name">
                              </div>
                              <div class="form-group"><label class="control-label">Partner/Husband Mobile</label>
                                 <input type="text" name='partner_mobile'value="<?php echo $partner_no ?>" class="form-control" placeholder="Enter partner's mobile number"></textarea>
                              </div>
                                                                
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit" name="submitclient">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            
                                <h4 class="card-title">Clinic Report</h4>
                               
                                <div class="table-responsive">
                                    <table id="example6" class="table  table-bordered display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                
                                                <th>Details</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $services = mysqli_query($con, "SELECT * FROM clinicreport where status=1 and clinic_client_id='$clinic_id' ") or die(mysqli_error($con)); 
                                            if (mysqli_num_rows($services) <=0) {
                                                echo '<tr><td colspan="2">No services found</td></tr>';
                                            }else{
                                            while ($row = mysqli_fetch_array($services))  {
                                                $service_name = $row['service_id'];
                                                // $cas = $row['casetype'];
                                                $det = $row['details'];
                                                // remove html tags
                                                $det = strip_tags($det);
                                                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE medicalservice_id='$service_name' AND status=1");
                                                // $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                $row2 = mysqli_fetch_array($getservice);
                                                $medicalservice = $row2['medicalservice'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $medicalservice ?></td>
                                                    <!-- <td><?php echo $service['name'] ?></td>
                                                    <td><?php echo $service['gender'] ?></td> -->
                                                    <!-- <td><?php echo $cas ?></td> -->
                                                    <td><?php echo $det ?></td>
                                                    <!-- <td><?php echo $service['payment'] ?></td> -->
                                                    <!-- <td>
                                                        <a href="editlabrecord.php?id=<?php echo $service['id'] ?>" class="btn btn-primary">Edit</a>
                                                        <a href="deletelabrecord.php?id=<?php echo $service['id'] ?>" class="btn btn-danger">Delete</a>
                                                    </td> -->

                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <!-- <tfoot>
                                        <tr>
                                            <th colspan="2">TOTAL</th>
                                            <td><?php echo number_format($total); ?></td>
                                            </tr>


                                        </tfoot> -->
                                    </table>
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

    <script>
        $(function() {
            $('#paymethod').change(function() {
                var chosenPaymethod = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('paymethod', chosenPaymethod);
                window.location.href = url.href;
            });
        })
    </script>
</body>

</html>