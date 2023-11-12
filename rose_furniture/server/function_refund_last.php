<?php
include '../database/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $gcash = $_POST['gcash'];
    $cart_id = $_POST['cart_id'];

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

    if (isset($_FILES['new_image'])) {
        $file = $_FILES['new_image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];


        $newName = $randomString . "_" . $file_name;

        $upload_dir = '../ecommerce/uploads/';

        $order_remarks = 'Refunded succesfully to your Gcash No. ' . $_POST['gcash'];
        
        $target_file = $upload_dir . $newName;
        move_uploaded_file($file_tmp, $target_file);
        $sql = "INSERT INTO tbl_order_process (order_text, order_remarks, cart_id, proof_image) 
        VALUES ('Refunded', '$order_remarks', '$cart_id', '$newName')";
        mysqli_query($conn, $sql);

        $update2 = "UPDATE tbl_order_detail_items SET refund_status = 7 WHERE cart_id = '$cart_id' ";   
        mysqli_query($conn, $update2);

        $selectOrder = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE cart_id = '$cart_id' ");
        $fetchOrder = mysqli_fetch_assoc($selectOrder);

        $sender_id = $_SESSION['user_id'];
        $receiver_id = $fetchOrder['user_id'];
        $tracking_no = $fetchOrder['detail_code'];

        $notification_text = 'Your request has been succesfully refunded with a tracking no. : ' . $tracking_no;
        
        $sqlInsert = "INSERT INTO tbl_notifications 
        (notification_text, sender_id, receiver_id, detail_code) 
        VALUES 
        ('$notification_text', '$sender_id', '$receiver_id', '$tracking_no')";
        mysqli_query($conn, $sqlInsert);

    }
}

?>