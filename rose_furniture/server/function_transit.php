<?php

include '../database/connection.php';


if(isset($_POST['view_id'])){

    $order_id = $_POST['order_id'];

    $sql = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");

    $data = mysqli_fetch_assoc($sql);

echo json_encode($data);

}

if(isset($_POST['view_id2'])){

    $order_id = $_POST['order_id2'];

    $sql = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");

    $data = mysqli_fetch_assoc($sql);

echo json_encode($data);

}

if(isset($_POST['approve'])){

    $cart_id = $_POST['cart_id'];
    $rider_id = $_POST['rider_id'];

    $select = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = $rider_id ");
    $rowSelect = mysqli_fetch_assoc($select);
    
    $full_name = $rowSelect['first_name'] . ' ' . $rowSelect['last_name'];

    $sql = mysqli_query($conn, "SELECT MAX(id) as 'last_id' FROM tbl_order_process WHERE cart_id = $cart_id ");
    $row = mysqli_fetch_assoc($sql);

    $update = "UPDATE tbl_order_process SET status = 0 WHERE id = '".$row['last_id']."' ";
    mysqli_query($conn, $update);

    $update = "UPDATE tbl_order_detail_items SET in_transit = 2, to_deliver = 1, 
    group_code = 3, rider_id = '$rider_id' WHERE cart_id = $cart_id ";
    mysqli_query($conn, $update);


    $insert = "INSERT INTO tbl_order_process (order_text, order_remarks, cart_id) 
    VALUES ('In Transit', '$full_name', '$cart_id')";
    mysqli_query($conn, $insert);


}


if(isset($_POST['approve2'])){

    $cart_id = $_POST['cart_id2'];
    $rider_id = $_POST['rider_id2'];

    $select = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = $rider_id ");
    $rowSelect = mysqli_fetch_assoc($select);
    
    $full_name = $rowSelect['first_name'] . ' ' . $rowSelect['last_name'];

    $sql = mysqli_query($conn, "SELECT MAX(id) as 'last_id' FROM tbl_order_process WHERE cart_id = $cart_id ");
    $row = mysqli_fetch_assoc($sql);

    $update = "UPDATE tbl_order_process SET order_remarks = '$full_name' WHERE id = '".$row['last_id']."' AND order_text = 'In Transit' ";
    mysqli_query($conn, $update);


}



?>