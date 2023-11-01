<?php
include '../database/connection.php';

if(isset($_POST['submit'])){

    $product_id = $_POST['product_id'];
    $comment_text = $_POST['comment_text'];
    $user_id = $_SESSION['user_id'];
    $stars = $_POST['stars'];
    
    $sql = "INSERT INTO tbl_product_comments 
    (comment_text, user_id, product_id, stars) 
    VALUES 
    ('$comment_text', '$user_id', '$product_id', '$stars')";
    mysqli_query($conn, $sql);
}

if(isset($_POST['get_id'])){

    $user_id = $_POST['user_id'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = $user_id");
    $data = mysqli_fetch_assoc($sql);

    echo json_encode($data);

}

if(isset($_POST['get_id2'])){

    $user_id = $_POST['user_id'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = $user_id");
    $data = mysqli_fetch_assoc($sql);

    echo json_encode($data);

}

if(isset($_POST['comment_reply'])){

    $reply_text = $_POST['reply_text'];
    $comment_id = $_POST['comment_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tbl_reply_comment 
    (reply_text, user_id, comment_id) 
    VALUES 
    ('$reply_text', '$user_id', '$comment_id')";
    mysqli_query($conn, $sql);

}

if(isset($_POST['comment_reply2'])){

    $reply_text = $_POST['reply_text'];
    $comment_id = $_POST['comment_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tbl_reply_comment 
    (reply_text, user_id, comment_id) 
    VALUES 
    ('$reply_text', '$user_id', '$comment_id')";
    mysqli_query($conn, $sql);

}


?>
