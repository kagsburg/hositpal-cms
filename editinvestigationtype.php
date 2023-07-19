    <?php
    include 'includes/conn.php';
    if (($_SESSION['elcthospitallevel'] != 'admin')) {
        header('Location:login.php');
    } else {
        $id = $_GET['id'];
        if (isset($_POST['typename'], $_POST['classification'], $_POST['unit'])) {
            $typename = mysqli_real_escape_string($con, trim($_POST['typename']));
            $classification = $_POST['classification'];
            $unit = $_POST['unit'];
            $unitprice = $_POST['unitprice'];
            if ((empty($typename)) || (empty($typename)) || (empty($unit))) {
                echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
            } else {

                mysqli_query($con, "UPDATE investigationtypes SET investigationtype='$typename',classification_id='$classification',unitprice='$unitprice',unit_id='$unit' WHERE investigationtype_id='$id'") or die(mysqli_error($con));
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    ?>