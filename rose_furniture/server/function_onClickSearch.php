<?php

include '../database/connection.php';

$search = $_POST['search'];
        // Step 1: Retrieve the total number of items from your database
        $totalItemsQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM tbl_products");
        $totalItemsData = mysqli_fetch_assoc($totalItemsQuery);
        $totalItems = $totalItemsData['total'];

        // Step 2: Calculate Pagination Parameters
        $itemsPerPage = 5;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $startIndex = ($currentPage - 1) * $itemsPerPage;

        $sql = mysqli_query($conn, "SELECT * FROM tbl_products 
        WHERE product_name LIKE '%$search%' OR product_category LIKE '%$search%' 
        AND product_status = 1 ORDER BY product_id DESC LIMIT $startIndex, $itemsPerPage");

    if(mysqli_num_rows($sql) > 0){

      $items = array();
      while ($row = mysqli_fetch_assoc($sql)) {

        $items[] = array(
          "product_id" => $row['product_id'],
          "product_name" => $row['product_name'],
          "product_image" => $row['product_image'],
          "product_price" => $row['product_price'],
          "product_code" => $row['product_code'],
        );
      }

        // Step 4: Display Data for the Current Page
        echo "";
        foreach ($items as $item) {
        ?>
          <div class="col-xxl-4 col-md-3" id="display_search">
            <a href="../ecommerce/product?id=<?= $item['product_id'] ?>&code=<?= $item['product_code'] ?>">
              <div class="card info-card">
                <div class="border">
                  <img src="../ecommerce/uploads/<?= $item['product_image'] ?>" width="100%" height="150px" alt="">
                </div>
                <div style="margin-left: 5px;">
                  <label class=""><?= $item['product_name'] ?></label>
                </div>
                <div style="margin-left: 5px;">
                  <label class="">₱<?= $item['product_price'] ?></label>
                </div>
              </div>
            </a>
          </div>
        <?php
        }
        echo "";

      if ($currentPage == $totalPages && count($items) == 0) {
        echo "<div class='text-center'><h3>No more available items</h3></div>";
      }

      // Step 5: Create Pagination Links (with a limit of 5 buttons per page)
      echo "<div class='pagination'>";
      if ($currentPage > 1) {
        echo "<a href='?page=" . ($currentPage - 1) . "'><i class='bx bx-chevrons-left'></i></a> ";
      }
      $paginationLimit = 5;
      $startButton = max(1, $currentPage - floor($paginationLimit / 2));
      $endButton = min($totalPages, $startButton + $paginationLimit - 1);
      for ($i = $startButton; $i <= $endButton; $i++) {
        if ($i == $currentPage) {
          echo "<strong>$i</strong> ";
        } else {
          echo "<a href='?page=$i'>$i</a> ";
        }
      }
      if ($currentPage < $totalPages) {
        echo "<a href='?page=" . ($currentPage + 1) . "'><i class='bx bx-chevrons-right'></i></a>";
      }
      echo "</div>";


    }else {
        echo '<div class="text-center">No Available!</div>';
    }


?>

<?php


?>