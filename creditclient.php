<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Credit Client</title>
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
                            <?php
                            $getclient = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 AND creditclient_id='$id'");
                            $row = mysqli_fetch_array($getclient);
                            $creditclient_id = $row['creditclient_id'];
                            $clientname = $row['clientname'];
                            $contacts = $row['contacts'];
                            $email = $row['email'];
                            $details = $row['details'];
                            $location = $row['location'];
                            ?>
                            <h4><?php echo $clientname; ?></h4>

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
                    <?php
                    $getcredit = mysqli_query($con, "SELECT SUM(amount) AS addedcredit FROM clientcredits WHERE creditclient_id='$id'") or die(mysqli_error($con));
                    $row = mysqli_fetch_array($getcredit);
                    $addedcredit = $row['addedcredit'];
                    $getused = mysqli_query($con, "SELECT SUM(amount) AS creditused FROM usedcredit WHERE creditclient_id='$id'") or die(mysqli_error($con));
                    $row2 = mysqli_fetch_array($getused);
                    $creditused = $row2['creditused'];
                    $creditavailable = $addedcredit - $creditused;
                    ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget-stat card bg-info">
                            <div class="card-body  p-3">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Available Credit</p>
                                        <h3 class="text-white"><?php echo $creditavailable; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget-stat card bg-warning">
                            <div class="card-body  p-3">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-folder-open"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">Used Credit</p>
                                        <h3 class="text-white"><?php echo $creditused; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <button data-toggle="modal" data-target="#addcredit" class="btn btn-success">Add Credit</button>
                        <div class="card mt-2">

                            <div class="card-header">
                                <h4 class="card-title">Credit Addition History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" class="table table-striped" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getadded = mysqli_query($con, "SELECT * FROM clientcredits WHERE creditclient_id='$id' AND status=1") or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($getadded)) {
                                                $amount = $row['amount'];
                                                $date = $row['date'];
                                            ?>
                                                <tr>
                                                    <td><?php echo date('d/M/Y', $date); ?></td>
                                                    <td><?php echo number_format($amount); ?></td>
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
        <div class="modal fade" id="addcredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Credit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="addcredit?id=<?php echo $id; ?>" method="POST">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" required="required">
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