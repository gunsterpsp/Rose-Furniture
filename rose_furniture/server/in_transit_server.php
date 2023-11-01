<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE in_transit IN (1, 2) AND to_deliver IN (0, 1) ");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{



  $sql3 = mysqli_query($conn, "SELECT MAX(id) as 'last_id'
  FROM tbl_order_process WHERE cart_id = '".$row['cart_id']."' ");
  $lastId = mysqli_fetch_assoc($sql3);

  $sql5 = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE order_text = 'In Transit' AND id = '".$lastId['last_id']."' ");

  $fetch_status = mysqli_fetch_assoc($sql5);


  $sql2 = mysqli_query($conn, "SELECT order_text FROM tbl_order_process WHERE order_text = 'In Transit' AND cart_id = '".$row['cart_id']."' AND rider_status = 0 ");

  if(mysqli_num_rows($sql2) > 0){
    $statusInfo = "Waiting for confirmation of " . $fetch_status['order_remarks'];
    $approve = "<button class='btn btn-success view_id2' 
    data-id='".$row['order_id']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop2'>
    <i class='fa-solid fa-motorcycle'></i></button>";
  }else {
    $approve = "<button class='btn btn-success view_id' 
    data-id='".$row['order_id']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
    <i class='fa-solid fa-motorcycle'></i></button>";
    $statusInfo = "Set a rider for transit delivery";
  }

  $sql4 = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE id = '".$lastId['last_id']."' AND order_text = 'Departed' AND last_departure = 1 ");
  


  // if(mysqli_num_rows($sql4) > 0){
  //   $statusInfo = "Set a rider for delivery";
  // }else {
  //   $statusInfo = 'In Transit (Rider) '. $fetch_status['order_remarks'];
  // }
  
  





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
  "status"=> $statusInfo,
);
}



echo json_encode($data);



?>