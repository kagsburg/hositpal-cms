<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Unselective Services </title>
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
                            <h4>Unselective Services</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Unselective services</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Unselective Services</h4>
                            </div>
                            <div class="card-body">
                                <table id="example5" class="display" class="table table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Normal Charge</th>
                                            <th>Credit Price</th>
                                            <th>Section</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getmedicalservices =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=2");
                                        while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                            $medicalservice_id = $row1['medicalservice_id'];
                                            $medicalservice = $row1['medicalservice'];
                                            $charge = $row1['charge'];
                                            $creditprice = $row1['creditprice'];
                                            $section_id = $row1['section_id'];
                                            $getsection =  mysqli_query($con, "SELECT * FROM sections WHERE status=1 AND section_id='$section_id'");
                                            $row1 =  mysqli_fetch_array($getsection);
                                            $section = $row1['section'];
                                        ?>
                                            <tr>
                                                <td><?php echo $medicalservice; ?></td>
                                                <td><?php echo $charge; ?></td>
                                                <td><?php echo $creditprice; ?></td>
                                                <td><?php echo $section; ?></td>

                                                <td>
                                                    <button data-toggle="modal" data-target="#basicModal<?php echo $medicalservice_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                                    <a href="insuranceservicecharges?id=<?php echo $medicalservice_id; ?>" class="btn btn-xs btn-primary">Insurance Prices</a>


                                                </td>
                                            </tr>
                                            <div class="modal fade" id="basicModal<?php echo $medicalservice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Unselective Service</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="editmedicalservice?id=<?php echo $medicalservice_id; ?>" method="POST">

                                                                <div class="form-group">
                                                                    <label>Service</label>
                                                                    <input type="hidden" name="medicalservice" value="<?php echo $medicalservice; ?>">
                                                                    <input type="text" class="form-control" name="medicalservice_display" disabled value="<?php echo $medicalservice; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Section</label>
                                                                    <select name="section" class="sections form-control" required>
                                                                        <option value="">Select Section</option>
                                                                        <?php
                                                                        $getsections =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                                                                        while ($row1 =  mysqli_fetch_array($getsections)) {
                                                                            $dsection_id = $row1['section_id'];
                                                                            $dsection = $row1['section'];
                                                                        ?>
                                                                            <option value="<?php echo $dsection_id; ?>" <?php if ($dsection_id == $section_id) echo "selected";  ?>><?php echo $dsection; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Price Per Unit</label>
                                                                    <input type="text" class="form-control" name="charge" required="required" value="<?php echo $charge; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Credit Price</label>
                                                                    <input type="text" class="form-control" name="creditprice" required="required" value="<?php echo $creditprice; ?>">
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