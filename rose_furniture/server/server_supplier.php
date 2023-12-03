<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_supplier ");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{

$action = '<button data-id="'.$row['supplier_id'].'" 
class="btn btn-warning getSupplier" data-bs-toggle="modal" data-bs-target="#EditBackdrop">
Edit</button>';

if($row['supplier_status'] == "1"){
  $status = "<button class='btn btn-success active' data-id='".$row['supplier_id']."'>
  <i class='bx bxs-lock-open-alt'></i></button>";
}else {
  $status = "<button class='btn btn-danger lock' data-id='".$row['supplier_id']."'>
  <i class='bx bxs-lock-alt'></i></button>";
}

$data[] = array(
  "supplier_id"=> $row['supplier_id'],
  "supplier_name"=> $row['supplier_name'],
  "supplier_address"=> $row['supplier_address'],
  "supplier_contact"=> $row['supplier_contact'],
  "action"=> $action,
  "status"=> $status,
);
}



echo json_encode($data);



?>