<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE to_pay = 1 AND status = 1 ");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{
$approve = "<button class='btn btn-success approve' 
data-id='".$row['order_id']."' data-code='".$row['detail_code']."'>
<i class='bx bx-check'></i></button>
<button class='btn btn-danger cancel' 
data-id='".$row['order_id']."' data-code='".$row['detail_code']."'>
<i class='bx bx-x'></i></button>";

$action = "
<div class='d-flex bd-highlight gap-2'>
    ".$approve."
</div>";

$data[] = array(
  "order_id"=> $row['order_id'],
  "product_code"=> $row['product_code'],
  "product_name"=> $row['product_name'],
  "price"=> '₱'.$row['price'],
  "quantity"=> $row['quantity'],
  "total_amount"=> '₱'.$row['price'] * $row['quantity'],
  "payment_method"=> $row['payment_method'],
  "tracking_no"=> $row['detail_code'],
  "action"=> $action,
);
}



echo json_encode($data);



?>