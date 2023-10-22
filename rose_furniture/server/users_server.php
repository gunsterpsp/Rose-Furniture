<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_users");


$data = array();
while ($row = mysqli_fetch_assoc($sql))
{

$group_code = "";
if($row['group_code'] == "1"){
    $group_code = "Admin";
}elseif ($row['group_code'] == "3"){
    $group_code = "Rider";
}else {
    $group_code = "User";
}

$status = "";
if($row['status'] == "1"){
    $status = "Active";
}else {
    $status = "Lock";
}
$userLock = "";
if($row['status'] == "1"){
    $userLock = "<button class='btn btn-success active' data-id='".$row['user_id']."'>
    <i class='bx bxs-lock-open-alt'></i></button>";
}else {
    $userLock = "<button class='btn btn-danger lock' data-id='".$row['user_id']."'>
    <i class='bx bxs-lock-alt'></i></button>";
}
$edit = "<button class='btn btn-warning flex getUser' 
data-id='".$row['user_id']."' data-bs-toggle='modal' data-bs-target='#EditBackdrop'>
<i class='bx bx-edit-alt' ></i></button>";

$action = "
<div class='d-flex bd-highlight gap-2'>
    ".$edit."  ".$userLock."
</div>";


$data[] = array(
  "id"=> $row['user_id'],
  "first_name"=> $row['first_name'],
  "last_name"=> $row['last_name'],
  "address"=> $row['address'],
  "contact_no"=> $row['contact_no'],
  "username"=> $row['username'],
  "password"=> $row['password'],
  "email"=> $row['email'],
  "group"=> $group_code,
  "action"=> $action,
  "status"=> $status,
);
}



echo json_encode($data);



?>