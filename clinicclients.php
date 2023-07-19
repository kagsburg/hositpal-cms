<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Clinic Clients</title>
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
                            <h4>Clients</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Clients</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Clients</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Location</th>
                                                <th>Phone</th>
                                                <th>Blood Group</th>
                                                <th>Pregnancy Month</th>
                                                <th>Partner Name</th>
                                                <th>Partner Mobile</th>
                                                <!-- <th>Date Added</th> -->
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getpatients = mysqli_query($con, "SELECT * FROM clinic_clients WHERE status='1'");
                                            while ($row = mysqli_fetch_array($getpatients)) {
                                             $id = $row['id'];
                                             $name = $row['name'];
                                             $location = $row['location'];
                                             $phone = $row['phone'];
                                             $weight = $row['weight'];
                                             $bloodgroup = $row['bloodgroup'];
                                             $pregnancy_month = $row['pregnancy_month'];
                                             $partner_name = $row['partner_name'];
                                             $partner_mobile = $row['partner_mobile'];
                                             $timestamp = $row['timestamp'];

                                              

                                                if (strlen($id) == 1) {
                                                    $pin = '000' . $id;
                                                }
                                                if (strlen($id) == 2) {
                                                    $pin = '00' . $id;
                                                }
                                                if (strlen($id) == 3) {
                                                    $pin = '0' . $id;
                                                }
                                                if (strlen($id) >= 4) {
                                                    $pin = $id;
                                                }
                                            ?>
                                                <tr class="gradeA">                                                   
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $location; ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $bloodgroup; ?></td>
                                                    <td><?php echo $pregnancy_month; ?></td>
                                                    <td><?php echo $partner_name; ?></td>
                                                    <td><?php echo $partner_mobile; ?></td>
                                                    

                                                    <td>
                                                        <a href="clinicclient?id=<?php echo $id; ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i>View</a>
                                                        <?php
                                                        if ($_SESSION['elcthospitallevel'] == 'nurse') {
                                                        ?>
                                                            
                                                            <!-- <a href="editpatient?id=<?php echo $id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a> -->
                                                       
                                                            <a href="hideclinicclient?id=<?php echo $id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $id; ?>()">Remove</a>
                                                            <script type="text/javascript">
                                                                function confirm_delete<?php echo $id; ?>() {
                                                                    return confirm('You are about To Remove this client. Are you sure you want to proceed?');
                                                                }
                                                            </script>

                                                        <?php } ?>
                                                    </td>


                                                </tr>

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