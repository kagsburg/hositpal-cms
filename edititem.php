<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
} else {
    $id = $_GET['id'];
    if (isset($_POST['itemname'], $_POST['minimum'], $_POST['unitprice'], $_POST['unitmeasurement'])) {
        $itemname = mysqli_real_escape_string($con, trim($_POST['itemname']));
        $minimum = $_POST['minimum'];
        $subcategory = $_POST['subcategory'];
        $unitprice = $_POST['unitprice'];
        $creditprice = $_POST['creditprice'];
        $strength = mysqli_real_escape_string($con, trim($_POST['strength']));
        $unitmeasurement = $_POST['unitmeasurement'];

        if ((is_numeric($minimum) == FALSE) || ((is_numeric($unitprice) == FALSE))) {
            $errors[] = 'Minimum Value or Unit Price should be Numeric';
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
<?php
            }
        } else {
            mysqli_query($con, "UPDATE inventoryitems SET itemname='$itemname',subcategory_id='$subcategory',unitprice='$unitprice',strength='$strength',measurement_id='$unitmeasurement',minimum='$minimum',creditprice='$creditprice' WHERE inventoryitem_id='$id'");
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>