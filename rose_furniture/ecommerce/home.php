<?php include '../includes/header_ecommerce.php'; ?>
<style>
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .pagination a {
    padding: 10px;
    text-decoration: none;
    border: 1px solid #ccc;
    margin: 5px;
    background-color: #f0f0f0;
  }

  .pagination a:hover {
    background-color: #ddd;
  }

  .pagination strong {
    padding: 10px;
    border: 1px solid #ccc;
    margin: 5px;
    background-color: #007BFF;
    color: #fff;
  }
</style>
<?php

include '../database/connection.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../main/home');
  exit;
}


$sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_quantity = 0");
while ($row = mysqli_fetch_assoc($sql)) {
  if ($row['product_quantity'] == "0") {
    $update = "UPDATE tbl_products SET product_status = 0 WHERE product_quantity = 0";
    mysqli_query($conn, $update);
  }
}


?>
<style>
  .block-ul {
    display: inline-block;
    list-style: none;
  }
</style>

<div class="pagetitle">
  <!-- <h1>Home</h1> -->
  <nav>
    <ol class="breadcrumb">
      <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
          <li class="breadcrumb-item active">Categories</li>
    </ol>
  </nav>



  <?php
  $sql = mysqli_query($conn, "SELECT * FROM tbl_category WHERE category_status = 1");
  while ($row = mysqli_fetch_assoc($sql)) {
    echo '<ul class="block-ul">
              <li><a style="cursor: pointer;"class="category_search" data-id="' . $row['category_name'] . '">' . $row['category_name'] . '</a></li>
              </ul>';
  }
  ?>




</div><!-- End Page Title -->
<h1 class="card-title">Lastest Products</h1>
<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">

      <div class="row" id="display_search">


        <!-- <div class="col-12">
              <div class="card recent-sales overflow-auto body">
                awe
              </div>
            </div> -->
        <!-- <label id="display_search"></label> -->
        <?php

        include '../database/connection.php';

        // Step 1: Retrieve the total number of items from your database
        $totalItemsQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM tbl_products");
        $totalItemsData = mysqli_fetch_assoc($totalItemsQuery);
        $totalItems = $totalItemsData['total'];

        // Step 2: Calculate Pagination Parameters
        $itemsPerPage = 20;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $startIndex = ($currentPage - 1) * $itemsPerPage;

        // Step 3: Retrieve Data for the Current Page
        // $sql = mysqli_query($conn, "SELECT notification_text, date FROM tbl_notifications WHERE receiver_id = '".$_SESSION['user_id']."' ORDER BY notification_id DESC LIMIT $startIndex, $itemsPerPage");
        $sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_status = 1 ORDER BY product_id DESC LIMIT $startIndex, $itemsPerPage");
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
          <div class="col-xxl-4 col-md-3 display_hide">
            <a href="../ecommerce/product?id=<?= $item['product_id'] ?>&code=<?= $item['product_code'] ?>">
              <div class="card info-card" style="height: 225px;">
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
        ?>


      </div>
    </div><!-- End Left side columns -->



  </div>
</section>


<?php include '../includes/footer_ecommerce.php'; ?>


<script>
  $(document).on("click", ".category_search", function() {

    const search = $(this).data("id");


    $.ajax({
      type: 'POST',
      url: '../server/function_onClickSearch.php',
      data: {
        search: search,
      },
      success: function(response) {
        $("#display_search").html(response);
        $("#search").val(search);
        $(".display_hide").hide();
      }
    });
  })




</script>