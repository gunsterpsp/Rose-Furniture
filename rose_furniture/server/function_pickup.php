<?php

include '../database/connection.php';


if(isset($_POST['view_id'])){

    $order_id = $_POST['order_id'];

    $sql = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");

    $data = mysqli_fetch_assoc($sql);

echo json_encode($data);

}

if(isset($_POST['approve'])){

    $cart_id = $_POST['cart_id'];
    $order_text = $_POST['action_id'];
    $order_remarks = $_POST['location_id'];



    $insert = "INSERT INTO tbl_order_process (order_text, order_remarks, cart_id) 
    VALUES ('$order_text', '$order_remarks', '$cart_id')";
    mysqli_query($conn, $insert);


}


?>