<?php

include '../database/connection.php';



if(isset($_POST['approve'])){
        $order_id = $_POST['order_id'];

        $update = "UPDATE tbl_order_detail_items SET to_pay = 2, to_ship = 1
        WHERE order_id = $order_id ";
        mysqli_query($conn, $update);

        $select = mysqli_query($conn, "SELECT cart_id, user_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
        $fetchSelect = mysqli_fetch_assoc($select);

        $cart_id = $fetchSelect['cart_id'];

        $sqlCode = mysqli_query($conn, "SELECT detail_code FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'Order Placed' ");
        $fetchCode = mysqli_fetch_assoc($sqlCode);

        $detail_code = $fetchCode['detail_code'];



        $sqlUpdateNotif = "UPDATE tbl_notifications SET status = 0 WHERE detail_code = '$detail_code'";
        mysqli_query($conn, $sqlUpdateNotif);

        $insert = "INSERT INTO tbl_order_process 
        (order_text, detail_code, cart_id) VALUES ('Preparing To Ship', '$detail_code', '$cart_id')";
        mysqli_query($conn, $insert);

        
        $notification_text = "Your order has been approve with a tracking no : " . $detail_code;
        $user_id = $_SESSION['user_id'];

        $receiver_id = $fetchSelect['user_id'];
    
        $sqlInsertNotif = "INSERT INTO tbl_notifications 
        (notification_text, sender_id, receiver_id, detail_code)
        VALUES
        ('$notification_text', '$user_id', '$receiver_id', '$detail_code')";
        mysqli_query($conn, $sqlInsertNotif);

}




?>