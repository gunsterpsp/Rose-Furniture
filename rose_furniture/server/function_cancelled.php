<?php
include '../database/connection.php';

if(isset($_POST['view_btn'])){
    $order_id = $_POST['order_id']; 

    $sql = mysqli_query($conn, "SELECT t1.date_cancelled, t1.order_id, t1.product_code, t1.product_name, 
    t1.price, t1.quantity, t1.user_id, t1.status, t2.product_image FROM 
    tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
    t1.product_code = t2.product_code WHERE t1.order_id = '$order_id' AND t1.status = 0 ");
    
    $data = mysqli_fetch_assoc($sql);

    echo json_encode($data);

}




?>
