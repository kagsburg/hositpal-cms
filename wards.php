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
    <title>Wards</title>
    <!-- Favicon icon -->
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
                            <h4>Wards</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Wards</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Wards</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" class="table table-striped" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Ward Name</th>
                                                <th>Ward type</th>
                                                <th>Beds</th>
                                                <th>Bed Fee</th>
                                                <th>Credit Fee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getwards =  mysqli_query($con, "SELECT * FROM wards WHERE status=1");
                                            while ($row = mysqli_fetch_array($getwards)) {
                                                $ward_id = $row['ward_id'];
                                                $wardtype_id = $row['wardtype_id'];
                                                $wardname = $row['wardname'];
                                                $bedfee = $row['bedfee'];
                                                $creditfee = $row['creditfee'];

                                                $gettype =  mysqli_query($con, "SELECT * FROM wardtypes WHERE status=1 AND wardtype_id='$wardtype_id'");
                                                $row1 =  mysqli_fetch_array($gettype);
                                                $wardtype_id = $row1['wardtype_id'];
                                                $wardtype = $row1['wardtype'];
                                                $getbeds = mysqli_query($con, "SELECT * FROM beds WHERE ward_id='$ward_id' AND status=1");
                                            ?>
                                                <tr>
                                                    <td><?php echo $wardname; ?></td>
                                                    <td><?php echo $wardtype; ?></td>
                                                    <td><?php echo mysqli_num_rows($getbeds); ?></td>
                                                    <td><?php echo $bedfee; ?></td>
                                                    <td><?php echo $creditfee; ?></td>
                                                    <td>
                                                        <button data-toggle="modal" data-target="#basicModal<?php echo $ward_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                                        <a href="beds?id=<?php echo $ward_id; ?>" class="btn btn-xs btn-primary">Beds</a>
                                                        <a href="removeward?id=<?php echo $ward_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $ward_id; ?>()">Remove</a>
                                                        <script type="text/javascript">
                                                            function confirm_delete<?php echo $ward_id; ?>() {
                                                                return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                            }
                                                        </script>
                                                        <a href="insurancewardcharges?id=<?php echo $ward_id; ?>" class="btn btn-xs btn-primary">Insurance Prices</a>

                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="basicModal<?php echo $ward_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Ward type</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="editward?id=<?php echo $ward_id; ?>" method="POST">
                                                                    <div class="form-group">
                                                                        <label>Ward Name</label>
                                                                        <input type="text" class="form-control" name="wardname" required="required" value="<?php echo $wardname; ?>">
                                                                    </div>
                                                                    <div class="form-group"><label class="control-label">* Ward Type</label>
                                                                        <select name="wardtype" class="form-control">
                                                                            <option value="<?php echo $wardtype_id; ?>" selected="selected"><?php echo $wardtype; ?></option>
                                                                            <?php
                                                                            $getcats =  mysqli_query($con, "SELECT * FROM wardtypes WHERE status=1");
                                                                            while ($row1 =  mysqli_fetch_array($getcats)) {
                                                                                $wardtype_id = $row1['wardtype_id'];
                                                                                $wardtype = $row1['wardtype'];                                                                                
                                                                            ?>
                                                                                <option value="<?php echo $wardtype_id; ?>"><?php echo $wardtype; ?></option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Bed Fee</label>
                                                                        <input type="text" class="form-control" name="bedfee" required="required" value="<?php echo $bedfee; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Credit Fee</label>
                                                                        <input type="text" class="form-control" name="creditfee" value="<?php echo $creditfee; ?>">
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
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>


    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>