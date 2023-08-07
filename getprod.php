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

?>