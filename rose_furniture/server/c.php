<?php

include '../database/connection.php';

$order_id = $_POST['order_id'];

if(isset($_POST['approve'])){

        $update = "UPDATE tbl_order_detail_items SET to_pay = 2, to_ship = 1
        WHERE order_id = $order_id ";
        mysqli_query($conn, $update);

        $select = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
        $fetchSelect = mysqli_fetch_assoc($select);

        $insert = "INSERT INTO tbl_order_process 
        (order_text, detail_code, cart_id) VALUES ('Preparing To Ship', '', '".$fetchSelect['cart_id']."')";
        mysqli_query($conn, $insert);
}

if(isset($_POST['cancel'])){

        $update = "UPDATE tbl_order_detail_items SET to_pay = 0, to_ship = 1 
        WHERE order_id = $order_id ";
        mysqli_query($conn, $update);



}


?>