<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';
$roles = array('lab technician', 'accountant', 'lab technologist');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}

$clinic_id = isset($_GET['id']) ? $_GET['id']: null;
$patient = get_active_clinic_patient($pdo, $clinic_id);
                                                        $pin = $patient['pin'];
                                                        $fullname = $patient['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lab Report Services</title>
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
                <div class="row">
                <div class="col-lg-4 mb-3">
                        <!-- <a href="printpaidbills.php?id=<?php echo $paymethod ?>&type=<?php echo $payment ?>" class="btn btn-primary">Print</a> -->
                       
                        
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Lab Records <?php echo $fullname ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example6" class="table  table-bordered display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Test done </th>
                                                <!-- <th>Full Names</th>
                                                <th>Gender</th> -->
                                                <th>Result </th>
                                                
                                                <th>Details</th>
                                                <!-- <th>Payment Mode</th>-->
                                                <!-- <th>Action</th>  -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $services = mysqli_query($con, "SELECT * FROM labreports where clinic=1 and patientsque_id='$clinic_id' ") or die(mysqli_error($con)); 
                                            while ($row = mysqli_fetch_array($services))  {
                                                $medicalservice_id = $row['test'];
                                                $rest= $row['result'];
                                                $det= $row['details'];
                                                $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                $row2 = mysqli_fetch_array($getservice);
                                                $medicalservice = $row2['investigationtype'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $medicalservice ?></td>
                                                    <!-- <td><?php echo $service['name'] ?></td>
                                                    <td><?php echo $service['gender'] ?></td> -->
                                                    <td><?php echo $rest ?></td>
                                                    <td><?php echo $det ?></td>
                                                    <!-- <td><?php echo $service['payment'] ?></td> -->
                                                    <!-- <td>
                                                        <a href="editlabrecord.php?id=<?php echo $service['id'] ?>" class="btn btn-primary">Edit</a>
                                                        <a href="deletelabrecord.php?id=<?php echo $service['id'] ?>" class="btn btn-danger">Delete</a>
                                                    </td> -->

                                                </tr>
                                            <?php } ?>
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