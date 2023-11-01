<?php
include '../database/connection.php';



if (isset($_POST['approve'])) {
    $order_id = $_POST['order_id'];
    $logistic_name = $_POST['logistic_name'];

    $update = "UPDATE tbl_order_detail_items SET to_ship = 2, to_pickup = 1 WHERE order_id = $order_id ";
    mysqli_query($conn, $update);


    $select = mysqli_query($conn, "SELECT cart_id, detail_code, user_id FROM tbl_order_detail_items WHERE order_id = $order_id ");
    $fetchSelect = mysqli_fetch_assoc($select);

    $insert = "INSERT INTO tbl_order_process 
    (order_text, order_remarks, cart_id) VALUES ('Picked up', '$logistic_name', '" . $fetchSelect['cart_id'] . "')";
    mysqli_query($conn, $insert);

    $notification_text = 'Your order no. ' . $fetchSelect['detail_code'] . ' is Preparing to ship';
    $user_id = $_SESSION['user_id'];
    $receiver_id = $fetchSelect['user_id'];

    $insertNotif = "INSERT INTO tbl_notifications 
    (notification_text, sender_id, receiver_id, detail_code)
    VALUES
    ('$notification_text', '$user_id', '$receiver_id', '".$fetchSelect['detail_code']."')";
    mysqli_query($conn, $insertNotif);
}



if (isset($_POST['view_logistic'])) {

    $order_id = $_POST['order_id'];

?>
    <div>
        <input type="hidden" id="order_id" value="<?= $order_id ?>">
        <label for="">Select a logistic partner</label>
        <select name="" id="logistic_name" class="form-select select2" style="width: 100%;">
            <option value="0">Please select on here...</option>
            <?php
            $sql = mysqli_query($conn, "SELECT logistic_name FROM tbl_logistics_partner WHERE status = 1");
            while ($row = mysqli_fetch_assoc($sql)) {
            ?>
                <option value="<?= $row['logistic_name'] ?>"><?= $row['logistic_name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $("#shippingBackdrop")
            });
        });
    </script>
<?php
}

if (isset($_POST['view_id'])) {

    $order_id = $_POST['order_id'];

    $sql = mysqli_query($conn, "SELECT cart_id FROM tbl_order_detail_items WHERE order_id = $order_id ");

    $data = mysqli_fetch_assoc($sql);

    $cartId = $data['cart_id'];



?>
    <input type="hidden" id="cart_id" value="<?= $data['cart_id'] ?>">
    <div class="mb-2">
        <select name="" id="action_id" class="form-select">
            <option value="0">Select Action</option>
            <?php

            $sqlMax = mysqli_query($conn, "SELECT MAX(id) as 'id' FROM tbl_order_process WHERE cart_id = '$cartId' ");
            $lastMax = mysqli_fetch_assoc($sqlMax);
            $rowId = $lastMax['id'];

            $sqlMax1 = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE id = '$rowId' AND status = 1 ");
            $lastMax1 = mysqli_fetch_assoc($sqlMax1);

            if ($lastMax1['order_text'] == "Picked up") {
                echo '<option value="Arrived">Arrived At</option>';
                echo '<option value="Departed" disabled>Departed At</option>';
            } else if ($lastMax1['order_text'] == "Arrived") {
                echo '<option value="Arrived" disabled>Arrived At</option>';
                echo '<option value="Departed">Departed At</option>';
            } else if ($lastMax1['order_text'] == "Departed") {
                echo '<option value="Arrived">Arrived At</option>';
                echo '<option value="Departed" disabled>Departed At</option>';
            }

            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="">Location</label>
        <input type="text" id="location_id" class="form-control">
    </div>
    <?php
    if ($lastMax1['order_text'] == "Arrived") {
        echo '
                <div class="mb-2">
                <label for="">Select only if this order is the last departure location</label>
                <select name="" id="last_departure" class="form-select">
                    <option value="0">Please selech here...</option>
                    <option value="1">Last Departure</option>
                </select>
            </div>
                ';
    }
    ?>


<?php

}


if (isset($_POST['approve_ship'])) {

    $cart_id = $_POST['cart_id'];
    $order_text = $_POST['action_id'];
    $order_remarks = $_POST['location_id'];
    $last_departure = $_POST['last_departure'];

    $sql = mysqli_query($conn, "SELECT MAX(id) as 'last_id' FROM tbl_order_process WHERE cart_id = $cart_id ");
    $row = mysqli_fetch_assoc($sql);

    $update = "UPDATE tbl_order_process SET status = 0 WHERE id = '" . $row['last_id'] . "' ";
    mysqli_query($conn, $update);

    $insert = "INSERT INTO tbl_order_process (order_text, order_remarks, last_departure, cart_id) 
    VALUES ('$order_text', '$order_remarks', '$last_departure', '$cart_id')";
    mysqli_query($conn, $insert);

    if ($last_departure == 1) {
        $update2 = "UPDATE tbl_order_detail_items SET to_pickup = 2, in_transit = 1 WHERE cart_id = $cart_id ";
        mysqli_query($conn, $update2);
    }
}



?>