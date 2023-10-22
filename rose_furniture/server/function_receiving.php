<?php

include '../database/connection.php';



if(isset($_POST['approve'])){
        $order_id = $_POST['order_id'];

        $update = "UPDATE tbl_order_detail_items SET to_deliver = 2, to_complete = 1
        WHERE order_id = $order_id ";
        mysqli_query($conn, $update);

        $select = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
        $fetchSelect = mysqli_fetch_assoc($select);

        $insert = "INSERT INTO tbl_order_process 
        (order_text, , cart_id) VALUES ('Delivered', '', '".$fetchSelect['cart_id']."')";
        mysqli_query($conn, $insert);
}




?>