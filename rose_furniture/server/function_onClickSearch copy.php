<?php

include '../database/connection.php';

$search = $_POST['search'];

$sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_name LIKE '%$search%' OR product_category LIKE '%$search%' AND product_status = 1");

    if(mysqli_num_rows($sql) > 0){
        while ($row = mysqli_fetch_assoc($sql)) {
            ?>
                              <div class="col-xxl-4 col-md-3" id="display_search">
                                <a href="../ecommerce/product?id=<?= $row['product_id'] ?>&code=<?= $row['product_code'] ?>">
                                <div class="card info-card">
                                <div class="border">
                                <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                                </div>
                                  <div style="margin-left: 5px;">
                                    <label class=""><?= $row['product_name'] ?></label>
                                  </div>
                                  <div style="margin-left: 5px;">
                                  <label class="">₱<?= $row['product_price'] ?></label>
                                  </div>
                                </div>
                                </a>
                              </div>  
            <?php
            }
    }else {
        echo '<div class="text-center"><h1>No Available!</h1></div>';
    }


?>

<?php


?>