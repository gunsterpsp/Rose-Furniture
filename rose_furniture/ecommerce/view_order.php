
<?php include '../includes/header_ecommerce.php'; ?>
<style>
    /* Styling for the vertical line and circle */
    .line-container {
      position: relative;
      width: 20px;
      height: 75px;
      display: inline-block;
    }

    .vertical-line {
      width: 2px;
      height: 100px;
      background-color: #007BFF; /* Custom color for your design */
      position: absolute;
      top: -140px;
      left: 50%;
      transform: translateX(-50%);
    }

    .circle {
      width: 40px;
      height: 40px;
      background-color: #007BFF; /* Custom color for your design */
      border-radius: 50%;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      top: -45px;
      left: 50%;
      transform: translateX(-50%);
      font-weight: bold;
      font-size: 16px;
    }

    .vertical-line-1 {
      width: 2px;
      height: 100px;
      background-color: darkgray; /* Custom color for your design */
      position: absolute;
      top: -10px;
      left: 50%;
      transform: translateX(-50%);
    }

    .circle-1 {
      width: 40px;
      height: 40px;
      background-color: darkgray; /* Custom color for your design */
      border-radius: 50%;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      top: -45px;
      left: 50%;
      transform: translateX(-50%);
      font-weight: bold;
      font-size: 16px;
    }

    .order-status {
      margin-left: 40px;
    }
  </style>


<?php
@require_once '../database/connection.php';

$order_id = $_GET['code'];
$item = $_GET['item'];
$query = $conn->query(
  "SELECT t1.product_code, t1.product_name, t1.price, t1.quantity, t1.payment_method, t1.user_id, t1.detail_code, t1.status, t2.product_image 
  FROM tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON t1.product_code = t2.product_code 
  WHERE t1.order_id = '".$order_id."' AND t1.cart_id = '$item' ");
$row = $query->fetch_assoc();

$total_price = $row['price'] * $row['quantity'];

?>


    <div class="pagetitle">
      <h1></h1>

    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">


        <!-- <div class="col-lg-6">
          <div class="row">




            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="pt-4 text-center">
                <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="350px" alt="">
                </div>
                <div class="card-body">
                <h5 style="cursor: auto;"><?= $row['product_name'] ?> <span>| <?= $row['product_code'] ?></span> </b></h5>
                <div>
                  <div>
                  Quantity : <?= $row['quantity'] ?>
                  </div>
                  <div>
                  Price/Each : ₱<?= $row['price'] ?>
                  </div>
                  <div>
                  Total Amount : ₱<?= $total_price ?>
                  </div>
                  <div>
                  Payment Method : <?= $row['payment_method'] ?>
                  </div>
                </div>
                </div>
              </div>

            </div>




          </div>
        </div> -->
        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- Recent Activity -->
          <div class="card">

            <div class="card-body">

            <div class="pt-4 text-center">
                <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="350px" alt="">
                </div>
                <div class="card-body">
                <h5 style="cursor: auto;"><?= $row['product_name'] ?> <span>| <?= $row['product_code'] ?></span> </b></h5>
                <div>
                  <div>
                  Quantity : <?= $row['quantity'] ?>
                  </div>
                  <div>
                  Price/Each : ₱<?= $row['price'] ?>
                  </div>
                  <div>
                  Total Amount : ₱<?= $total_price ?>
                  </div>
                  <div>
                  Payment Method : <?= $row['payment_method'] ?>
                  </div>
                </div>
                </div>
            </div>

          </div><!-- End Recent Activity -->


        </div><!-- End Right side columns -->
        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- Recent Activity -->
          <div class="card">

            <div class="card-body">

       
      <div class="mb-4">
      </div>
      <h1 class="card-title">Tracking No. <?php
        $sqlHeader = mysqli_query($conn, "SELECT detail_code FROM tbl_order_detail_items WHERE cart_id = '".$_GET['item']."' ");
        $rowHeader = mysqli_fetch_assoc($sqlHeader);
        echo $rowHeader['detail_code'];
      ?></h1>
      <?php
        include '../database/connection.php';
        
        $sql = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE cart_id = '".$_GET['item']."' ");

        while($rowOrder = mysqli_fetch_assoc($sql)){

          if($rowOrder['order_text'] == "Order Placed"){
            ?>
            <div class="order-status">Order Placed</div>
              <div class="order-status">
                <?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?>
              </div>
              <div class="line-container">
              <!-- <div class="vertical-line"></div> -->
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }else if($rowOrder['order_text'] == "Preparing To Ship"){
            ?>
            <div class="order-status">Preparing To Ship</div>
              <div class="order-status"><?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?></div>
              <div class="line-container">
              <div class="vertical-line"></div>
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }else if($rowOrder['order_text'] == "Arrived"){
            ?>
            <div class="order-status">Your order has been arrived at <b><?php echo $rowOrder['order_remarks'] ?></b> sorting facility</div>
              <div class="order-status"><?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?></div>
              <div class="line-container">
              <div class="vertical-line"></div>
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }else if($rowOrder['order_text'] == "Departed"){
            ?>
            <div class="order-status">Your order has been departed at <b><?php echo $rowOrder['order_remarks'] ?></b> sorting facility</div>
              <div class="order-status"><?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?></div>
              <div class="line-container">
              <div class="vertical-line"></div>
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }
          else if($rowOrder['order_text'] == "In Transit"){
            ?>
            <div class="order-status">In Transit (Rider) <b><?= $rowOrder['order_remarks'] ?></b></div>
              <div class="order-status"><?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?></div>
              <div class="line-container">
              <div class="vertical-line"></div>
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }
          else if($rowOrder['order_text'] == "Delivered"){
            ?>
            <div class="order-status">Your order has been delivered</div>
              <div class="order-status"><?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?></div>
              <div class="line-container">
              <div class="vertical-line"></div>
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }else if($rowOrder['order_text'] == "Picked up"){
            ?>
            <div class="order-status">Order has been picked up by our logistic partner</div>
              <div class="order-status"><?php echo date('m-d-Y h:i A', strtotime($rowOrder['date'])); ?></div>
              <div class="line-container">
              <div class="vertical-line"></div>
              <div class="circle"><i class='bx bx-check' ></i></div>
            </div>
            <?php
          }
        }

      ?>


      <!-- <div class="order-status">Order Shipped</div>
      <div class="order-status">Order Shipped</div>
        <div class="line-container">
        <div class="vertical-line-1"></div>
        <div class="circle-1"><i class='bx bx-check' ></i></div>
      </div> -->

      <!-- <div class="order-status">Order Delivered</div>
        <div class="line-container">
        <div class="vertical-line"></div>
        <div class="circle">3</div>
      </div>

      <div class="order-status">Order Completed</div>
        <div class="line-container">
        <div class="vertical-line"></div>
        <div class="circle">4</div>
      </div> -->


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







