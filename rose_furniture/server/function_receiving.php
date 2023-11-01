<?php

include '../database/connection.php';



if(isset($_POST['approve'])){
        $order_id = $_POST['order_id'];


        $select = mysqli_query($conn, "SELECT cart_id, detail_code, user_id FROM tbl_order_detail_items WHERE order_id = '$order_id' ");
        $fetchSelect = mysqli_fetch_assoc($select);

        $cart_id = $fetchSelect['cart_id'];
        $custId = $fetchSelect['user_id'];

        $sqlMax = mysqli_query($conn, "SELECT MAX(id) as 'id' FROM tbl_order_process WHERE cart_id = $cart_id ");
        $lastId = mysqli_fetch_assoc($sqlMax);

        $id = $lastId['id'];

        $user_id = $_SESSION['user_id'];
        $detail_code = $fetchSelect['detail_code'];
        $sqlName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '$user_id' ");
        $fetchName = mysqli_fetch_assoc($sqlName);
        $full_name = $fetchName['first_name'] .' '. $fetchName['last_name'];
        $notification_text = $full_name . ' has confirm the order ' . $detail_code;
        


        $insert = "INSERT INTO tbl_notifications 
        (notification_text, sender_id, receiver_id, detail_code) 
        VALUES ('$notification_text', '$user_id', '1', '$detail_code')";
        mysqli_query($conn, $insert);

        $notification_text2 = 'Your order with a tracking no ' . $detail_code . ' will be deliver by ' . $full_name;
        
        $insert2 = "INSERT INTO tbl_notifications 
        (notification_text, sender_id, receiver_id, detail_code) 
        VALUES ('$notification_text2', '$user_id', '$custId', '$detail_code')";
        mysqli_query($conn, $insert2);

        $update = "UPDATE tbl_order_process SET rider_status = 1, status = 0
        WHERE id = $id ";
        mysqli_query($conn, $update);

        $update2 = "UPDATE tbl_order_detail_items SET to_deliver = 2, to_complete = 1 WHERE order_id = $order_id ";
        mysqli_query($conn, $update2);



}




?>