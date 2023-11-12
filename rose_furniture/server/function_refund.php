<?php

include '../database/connection.php';


if (isset($_POST['view_id'])) {

    $order_id = $_POST['order_id'];

    $select = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
    $fetchSelect = mysqli_fetch_assoc($select);

    $cart_id = $fetchSelect['cart_id'];

    $sqlMax = mysqli_query($conn, "SELECT MAX(id) as 'id' FROM tbl_order_process WHERE cart_id = $cart_id ");
    $lastId = mysqli_fetch_assoc($sqlMax);

    $id = $lastId['id'];

    $sqlMax1 = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE id = $id ");
    $SqlData = mysqli_fetch_assoc($sqlMax1);

    $sqlRider = mysqli_query($conn, "SELECT order_remarks FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'In Transit' ");
    $SqlRider = mysqli_fetch_assoc($sqlRider);

    $sqlGetTransaction = mysqli_query($conn, "SELECT detail_code FROM tbl_order_process WHERE cart_id = $cart_id AND order_text = 'Order Placed' ");
    $sqlTrackNo = mysqli_fetch_assoc($sqlGetTransaction);

    $trackNo = $sqlTrackNo['detail_code'];

    $rider_name = $SqlRider['order_remarks'];

    $proof_image = $SqlData['proof_image'];
    $order_remarks = $SqlData['order_remarks'];
    $order_text = $SqlData['order_text'];

    $sqlReason = mysqli_query($conn, "SELECT refund_text FROM tbl_refund_reason WHERE cart_id = '$cart_id' ");
    $fetchReason = mysqli_fetch_assoc($sqlReason);

    $refund_text = $fetchReason['refund_text'];

    $data = array(
        "proof_image" => $proof_image,
        "order_remarks" => $order_remarks,
        "rider_name" => $rider_name,
        "tracking_no" => $trackNo,
        "refund_text" => $refund_text
    );


    echo json_encode($data);
}
if (isset($_POST['approveRefund'])) {
    $detail_code = $_POST['detail_code'];

    $updateSql = "UPDATE tbl_order_detail_items SET refund_status = 3 WHERE detail_code = '$detail_code' ";
    mysqli_query($conn, $updateSql);

    $selectCode = mysqli_query($conn, "SELECT detail_code, user_id, cart_id FROM tbl_order_detail_items WHERE detail_code = '$detail_code' ");
    $fetchCode = mysqli_fetch_assoc($selectCode);


    $notification_text = "Your request for refund has been approved with a tracking no : " . $detail_code;
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $fetchCode['user_id'];


    $insertNotifs = "INSERT INTO tbl_notifications 
    (notification_text, sender_id, receiver_id, detail_code) 
    VALUES 
    ('$notification_text', '$sender_id', '$receiver_id', '$detail_code')";
    mysqli_query($conn, $insertNotifs);

    $order_text = 'Approved Refund';
    $order_remarks = "Refund has been approved";
    $cart_id = $fetchCode['cart_id'];

    $insertProcess = "INSERT INTO tbl_order_process 
    (order_text, order_remarks, detail_code, cart_id) 
    VALUES 
    ('$order_text', '$order_remarks', '$detail_code', '$cart_id')";
    mysqli_query($conn, $insertProcess);
}


if (isset($_POST['refund_view'])) {
    $order_id = $_POST['order_id'];

?>
    <div>
        <input type="hidden" id="order_id" value="<?= $order_id ?>">
        <select class="select2" id="rider_id" style="width: 100%;">
            <option value="0">Select a rider for pick up of refund items</option>
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE group_code = 3 AND status = 1 ORDER BY user_id DESC");

            while ($row = mysqli_fetch_assoc($sql)) {
            ?>
                <option value="<?= $row['user_id'] ?>">
                    <?= $row['first_name'] ?> <?= $row['last_name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $("#RefundBackdrop")
            });
        });
    </script>
<?php



}

if (isset($_POST['change_view'])) {
    $order_id = $_POST['order_id'];

?>
    <div>
        <input type="hidden" id="order_id" value="<?= $order_id ?>">
        <select class="select3" id="rider_id" style="width: 100%;">
            <option value="0">Select a rider for pick up of refund items</option>
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE group_code = 3 AND status = 1 ORDER BY user_id DESC");

            while ($row = mysqli_fetch_assoc($sql)) {
            ?>
                <option value="<?= $row['user_id'] ?>">
                    <?= $row['first_name'] ?> <?= $row['last_name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <script>
        $(document).ready(function() {
            $('.select3').select2({
                dropdownParent: $("#changeRiderBackdrop")
            });
        });
    </script>
<?php



}


if (isset($_POST['approveRider'])) {
    $order_id = $_POST['order_id'];
    $rider_id = $_POST['rider_id'];

    $sqlSelect = mysqli_query($conn, "SELECT detail_code, rider_id FROM tbl_order_detail_items WHERE order_id = '$order_id' ");
    $fetchSelect = mysqli_fetch_assoc($sqlSelect);

    $sqlUpdate = "UPDATE tbl_order_detail_items SET refund_status = 4, rider_refund_id = '$rider_id' WHERE order_id = '$order_id' ";
    mysqli_query($conn, $sqlUpdate);

    $detail_code = $fetchSelect['detail_code'];
    $notification_text = 'You have for pick up refund order : ' . $detail_code;
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $fetchSelect['rider_id'];

    $insertNotif = "INSERT INTO tbl_notifications 
    (notification_text, sender_id, receiver_id, detail_code) 
    VALUES 
    ('$notification_text', '$sender_id', '$receiver_id', '$detail_code')";
    mysqli_query($conn, $insertNotif);
}


if (isset($_POST['changeRider'])) {
    $order_id = $_POST['order_id'];
    $rider_id = $_POST['rider_id'];

    $sqlSelect = mysqli_query($conn, "SELECT detail_code, rider_id, rider_refund_id FROM tbl_order_detail_items WHERE order_id = '$order_id' ");
    $fetchSelect = mysqli_fetch_assoc($sqlSelect);


    $max = mysqli_query($conn, "SELECT MAX(notification_id) as 'valid_id' FROM tbl_notifications WHERE detail_code = '".$fetchSelect['detail_code']."'  ");
    $fetchMax = mysqli_fetch_assoc($max);

    $delete = "DELETE FROM tbl_notifications WHERE notification_id = '".$fetchMax['valid_id']."' ";
    mysqli_query($conn, $delete);


    $sqlUpdate = "UPDATE tbl_order_detail_items SET refund_status = 4, rider_refund_id = '$rider_id' WHERE order_id = '$order_id' ";
    mysqli_query($conn, $sqlUpdate);

    $detail_code = $fetchSelect['detail_code'];
    $notification_text = 'You have for pick up refund order : ' . $detail_code;
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $fetchSelect['rider_id'];

    $insertNotif = "INSERT INTO tbl_notifications 
    (notification_text, sender_id, receiver_id, detail_code) 
    VALUES 
    ('$notification_text', '$sender_id', '$rider_id', '$detail_code')";
    mysqli_query($conn, $insertNotif);
}


if (isset($_POST['view_refund'])) {

    $order_id = $_POST['order_id'];

    $sql = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = '$order_id' ");
    $fetchSql = mysqli_fetch_assoc($sql);

    echo json_encode($fetchSql);
}

if (isset($_POST['select_facility'])) {

    $order_id = $_POST['order_id'];

?><input type="hidden" id="order_id" value="<?= $order_id ?>">
    <select id="courier_id" class="select2" style="width: 100%;">
        <option value="0">Select a courier</option>
        <?php
            $sql = mysqli_query($conn, "SELECT * FROM tbl_logistics_partner WHERE status = 1");
            while($row = mysqli_fetch_assoc($sql)){
                ?>
                    <option value="<?= $row['logistic_name'] ?>"><?= $row['logistic_name'] ?></option>
                <?php
            }
        ?>
    </select>
    <div>
        <label for="">Location</label>
    <input type="text" id="location_id" class="form-control">
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $("#courierBackdrop")
            });
        });
    </script>
<?php

}


if(isset($_POST['courierBtn'])){
    $courier_id = $_POST['courier_id'];
    $order_id = $_POST['order_id'];
    $location_id = $_POST['location_id'];


    $updateRefund = "UPDATE tbl_order_detail_items SET refund_status = 6 WHERE order_id = '$order_id' ";
    mysqli_query($conn, $updateRefund);

    $sqlRefund = mysqli_query($conn, "SELECT cart_id, detail_code FROM 
    tbl_order_detail_items WHERE order_id = '$order_id' ");
    $fetchRefund = mysqli_fetch_assoc($sqlRefund);

    $riderName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '".$_SESSION['user_id']."' ");
    $FetchName = mysqli_fetch_assoc($riderName);

    $full_Name = $FetchName['first_name'] . ' ' . $FetchName['last_name'];

    $order_remarks = "Rider " . $full_Name . ' has departed the refund package to courier ' . $courier_id . ' ' . $location_id;
    $detail_code = $fetchRefund['detail_code'];
    $cart_id = $fetchRefund['cart_id'];

    echo $insertProcess = "INSERT INTO 
    tbl_order_process 
    (order_text, order_remarks, detail_code, cart_id) 
    VALUES 
    ('Refund Package', '$order_remarks', '$detail_code', '$cart_id')";
    mysqli_query($conn, $insertProcess);

    $notification_text = "You have for confirmation 
    refund order from " . $courier_id . ' ' . $location_id . ' tracking no : ' . $detail_code . 
    'delivered by ' . $full_Name;
    $sender_id = $_SESSION['user_id'];

    $insertNotif = "INSERT INTO tbl_notifications 
    (notification_text, sender_id, receiver_id, detail_code) 
    VALUES 
    ('$notification_text', '$sender_id', '1', '$detail_code')";
    mysqli_query($conn, $insertNotif);
    
}

if(isset($_POST['getView'])){

    $order_id = $_POST['order_id'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE order_id = '$order_id' ");
    $data = mysqli_fetch_assoc($sql);

    echo json_encode($data);
}

if(isset($_POST['confirmRefund'])){

    $order_id = $_POST['order_id'];



    $updateRefund = "UPDATE tbl_order_detail_items SET refund_status = 7 WHERE order_id = '$order_id' ";
    mysqli_query($conn, $updateRefund);

    // $sqlRefund = mysqli_query($conn, "SELECT cart_id, detail_code FROM 
    // tbl_order_detail_items WHERE order_id = '$order_id' ");
    // $fetchRefund = mysqli_fetch_assoc($sqlRefund);

    // $riderName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '".$_SESSION['user_id']."' ");
    // $FetchName = mysqli_fetch_assoc($riderName);

    // $full_Name = $FetchName['first_name'] . ' ' . $FetchName['last_name'];

    // $order_remarks = "Rider " . $full_Name . ' has departed the refund package to courier ' . $courier_id . ' ' . $location_id;
    // $detail_code = $fetchRefund['detail_code'];
    // $cart_id = $fetchRefund['cart_id'];

    // echo $insertProcess = "INSERT INTO 
    // tbl_order_process 
    // (order_text, order_remarks, detail_code, cart_id) 
    // VALUES 
    // ('Refund Package', '$order_remarks', '$detail_code', '$cart_id')";
    // mysqli_query($conn, $insertProcess);

    // $notification_text = "You have for confirmation 
    // refund order from " . $courier_id . ' ' . $location_id . ' tracking no : ' . $detail_code . 
    // 'delivered by ' . $full_Name;
    // $sender_id = $_SESSION['user_id'];

    // $insertNotif = "INSERT INTO tbl_notifications 
    // (notification_text, sender_id, receiver_id, detail_code) 
    // VALUES 
    // ('$notification_text', '$sender_id', '1', '$detail_code')";
    // mysqli_query($conn, $insertNotif);
    
}


?>