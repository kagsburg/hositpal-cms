<?php
include 'includes/conn.php';
if (isset($_POST['prodid'])) {
    $items=array();
    $prodid = $_POST['prodid'];
    $sql = "SELECT *, sum(quantity)as total FROM stockitems WHERE product_id = '$prodid' and status = '1' and store=3 order by expiry desc";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    // check the issued out stock items
    $getissueditems = mysqli_query($con, "SELECT * FROM ordereditems where item_id='$prodid'");

    $totalissued =0;
    if (mysqli_num_rows($getissueditems) > 0) {
        while ($row = mysqli_fetch_assoc($getissueditems)) {
            $getissued = mysqli_query($con, "SELECT * FROM stockorders where status=1 and stockorder_id ='" . $row['stockorder_id'] . "'");
            if (mysqli_num_rows($getissued) > 0) {
                while ($row2 = mysqli_fetch_assoc($getissued)) {
                    $totalissued = $totalissued + $row['quantity'];
                }
            }
        }
    }
    // foreach ($items as $key => $value) {
    //     $items[$key]['totalissued'] = $totalissued;
    // }
    $data = array(
        'items' => $items,
        'totalissued' => $totalissued,
        'status' => 'success'
    );
    echo json_encode($data);
}
if (isset($_POST['drug'])){
    $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 and inventoryitem_id='" . $_POST['drug'] . "'");
    $row = mysqli_fetch_assoc($getitems);
    $inventoryitem_id = $row['inventoryitem_id'];
    $itemname = $row['itemname'];
    $measurement_id = $row['measurement_id'];
    $type = $row['type'];
    $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
    $row2 =  mysqli_fetch_array($getunit);
    $measurement = $row2['measurement'];
        
        $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock,expiry FROM stockitems WHERE product_id='$inventoryitem_id' and store =2 and status=1") or die(mysqli_error($con));
        
        $row3 = mysqli_fetch_array($getstock);
        $totalstock = $row3['totalstock'];
        $exipry = $row3['expiry'];
        $totalordered = 0;
        $getordered = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id'") or die(mysqli_error($con));
        while ($row4 = mysqli_fetch_array($getordered)) {
            $stockorder_id = $row4['stockorder_id'];
            $quantity = $row4['quantity'];
            $getorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND status=1");
            if (mysqli_num_rows($getorder) > 0) {
                $totalordered = $totalordered + $quantity;
            }
           
        }
        $issued = mysqli_query($con, "SELECT * FROM issueddrugs WHERE drug='$inventoryitem_id' AND status=1");
        while ($row5 = mysqli_fetch_array($issued)) {
            $quantity = $row5['quantity'];
            $totalordered = $totalordered + $quantity;
        }
        $instock = $totalstock - $totalordered;
        $data = array(
            'itemname' => $itemname,
            'measurement' => $measurement,
            'type' => $type,
            'instock' => $instock,
            'expiry' => $exipry,
            'status' => 'success'
        );
        echo json_encode($data);

}

?>