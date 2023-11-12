<?php
include '../database/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $proof_image = $_POST['proof_image'];
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

    if (isset($_FILES['proof_image'])) {
        $file = $_FILES['proof_image'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];


        $newName = $randomString . "_" . $file_name;

        $upload_dir = '../ecommerce/uploads/';

        $user_id = $_SESSION['user_id'];

        $sqlName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '$user_id' ");
        $fetchName = mysqli_fetch_assoc($sqlName);

        $full_name = $fetchName['first_name'] . ' ' . $fetchName['last_name'];

        $order_remarks = 'Rider ' . $full_name . ' has collected the refund order';
        
        $target_file = $upload_dir . $newName;
        move_uploaded_file($file_tmp, $target_file);
        $sql = "INSERT INTO tbl_order_process (order_text, order_remarks, cart_id, proof_image, rider_status) 
        VALUES ('Get Rider', '$order_remarks', '$cart_id', '$newName', '$user_id')";
        mysqli_query($conn, $sql);

        $update2 = "UPDATE tbl_order_detail_items SET refund_status = 5 WHERE cart_id = '$cart_id' ";   
        mysqli_query($conn, $update2);

        $selectOrder = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE cart_id = '$cart_id' ");
        $fetchOrder = mysqli_fetch_assoc($selectOrder);

        $sender_id = $_SESSION['user_id'];
        $receiver_id = $fetchOrder['user_id'];
        $tracking_no = $fetchOrder['detail_code'];

        $notification_text = 'Your refund order has collected by '.$full_name.' with a tracking no. : ' . $tracking_no;
        
        $sqlInsert = "INSERT INTO tbl_notifications 
        (notification_text, sender_id, receiver_id, detail_code) 
        VALUES 
        ('$notification_text', '$sender_id', '$receiver_id', '$tracking_no')";
        mysqli_query($conn, $sqlInsert);

    }
}

?>