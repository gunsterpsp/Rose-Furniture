<?php
include '../database/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];

    function generateRandomString($length = 10) {
        $length = max(1, (int)$length);
        $randomBytes = random_bytes($length);
        $randomString = base64_encode($randomBytes);
        $randomString = str_replace(['/', '+', '='], '', $randomString);
        $randomString = substr($randomString, 0, $length);
    
        return $randomString;
    }
    $randomString = generateRandomString(10);
    echo $randomString;

    if (isset($_FILES['product_image'])) {
        $file = $_FILES['product_image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        $newName = $randomString . "_" . $file_name;

        $upload_dir = '../ecommerce/uploads/';
        
        $target_file = $upload_dir . $newName;
        move_uploaded_file($file_tmp, $target_file);
        $sql = "INSERT INTO tbl_products (product_code, product_name, product_price, product_quantity, product_description, product_image, product_category) 
        VALUES ('$randomString', '$product_name', '$product_price', '$product_quantity', '$product_description', '$newName', '$product_category')";
        mysqli_query($conn, $sql);
    }
}

?>