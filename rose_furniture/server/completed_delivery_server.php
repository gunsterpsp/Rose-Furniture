<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE to_complete = 2 AND refund_status IN (0,1)");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{



  $sql3 = mysqli_query($conn, "SELECT MAX(id) as 'last_id'
  FROM tbl_order_process WHERE cart_id = '".$row['cart_id']."' ");
  $lastId = mysqli_fetch_assoc($sql3);

  $sql5 = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE order_text = 'Delivered' AND id = '".$lastId['last_id']."' ");

  $fetch_status = mysqli_fetch_assoc($sql5);

$action = "<button class='btn btn-primary view_id' data-id='".$row['order_id']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>View</button>";



$data[] = array(
  "order_id"=> $row['order_id'],
  "product_code"=> $row['product_code'],
  "product_name"=> $row['product_name'],
  "price"=> '₱'.$row['price'],
  "quantity"=> $row['quantity'],
  "total_amount"=> '₱'.$row['price'] * $row['quantity'],
  "payment_method"=> $row['payment_method'],
  "action"=> $action,
  "status"=> 'Completed',
);
}



echo json_encode($data);



?>