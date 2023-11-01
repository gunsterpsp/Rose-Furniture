<?php

include '../database/connection.php';


if(isset($_POST['view_id'])){

    $order_id = $_POST['order_id'];

    $select = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
    $fetchSelect = mysqli_fetch_assoc($select);

    $cart_id = $fetchSelect['cart_id'];

    $sqlMax = mysqli_query($conn, "SELECT MAX(id) as 'id' FROM tbl_order_process WHERE cart_id = $cart_id ");
    $lastId = mysqli_fetch_assoc($sqlMax);

    $id = $lastId['id'];

    $sqlMax1 = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE id = $id ");
    $SqlData = mysqli_fetch_assoc($sqlMax1);

    $sqlRider = mysqli_query($conn, "SELECT order_remarks FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'In Transit' ");
    $SqlRider = mysqli_fetch_assoc($sqlRider);

    $sqlGetTransaction = mysqli_query($conn, "SELECT detail_code FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'Order Placed' ");
    $sqlTrackNo = mysqli_fetch_assoc($sqlGetTransaction);

    $trackNo = $sqlTrackNo['detail_code'];

    $rider_name = $SqlRider['order_remarks'];

    $proof_image = $SqlData['proof_image'];
    $order_remarks = $SqlData['order_remarks'];
    $order_text = $SqlData['order_text'];

    $data = array(
        "proof_image"=> $proof_image,
        "order_remarks"=> $order_remarks,
        "rider_name"=> $rider_name,
        "tracking_no"=> $trackNo
    );


echo json_encode($data);

}


?>