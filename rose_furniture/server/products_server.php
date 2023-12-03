<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_products");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{


$product_status = "";
if($row['product_status'] == "1"){
    $product_status = "Active";
}else {
    $product_status = "Lock";
}
$productLock = "";
if($row['product_status'] == "1"){
    $productLock = "<button class='btn btn-success active' data-id='".$row['product_id']."'>
    <i class='bx bxs-lock-open-alt'></i></button>";
}else {
    $productLock = "<button class='btn btn-danger lock' data-id='".$row['product_id']."'>
    <i class='bx bxs-lock-alt'></i></button>";
}
$edit = "<button class='btn btn-warning flex getProduct' 
data-id='".$row['product_id']."' data-bs-toggle='modal' data-bs-target='#EditBackdrop'>
<i class='bx bx-edit-alt' ></i></button>";

$action = "
<div class='d-flex bd-highlight gap-2'>
    ".$edit."  ".$productLock."
</div>";



$image = "<div style='position: relative;'>
<button data-bs-toggle='modal' data-bs-target='#EditImageBackdrop' 
data-id='".$row['product_id']."' class='btn btn-sm btn-primary viewImage' style='position: absolute; right: 0px;'><i class='bx bx-images'></i></button>
<img src='../ecommerce/uploads/".$row['product_image']."' width = 100px height = 50px>
</div>"; 

$sqlSupplier = mysqli_query($conn, "SELECT supplier_name FROM tbl_supplier WHERE supplier_id = '".$row['supplier_id']."' ");
$fetchSupplier = mysqli_fetch_assoc($sqlSupplier);

$data[] = array(
  "product_id"=> $row['product_id'],
  "product_code"=> $row['product_code'],
  "product_name"=> $row['product_name'],
  "product_price"=> $row['product_price'],
  "product_quantity"=> $row['product_quantity'],
  "product_category"=> $row['product_category'],
  "product_image"=> $image,
  "supplier_name"=> $fetchSupplier['supplier_name'],
  "action"=> $action,
  "product_status"=> $product_status,
);
}



echo json_encode($data);



?>