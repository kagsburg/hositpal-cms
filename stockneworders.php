<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && (($_SESSION['elcthospitallevel'] != 'store manager')) && (($_SESSION['elcthospitallevel'] != 'pharmacist'))&& (($_SESSION['elcthospitallevel'] != 'head physician'))) {
    header('Location:login.php');
}
$ty= isset($_GET['ty']) ? $_GET['ty']: '';
$type = mysqli_escape_string($con,$ty);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Requisitions</title>
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
                            <h4>Requisitions</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="pharmacyorders">Requisitions</a></li>
                        </ol>
                    </div>
                </div>
                <?php
                if (isset($_POST['updaterequis'])){
                    $ordereditem_id = $_POST['ordereditem_id'];
                    $quantity = $_POST['quantity'];
                    $item_id = $_POST['item_id'];
                    $itemname = $_POST['itemname'];
                    foreach($ordereditem_id as $key => $value){
                        $ordereditem = mysqli_real_escape_string($con,$value);
                        $quant = mysqli_real_escape_string($con,$quantity[$value]);
                        $item_id2= mysqli_real_escape_string($con,$item_id[$value]);
                        $itemname2 = mysqli_real_escape_string($con,$itemname[$value]);
                        
                        $update = mysqli_query($con,"UPDATE ordereditems SET quantity='$quant' WHERE ordereditem_id='$ordereditem'") or die(mysqli_error($con));
                        if ($update){

                        }
                    }
                   echo "<div class='alert alert-success'> Requisition Updated Successfully</div>";
                }

                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Requisitions</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example6" class="display">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Date</th>
                                                <th>Ordered by</th>
                                                <th>Items</th>
                                                <th>Section</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($type == 'Medical' || $type == 'Medicine'){
                                                $section = 'and section= "pharmacy"';
                                            }else{
                                                $section ='';
                                            }
                                            if ($type == ""){
                                                $mtype = "";
                                            }else{
                                                $mtype ="AND type='$type'";
                                            }
                                            if (($_SESSION['elcthospitallevel'] == 'admin') || ($_SESSION['elcthospitallevel'] != 'head physician')){
                                                $getordered = mysqli_query($con, "SELECT * FROM stockorders WHERE status IN(1,0) $mtype ") or die(mysqli_error($con));

                                            }else{
                                                $getordered = mysqli_query($con, "SELECT * FROM stockorders WHERE status IN(1,0) $mtype $section ") or die(mysqli_error($con));

                                            }
                                            while ($row = mysqli_fetch_array($getordered)) {
                                                $stockorder_id = $row['stockorder_id'];
                                                $timestamp = $row['timestamp'];
                                                $admin_id = $row['admin_id'];
                                                $status = $row['status'];
                                                $section = $row['section'];
                                                $type = $row['type'];
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1  AND staff_id='$admin_id'");
                                                $row1 = mysqli_fetch_array($getstaff);
                                                $fullname = $row1['fullname'];
                                                if (strlen($stockorder_id) == 1) {
                                                    $pin = '000' . $stockorder_id;
                                                }
                                                if (strlen($stockorder_id) == 2) {
                                                    $pin = '00' . $stockorder_id;
                                                }
                                                if (strlen($stockorder_id) == 3) {
                                                    $pin = '0' . $stockorder_id;
                                                }
                                                if (strlen($stockorder_id) >= 4) {
                                                    $pin = $stockorder_id;
                                                }
                                                $getitems = mysqli_query($con, "SELECT * FROM ordereditems WHERE stockorder_id='$stockorder_id'");
                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $pin; ?></td>
                                                    <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo mysqli_num_rows($getitems); ?></td>
                                                    <td><?php echo $section; ?></td>
                                                    <td><?php if ($status == 1) {
                                                            echo '<strong class="text-success">Approved</strong>';
                                                        } else {
                                                            echo '<strong class="text-warning">PENDING</strong>';
                                                        } ?></td>


                                                    <td>
                                                        <a href="ordereditems?id=<?php echo $stockorder_id; ?>&st=<?php echo $status; ?>&ty=<?php echo $type ?>&section=<?php echo $section ;?>" class="btn btn-primary btn-xs">Details</a>
                                                        <?php
                                                        if(($status==0)&&($_SESSION['elcthospitallevel']=='admin' || $_SESSION['elcthospitallevel']=='head physician')){
                                                        ?>
                                                            <a href="cancelrequest?id=<?php echo $stockorder_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_cancel<?php echo $stockorder_id; ?>()">Cancel</a>
                                                            <button data-toggle="modal" data-target="#completeRegistrationModal<?php echo $stockorder_id; ?>" class="btn btn-info btn-xs" type="button" >Edit</button>
                                                            
                                                        
                                                        <script type="text/javascript">
                                                            function confirm_cancel<?php echo $stockorder_id; ?>() {
                                                                    return confirm('You are about To Cancel this List. Are you sure you want to proceed?');
                                                                }
                                                            function confirm_approve<?php echo $stockorder_id; ?>() {
                                                            return confirm('You are about To Approve this List. Are you sure you want to proceed?');
                                                            }
                                                            </script>
                                                        
                                                        <?php }
                                                        if (($status == 0) &&($_SESSION['elcthospitallevel']=='pharmacist')){
                                                        ?>
                                                            <button data-toggle="modal" data-target="#completeRegistrationModal<?php echo $stockorder_id; ?>" class="btn btn-info btn-xs" type="button" >Edit</button>

                                                            <!-- <a href="editpharorder?id=<?php echo $stockorder_id; ?>&ty=<?php echo $type; ?>" class="btn btn-info btn-xs">Edit</a> -->
                                                            <a href="cancelrequest?id=<?php echo $stockorder_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_cancel<?php echo $stockorder_id; ?>()">Delete</a>
                                                            <script type="text/javascript">
                                                            function confirm_cancel<?php echo $stockorder_id; ?>() {
                                                                    return confirm('You are about To Cancel this List. Are you sure you want to proceed?');
                                                                }
                                                            </script>
                                                            <?php } 
                                                            if ($status == 1 ){
                                                                ?>
                                                                <a href="printrequisorder?id=<?php echo $stockorder_id; ?>" class="btn btn-info btn-xs">Print</a>
                                                                <?php }?>

                                                                <div class="modal fade" id="completeRegistrationModal<?php echo $stockorder_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Requisition</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <form action="" method="POST">
                                                                            <div class="row">
                                                                            <?php
                                                                            $ordereditems = mysqli_query($con, "SELECT * FROM ordereditems WHERE stockorder_id='$stockorder_id'") or die(mysqli_error($con));
                                                                            while ($row1 = mysqli_fetch_array($ordereditems)) {
                                                                                $id = $row1['ordereditem_id'];
                                                                                $quantity = $row1['quantity'];
                                                                                $item_id = $row1['item_id'];
                                                                                $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$item_id'");
                                                                                $row = mysqli_fetch_array($getitems);
                                                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                                                $itemname = $row['itemname'];
                                                                                $measurement_id = $row['measurement_id'];
                                                                                $minimum = $row['minimum'];
                                                                                $unitprice = $row['unitprice'];
                                                                                $subcategory_id = $row['subcategory_id'];                                                                              

                                                                            ?>

                                                                        <div class="form-group col-sm-6">
                                                                            <input type="hidden" name="ordereditem_id[]" value="<?php echo $id; ?>" class="form-control" required>  
                                                                            <label> Item Name</label>
                                                                            <input type="hidden" name="item_id[<?php echo $id; ?>]" value="<?php echo $item_id; ?>" class="form-control" required>
                                                                            <input type="text" name="itemname[<?php echo $id; ?>]" value="<?php echo $itemname; ?>" class="form-control" readonly>
                                                                           
                                                                        </div>
                                                                        <div class="form-group col-sm-6">
                                                                            <label>Quantity</label>
                                                                            <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $quantity; ?>" class="form-control" required>
                                                                        </div>
                                                                        <?php } ?>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <button class="btn btn-primary" type="submit" name="updaterequis">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
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
    <script>
        $('#example6').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
    </script>

    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>