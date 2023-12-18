<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE to_complete = 2 AND refund_status IN (2, 3,4,5,6,7)");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{



  $sql3 = mysqli_query($conn, "SELECT MAX(id) as 'last_id'
  FROM tbl_order_process WHERE cart_id = '".$row['cart_id']."' ");
  $lastId = mysqli_fetch_assoc($sql3);

  $sql5 = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE order_text = 'Delivered' AND id = '".$lastId['last_id']."' ");

  $fetch_status = mysqli_fetch_assoc($sql5);


if($row['refund_status'] == "2"){
  $status = "For Approval of Refund";
  $action = "<button class='btn btn-primary view_id' 
  data-id='".$row['order_id']."' data-bs-toggle='modal' 
  data-bs-target='#staticBackdrop'>View</button>";
}else if($row['refund_status'] == "3"){
  $status = "Waiting for customer to refund the item";
  $action = "";
}else if($row['refund_status'] == "6"){
  $sqlOrder = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE order_text = 'Refund Package' AND detail_code = '".$row['detail_code']."' ");
  $fetchOrder = mysqli_fetch_assoc($sqlOrder);
  $status = "<textarea readonly>".$fetchOrder['order_remarks']."</textarea>";
  $action = "<button class='btn btn-success getView' data-bs-toggle='modal' 
  data-bs-target='#ConfirmBackdrop'
  data-id='".$row['order_id']."'><i class='bx bx-check'></i></button>";
}else if ($row['refund_status'] == "4"){
  $action = "<button class='btn btn-success approveLast'
  data-id='".$row['order_id']."'><i class='bx bx-check'></i></button>";
  // $action = "<button class='btn btn-warning change_view' 
  // data-id='".$row['order_id']."' data-bs-toggle='modal' 
  // data-bs-target='#changeRiderBackdrop'>Change rider</button>";
  $status = "Waiting for delivery of return order";
}else if ($row['refund_status'] == "5") {
  // $sqlOrder = mysqli_query($conn, "SELECT order_text, order_remarks FROM tbl_order_process WHERE order_text = 'Refund Package' AND detail_code = '".$row['detail_code']."' ");
  // $fetchOrder = mysqli_fetch_assoc($sqlOrder);
  // $status = "<textarea readonly>".$fetchOrder['order_remarks']."</textarea>";
  // $action = "<button class='btn btn-success getView' data-bs-toggle='modal' 
  // data-bs-target='#ConfirmBackdrop'
  // data-id='".$row['order_id']."'><i class='bx bx-check'></i></button>";

  $action = "<button class='btn btn-success getView' data-bs-toggle='modal' 
  // data-bs-target='#ConfirmBackdrop'
  // data-id='".$row['order_id']."'><i class='bx bx-check'></i></button>";
  $status = "For Refund of Cash";
}else {
  $action = "";
  $status = "Refunded";
}



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
  "status"=> $status,
);
}
echo json_encode($data);
?>