
<?php include '../includes/header_ecommerce.php'; ?>
<?php

include '../database/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_quantity = 0");
while($row = mysqli_fetch_assoc($sql)){
  if($row['product_quantity'] == "0"){
    $update = "UPDATE tbl_products SET product_status = 0 WHERE product_quantity = 0";
    mysqli_query($conn, $update);
  }
}


?>

    <div class="pagetitle">
      <h1>Home</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto body">
                awe
              </div>
            </div><!-- End Recent Sales -->

            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_status = 1 ");

              while($row = mysqli_fetch_assoc($sql)){
                ?>
                  <div class="col-xxl-4 col-md-3">
                    <a href="../ecommerce/product?code=<?= $row['product_code'] ?>">
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
            
            ?>


          </div>
        </div><!-- End Left side columns -->



      </div>
    </section>


  <?php include '../includes/footer_ecommerce.php'; ?>


  <script>

  </script>