<?php
include '../database/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['edit_id'];

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

    if (isset($_FILES['edit_product_image'])) {

        $old_product_image = mysqli_query($conn, "SELECT product_image FROM tbl_products WHERE product_id = $product_id");
        $old_product_image = mysqli_fetch_assoc($old_product_image)['product_image'];
        
        // Delete the old product image from the server
        unlink("../ecommerce/uploads/$old_product_image");

        $file = $_FILES['edit_product_image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        $newName = $randomString . "_" . $file_name;

        $upload_dir = '../ecommerce/uploads/';
        
        $target_file = $upload_dir . $newName;
        move_uploaded_file($file_tmp, $target_file);

        $sql = "UPDATE tbl_products SET product_image = '$newName' WHERE product_id = '$product_id' ";
        mysqli_query($conn, $sql);


    }
}

?>