<?php

include '../database/connection.php';

if(isset($_POST['view_id'])){

        $cart_id = $_POST['cart_id'];

        $sql = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'Delivered' ");
    
        $data = mysqli_fetch_assoc($sql);
    
    echo json_encode($data);
}

if(isset($_POST['refundBtn'])){
    $refund_text = $_POST['refund_text'];
    $track_no = $_POST['track_no'];
    $cart_id = $_POST['cart_id'];

    $sqlUpdate = "UPDATE tbl_order_detail_items SET refund_status = 2 WHERE detail_code = '$track_no' ";
    mysqli_query($conn, $sqlUpdate);

    $sqlName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '".$_SESSION['user_id']."' ");
    $fetchName = mysqli_fetch_assoc($sqlName);

    $full_name = 'Request of refund by ' . $fetchName['first_name'] . ' ' . $fetchName['last_name'];

    $sqlInsert = "INSERT INTO tbl_order_process 
    (order_text, order_remarks, detail_code, cart_id) 
    VALUES 
    ('Refund', '$full_name', '$track_no', '$cart_id')";
    mysqli_query($conn, $sqlInsert);

    $notification_text = 'You have a for refund Order No. ' . $track_no;
    $user_id = $_SESSION['user_id'];

    $insertNotif = "INSERT INTO tbl_notifications 
    (notification_text, sender_id, receiver_id, detail_code)
    VALUES
    ('$notification_text', '$user_id', '1', '$track_no')";
    mysqli_query($conn, $insertNotif);

    $sqlInsertRefund = "INSERT INTO tbl_refund_reason 
    (refund_text, cart_id, detail_code)
    VALUES
    ('$refund_text', '$cart_id', '$track_no')";
    mysqli_query($conn, $sqlInsertRefund);


}

if(isset($_POST['view_Refund'])){

    $cart_id = $_POST['cart_id'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'Refunded' ");

    $data = mysqli_fetch_assoc($sql);

echo json_encode($data);
}

?>