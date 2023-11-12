<?php
include '../database/connection.php';

if (isset($_POST['getProduct'])) {
    $getId = $_POST['getId'];

    $sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_id = $getId ");

    $data = mysqli_fetch_assoc($sql);


?>
<form id="imageUpdateForm" action="#" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="edit_id" value="<?= $data['product_id'] ?>" id="edit_id">
    <div class="mb-2">
        <label for="">Product Name</label>
        <input type="text" class="form-control" name="edit_product_name" value="<?= $data['product_name'] ?>" id="edit_product_name">
    </div>
    <div class="mb-2">
        <label for="">Product Price</label>
        <input type="text" class="form-control" name="edit_product_price" value="<?= $data['product_price'] ?>" id="edit_product_price">
    </div>
    <div class="mb-2">
        <label for="">Product Quantity</label>
        <input type="text" class="form-control" name="edit_product_quantity" value="<?= $data['product_quantity'] ?>" id="edit_product_quantity">
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
    <!-- <div class="mb-2">
        <label for="">Product Image</label>
        <input type="file" class="form-control" id="edit_product_image">
    </div> -->
    </form>
    <script>
    $(document).ready(function() {
        $('.select3').select2({
            dropdownParent: $("#EditBackdrop")
        });
    });

</script>
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

if (isset($_POST['updateProduct'])) {
    $product_id = (int) $_POST['edit_id'];
    $edit_product_name = mysqli_real_escape_string($conn, $_POST['edit_product_name']);
    $edit_product_price = (float) $_POST['edit_product_price'];
    $edit_product_quantity = (int) $_POST['edit_product_quantity'];
    $edit_product_description = mysqli_real_escape_string($conn, $_POST['edit_product_description']);
    $edit_product_category = mysqli_real_escape_string($conn, $_POST['edit_product_category']);
    
    // Validate the data before updating the database
    
    $sql = "UPDATE tbl_products
    SET product_name = '$edit_product_name',
    product_price = '$edit_product_price',
    product_quantity = '$edit_product_quantity',
    product_description = '$edit_product_description',
    product_category = '$edit_product_category'
    WHERE product_id = $product_id";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result === false) {
      // Handle the error
    } else {
      // The product was successfully updated
    }
}
if (isset($_POST['viewImage'])) {
    $product_id = $_POST['data_id'];

    $sql = mysqli_query($conn, "SELECT product_image FROM tbl_products WHERE product_id = '$product_id' ");
    $fetch = mysqli_fetch_assoc($sql);

    $data = array(
        "product_image"=> $fetch['product_image'],
        "product_id"=> $product_id
    );
    echo json_encode($data);
}


?>
