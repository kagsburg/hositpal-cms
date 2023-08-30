<?php
include 'includes/conn.php';
if (isset($_POST['serviceid'])) {
    $serviceid = $_POST['serviceid'];
    $type = $_POST['type'];
    // set the service id and cost to session variable
    // $_SESSION['service']['serviceid'] = $_POST['serviceid'];
    $_SESSION['service'][$type][$serviceid] = $_POST['cost'];
    $items=array(
        'status'=>'success',
        'data'=>$_SESSION['service']

    );
    echo json_encode($items);
}
if (isset($_POST['removeid'])){
    $removeid = $_POST['removeid'];
    $type = $_POST['type'];
    unset($_SESSION['service'][$type][$removeid]);
    $items=array(
        'status'=>'success',
        'data'=>$_SESSION['service']

    );
    echo json_encode($items);
}

?>