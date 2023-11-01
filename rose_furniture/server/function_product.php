<?php
include '../database/connection.php';

if (isset($_POST['getProduct'])) {
    $getId = $_POST['getId'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_id = $getId ");

    $data = mysqli_fetch_assoc($sql);


?>
    <input type="hidden" class="form-control" value="<?= $data['product_id'] ?>" id="edit_id">
    <div class="mb-2">
        <label for="">Product Name</label>
        <input type="text" class="form-control" value="<?= $data['product_name'] ?>" id="edit_product_name">
    </div>
    <div class="mb-2">
        <label for="">Product Price</label>
        <input type="text" class="form-control" readonly value="<?= $data['product_price'] ?>" id="edit_product_price">
    </div>
    <div class="mb-2">
        <label for="">Product Quantity</label>
        <input type="text" class="form-control" readonly value="<?= $data['product_quantity'] ?>" id="edit_product_quantity">
    </div>
    <div class="mb-2">
        <label for="">Description</label>
        <textarea name="edit_product_description" id="edit_product_description" class="form-control" rows="3"><?= $data['product_description'] ?></textarea>
    </div>
    <div class="mb-2">
        <label for="">Product Category</label>
        <select class="form-select select3" name="edit_product_category" id="edit_product_category" style="width: 100%;">

            <?php
            $sqlCategory = mysqli_query($conn, "SELECT product_category FROM tbl_products WHERE product_category = '" . $data['product_category'] . "' ");
            $getCategory = mysqli_fetch_assoc($sqlCategory);
            echo '<option value=' . $getCategory['product_category'] . '>' . $getCategory['product_category'] . '</option>';
            ?>
            <?php
            include '../database/connection.php';
            $sql = mysqli_query($conn, "SELECT * FROM tbl_category WHERE category_status = 1 ");
            while ($row = mysqli_fetch_assoc($sql)) {
            ?>
                <option value="<?= $row['category_name'] ?>"><?= $row['category_name'] ?></option>
            <?php
            }
            ?>
        </select>
        <!-- <input type="text" class="form-control" name="product_category" id="product_category"> -->
    </div>
    <div class="mb-2">
        <label for="">Product Image</label>
        <input type="file" class="form-control" id="edit_product_image">
    </div>
<?php

    // echo json_encode($data);
}


if (isset($_POST['active'])) {
    $id = $_POST['getId'];

    $update = "UPDATE tbl_products SET product_status = '0'  WHERE product_id = '$id' ";
    mysqli_query($conn, $update);
}

if (isset($_POST['lock'])) {
    $id = $_POST['getId'];

    $update = "UPDATE tbl_products SET product_status = '1'  WHERE product_id = '$id' ";
    mysqli_query($conn, $update);
}

?>
<script>
    $(document).ready(function() {
        $('.select3').select2({
            dropdownParent: $("#EditBackdrop")
        });
    });

</script>