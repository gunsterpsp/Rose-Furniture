
<?php include '../includes/header_ecommerce.php'; ?>

<?php
@require_once '../database/connection.php';

$product_code = $_GET['code'];
$query = $conn->query("SELECT * FROM `tbl_products` WHERE `product_code` = '".$product_code."' ");
$row = $query->fetch_assoc();

?>


    <div class="pagetitle">
      <h1></h1>

    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-6">
          <div class="row">
              <div class="card info-card customers-card">
                <div class="p-4 text-center">
                <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="90%" height="350px" alt="">
                </div>
              </div>
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- Recent Activity -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title"><?= $row['product_name'] ?> <span>| <?= $row['product_code'] ?></span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div style="margin-right: 5px;"><b>Price : </b><?= $row['product_price'] ?></div>
                </div>
                <div class="activity-item d-flex">
                  <div style="margin-right: 5px;"><b>Category : </b><?= $row['product_category'] ?></div>
                </div>
                <div class="activity-item d-flex">
                  <div class="" style="margin-right: 5px;"><b>Description : </b><?= $row['product_description'] ?></div>
                </div>
                <div class="activity-item d-flex">
                  <div style="margin-right: 5px;"><b>Available Stocks : </b><?= $row['product_quantity'] ?></div>
                </div>

                <div class="mt-2">
                  <button id="countMinus" style="width: 35px; height: 34px;">-</button>
                  <input type="text" id="count" value="1" readonly style="width: 35px; height: 34px;">
                  <button id="countPlus" style="width: 35px; height: 34px;">+</button>
                  <button class="btn btn-primary w-100 mt-2 addItem">Add to Cart</button>
                </div>



              </div>

            </div>
          </div><!-- End Recent Activity -->


        </div><!-- End Right side columns -->

      </div>
    </section>


  <?php include '../includes/footer_ecommerce.php'; ?>


  <script>
const countPlus = document.getElementById('countPlus');
const countMinus = document.getElementById('countMinus');
const countInput = document.getElementById('count');
let count = 1;

countPlus.addEventListener('click', () => {
    count++; // Increment the count
    countInput.value = count; // Update the value of the input field to display the updated count
});

countMinus.addEventListener('click', () => {
    count--; // Increment the count
    countInput.value = count; // Update the value of the input field to display the updated count
});


  $(document).on("click", ".addItem", function(){
    const product_code = '<?php echo $row['product_code'] ?>';
    const product_name = '<?php echo $row['product_name'] ?>';
    const product_price = '<?php echo $row['product_price'] ?>';
    const product_quantity = $("#count").val();
    const addItem = $(".addItem").val();

    const data = {
      product_code: product_code,
      product_name: product_name,
      product_price: product_price,
      product_quantity: product_quantity,
      addItem: addItem
    }

    $.ajax({
        type: 'POST',
        url: '../server/function_cart.php',
        data: data,
        success: function (response) {

            location.reload();
        }
    });


  })


  </script>