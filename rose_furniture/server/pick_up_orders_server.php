<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE to_pickup = 1 ");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{
$approve = "<button class='btn btn-success view_id' 
data-id='".$row['order_id']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
<i class='bx bx-check'></i>";

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
  "action"=> $action,
);
}



echo json_encode($data);



?>