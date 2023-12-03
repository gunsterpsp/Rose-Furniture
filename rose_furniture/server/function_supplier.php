<?php
include '../database/connection.php';

if (isset($_POST['active'])) {
    $id = $_POST['getId'];

    $update = "UPDATE tbl_supplier SET supplier_status = '0'  WHERE supplier_id = '$id' ";
    mysqli_query($conn, $update);
}

if (isset($_POST['lock'])) {
    $id = $_POST['getId'];

    $update = "UPDATE tbl_supplier SET supplier_status = '1'  WHERE supplier_id = '$id' ";
    mysqli_query($conn, $update);
}


if (isset($_POST['getSupplier'])) {
    $supplier_id = $_POST['getId'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_supplier WHERE supplier_id = '$supplier_id' ");
    $fetch = mysqli_fetch_assoc($sql);

    $data = array(
        "supplier_id"=> $supplier_id,
        "supplier_name"=> $fetch['supplier_name'],
        "supplier_address"=> $fetch['supplier_address'],
        "supplier_contact"=> $fetch['supplier_contact'],
    );
    echo json_encode($data);
}


if (isset($_POST['submit'])) {
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_contact = $_POST['supplier_contact'];

    $sql = "INSERT INTO tbl_supplier (supplier_name, supplier_address, supplier_contact) 
    VALUES 
    ('$supplier_name', '$supplier_address', '$supplier_contact')";
    mysqli_query($conn, $sql);
}

if (isset($_POST['updateSupplier'])) {
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_contact = $_POST['supplier_contact'];

    $sql = "UPDATE tbl_supplier SET supplier_name = '$supplier_name', 
    supplier_address = '$supplier_address', supplier_contact = '$supplier_contact' 
    WHERE supplier_id = '$supplier_id' ";
    mysqli_query($conn, $sql);
}


?>
