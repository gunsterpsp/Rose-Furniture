<?php

include '../database/connection.php';
$session = $_SESSION['user_id'];
$sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE 
rider_refund_id = $session AND 
to_complete = 2 AND refund_status IN (3, 4, 5) ");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{
if($row['refund_status'] == "3"){
  $approve = "To Deliver - Owner";
//   $approve = "<button class='btn btn-success view_refund' data-bs-toggle='modal' data-bs-target='#staticBackdrop'
// data-id='".$row['order_id']."' >
// <i class='bx bx-check'></i></button>
// <button class='btn btn-danger cancel' 
// data-id='".$row['order_id']."' >
// <i class='bx bx-x'></i></button>";
}else {
  $approve = "To Deliver - Owner";
}


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