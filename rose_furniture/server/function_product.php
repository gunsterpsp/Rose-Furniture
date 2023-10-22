<?php
include '../database/connection.php';

if(isset($_POST['getProduct'])){
    $getId = $_POST['getId'];   

    $sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_id = $getId ");

    $data = mysqli_fetch_assoc($sql);

echo json_encode($data);
}


if(isset($_POST['active'])){
    $id = $_POST['getId'];

    $update = "UPDATE tbl_products SET product_status = '0'  WHERE product_id = '$id' ";
    mysqli_query($conn, $update);

}

if(isset($_POST['lock'])){
    $id = $_POST['getId'];

    $update = "UPDATE tbl_products SET product_status = '1'  WHERE product_id = '$id' ";
    mysqli_query($conn, $update);
}

?>
