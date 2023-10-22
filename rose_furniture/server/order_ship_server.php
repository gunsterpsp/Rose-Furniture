<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE to_ship IN (1,2) AND to_pickup IN (1,0)");




$data = array();
while ($row = mysqli_fetch_assoc($sql))
{



$shipping_approval = "<button class='btn btn-success view_logistic' data-bs-toggle='modal' data-bs-target='#shippingBackdrop'
data-id='".$row['order_id']."' >
<i class='bx bx-check'></i></button>
";

// <button class='btn btn-danger cancel' 
// data-id='".$row['order_id']."' >
// <i class='bx bx-x'></i></button>

$pickup_approval = "<button class='btn btn-dark view_id' 
data-id='".$row['order_id']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
<i class='bx bx-package' ></i></button>";



if($row['to_ship'] == 1){
  $action = "
  <div class='d-flex bd-highlight gap-2'>
      ".$shipping_approval."
  </div>";
}else if($row['to_pickup'] == 1){
  $action = "
  <div class='d-flex bd-highlight gap-2'>
      ".$pickup_approval."
  </div>";
}
$sql2 = mysqli_query($conn, "SELECT MAX(id) as 'last_id'
FROM tbl_order_process WHERE cart_id = '".$row['cart_id']."' ");
$lastId = mysqli_fetch_assoc($sql2);

$sql3 = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE id = '".$lastId['last_id']."' ");
$fetch_status = mysqli_fetch_assoc($sql3);

if($fetch_status['order_text'] == "Preparing To Ship"){
  $status_set = "Preparing to ship";
}
else if($fetch_status['order_text'] == "Departed" || $fetch_status['order_text'] == "Arrived"){
  $status_set = $fetch_status['order_text'] . ' at ' . $fetch_status['order_remarks'] . ' sorting facility';
}else if($fetch_status['order_text'] == "Picked up"){
  $status_set = $fetch_status['order_text'] . ' by logistic partner ' . $fetch_status['order_remarks'];
}


$data[] = array(
  "order_id"=> $row['order_id'],
  "product_code"=> $row['product_code'],
  "product_name"=> $row['product_name'],
  "price"=> '₱'.$row['price'],
  "quantity"=> $row['quantity'],
  "total_amount"=> '₱'.$row['price'] * $row['quantity'],
  "payment_method"=> $row['payment_method'],
  "action"=> $action,
  "status"=> $status_set,
);
}



echo json_encode($data);



?>