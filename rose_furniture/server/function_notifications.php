<?php
include '../database/connection.php';


if (isset($_POST['updateStatus'])) {

    $detail_code = $_POST['update_id'];

    $sqlUpdate = "UPDATE tbl_notifications SET status = 0 WHERE detail_code = '$detail_code' AND receiver_id = '".$_SESSION['user_id']."' ";
    mysqli_query($conn, $sqlUpdate);

}


if (isset($_POST['markRead'])) {


    $sqlUpdate = "UPDATE tbl_notifications SET status = 0 WHERE receiver_id = '".$_SESSION['user_id']."' ";
    mysqli_query($conn, $sqlUpdate);

}


if (isset($_POST['notifViewAll'])) {

    $sqlUpdate = "UPDATE tbl_notifications SET status = 0 WHERE receiver_id = '".$_SESSION['user_id']."' ";
    mysqli_query($conn, $sqlUpdate);

}



?>