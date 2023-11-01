<?php

include '../database/connection.php';

if(isset($_POST['view_id'])){

        $order_id = $_POST['order_id'];

        $sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE order_id = $order_id ");
    
        $data = mysqli_fetch_assoc($sql);
    
    echo json_encode($data);
}

if(isset($_POST['approve'])){
        $order_id = $_POST['order_id'];


        $select = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
        $fetchSelect = mysqli_fetch_assoc($select);

        $cart_id = $fetchSelect['cart_id'];

        $sqlMax = mysqli_query($conn, "SELECT MAX(id) as 'id' FROM tbl_order_process WHERE cart_id = $cart_id ");
        $lastId = mysqli_fetch_assoc($sqlMax);

        $id = $lastId['id'];

        $update = "UPDATE tbl_order_process SET rider_status = 1, status = 0
        WHERE id = $id ";
        mysqli_query($conn, $update);

        $update2 = "UPDATE tbl_order_detail_items SET to_deliver = 2, to_complete = 1 WHERE order_id = $order_id ";
        mysqli_query($conn, $update2);

}

if(isset($_POST['view_proof'])){

        $order_id = $_POST['order_id'];

        $select = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
        $fetchSelect = mysqli_fetch_assoc($select);

        $cart_id = $fetchSelect['cart_id'];

        $sqlMax = mysqli_query($conn, "SELECT MAX(id) as 'id' FROM tbl_order_process WHERE cart_id = $cart_id ");
        $lastId = mysqli_fetch_assoc($sqlMax);

        $id = $lastId['id'];

        $sqlMax1 = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE id = $id ");
        $data = mysqli_fetch_assoc($sqlMax1);


    
    echo json_encode($data);
}


?>