<?php
include '../database/connection.php';

if(isset($_POST['addItem'])){
    $product_code = $_POST['product_code'];   
    $product_name = $_POST['product_name'];   
    $product_price = $_POST['product_price'];   
    $product_quantity = $_POST['product_quantity'];   



    $sql = "INSERT INTO tbl_cart_items (product_code, product_name, price, quantity, user_id) 
    VALUES 
    ('$product_code', '$product_name', '$product_price', '$product_quantity', '".$_SESSION['user_id']."')";
    mysqli_query($conn, $sql);


    $select = $conn->query("SELECT * FROM tbl_products WHERE product_code = '$product_code' ");
    $fetch = $select->fetch_assoc();
    $totalQty = $fetch['product_quantity'] - $product_quantity;


    $update = "UPDATE tbl_products SET product_quantity = '$totalQty' WHERE product_code = '$product_code' ";
    mysqli_query($conn, $update);

}

if(isset($_POST['deleteItem'])){

    $cart_id = $_POST['cart_id'];

    $sql2 = mysqli_query($conn,"SELECT quantity, product_code FROM tbl_cart_items WHERE cart_id = '$cart_id' ");
    $fetch2 = mysqli_fetch_assoc($sql2);

    $sql3 = mysqli_query($conn, "SELECT product_quantity FROM tbl_products WHERE product_code = '".$fetch2['product_code']."' ");
    $fetch3 = mysqli_fetch_assoc($sql3);

    $updateQty = $fetch2['quantity'] + $fetch3['product_quantity'];

    $update = "UPDATE tbl_products SET product_quantity = '$updateQty' WHERE product_code = '".$fetch2['product_code']."' ";
    mysqli_query($conn, $update);
    

    $sql = "DELETE FROM tbl_cart_items WHERE cart_id = $cart_id ";
    mysqli_query($conn, $sql);



}

if(isset($_POST['confirmItem'])){
    
    $full_name = $_POST['full_name'];
    $delivery_address = $_POST['delivery_address'];
    $contact_no = $_POST['contact_no'];
    $total_price = $_POST['total_price'];
    $payment_method = $_POST['payment_method'];


    // function generateRandomString($length = 10) {
    //     $length = max(1, (int)$length);
    //     $randomBytes = random_bytes($length);
    //     $randomString = base64_encode($randomBytes);
    //     $randomString = str_replace(['/', '+', '='], '', $randomString);
    //     $randomString = substr($randomString, 0, $length);
    
    //     return $randomString;
    // }
    // $randomString = generateRandomString(20);
    // echo $randomString;

    $sql_header = "INSERT INTO tbl_order_header_items 
    (full_name, address, contact_no, payment_method, total_price, remarks, user_id, header_code) 
    VALUES ('$full_name', '$delivery_address', '$contact_no', '$payment_method', '$total_price', 
    '', '".$_SESSION['user_id']."', '$randomString')";
    mysqli_query($conn, $sql_header);

    $sql_select = mysqli_query($conn, "SELECT * FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
    
    while ($row = mysqli_fetch_assoc($sql_select)) {
        $uniqueID = substr(md5(uniqid(mt_rand(), true)), 0, 20);
    
        $sql_detail = "INSERT INTO tbl_order_detail_items 
        (product_code, product_name, price, quantity, payment_method, user_id, detail_code, cart_id) 
        VALUES ('".$row['product_code']."', '".$row['product_name']."', 
        '".$row['price']."', '".$row['quantity']."', '$payment_method', 
        '".$_SESSION['user_id']."', '$uniqueID', '".$row['cart_id']."')";
        mysqli_query($conn, $sql_detail);
    
        $sql2 = "INSERT INTO tbl_order_process 
        (order_text, detail_code, cart_id) VALUES ('Order Placed', '$uniqueID', '".$row['cart_id']."')";
        mysqli_query($conn, $sql2);
    }
    

    $sql_delete = "DELETE FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ";
    mysqli_query($conn, $sql_delete);




}



?>
