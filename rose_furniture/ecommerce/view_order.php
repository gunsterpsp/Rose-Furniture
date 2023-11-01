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
    background-color: #007BFF;
    /* Custom color for your design */
    position: absolute;
    top: -140px;
    left: 50%;
    transform: translateX(-50%);
  }



  .circle {
    width: 40px;
    height: 40px;
    background-color: #007BFF;
    /* Custom color for your design */
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
    background-color: darkgray;
    /* Custom color for your design */
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
  }

  .circle-1 {
    width: 40px;
    height: 40px;
    background-color: darkgray;
    /* Custom color for your design */
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
$track_no = $_GET['track_no'];
$query = $conn->query(
  "SELECT t1.product_code, t1.product_name, t1.price, t1.quantity, t1.payment_method, t1.user_id, t1.detail_code, t1.status, t2.product_image 
  FROM tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON t1.product_code = t2.product_code 
  WHERE t1.order_id = '" . $order_id . "' AND t1.cart_id = '$item' "
);
$row = $query->fetch_assoc();

$total_price = $row['price'] * $row['quantity'];

?>


<div class="pagetitle">
  <h1></h1>

</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-6">

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
              <?php
              $sqlRefund = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE order_id = '" . $_GET['code'] . "' ");
              $fetchRefund = mysqli_fetch_assoc($sqlRefund);

              if ($fetchRefund['refund_status'] == "1") {
              ?>
                <div>
                  <label for="">Note : After 3 days of purchase this product cannot be refunded
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RefundBackdrop">Request for refund</button></label>
                </div>
              <?php
              }
              ?>
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
                                              $sqlHeader = mysqli_query($conn, "SELECT detail_code, cart_id FROM tbl_order_detail_items WHERE cart_id = '" . $_GET['item'] . "' ");
                                              $rowHeader = mysqli_fetch_assoc($sqlHeader);
                                              echo $rowHeader['detail_code'];
                                              ?></h1>
          <div class="line-blue">
            <?php
            include '../database/connection.php';

            $sql = mysqli_query($conn, "SELECT * FROM tbl_order_process WHERE cart_id = '" . $_GET['item'] . "' ");

            while ($rowOrder = mysqli_fetch_assoc($sql)) {

              if ($rowOrder['order_text'] == "Order Placed") {
            ?>
                <div class="order-status">Order Placed</div>
                <div class="order-status">
                  <?php
                  $dateString = $rowOrder['date']; // Replace this with your date string
                  $dateTime = new DateTime($dateString);
                  $formattedDate = $dateTime->format('F j, Y g:i A');
                  echo $formattedDate; ?>
                </div>
                <div class="line-container">
                  <!-- <div class="vertical-line"></div> -->
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "Preparing To Ship") {
              ?>
                <div class="order-status">Preparing To Ship</div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?></div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "Arrived") {
              ?>
                <div class="order-status">Your order has been arrived at <b><?php echo $rowOrder['order_remarks'] ?></b> sorting facility</div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?></div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "Departed") {
              ?>
                <div class="order-status">Your order has been departed at <b><?php echo $rowOrder['order_remarks'] ?></b> sorting facility</div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?></div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "In Transit" && $rowOrder['rider_status'] == 1) {
              ?>
                <div class="order-status">In Transit (Rider) <b><?= $rowOrder['order_remarks'] ?></b></div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?></div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "Delivered") {
              ?>
                <div class="order-status">Your order has been delivered</div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?>
                  <a href="#" class="view_id" data-bs-toggle='modal' data-id='<?= $rowHeader['cart_id'] ?>' data-bs-target='#viewBackdrop'>View Detail</a>
                </div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="viewBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="viewBackdropLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div id="display_proof"></div>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-primary" name="submit">Submit</button> -->
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "Picked up") {
              ?>
                <div class="order-status">Order has been picked up by our logistic partner</div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?></div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
              <?php
              } else if ($rowOrder['order_text'] == "Cancelled") {
              ?>
                <div class="order-status">Order has cancelled</div>
                <div class="order-status"><?php
                                          $dateString = $rowOrder['date']; // Replace this with your date string
                                          $dateTime = new DateTime($dateString);
                                          $formattedDate = $dateTime->format('F j, Y g:i A');
                                          echo $formattedDate;
                                          ?></div>
                <div class="line-container">
                  <div class="vertical-line"></div>
                  <div class="circle"><i class='bx bx-check'></i></div>
                </div>
            <?php
              }else if ($rowOrder['order_text'] == "Refund") {
                ?>
                  <div class="order-status"><?= $rowOrder['order_remarks'] ?></div>
                  <div class="order-status"><?php
                                            $dateString = $rowOrder['date']; // Replace this with your date string
                                            $dateTime = new DateTime($dateString);
                                            $formattedDate = $dateTime->format('F j, Y g:i A');
                                            echo $formattedDate;
                                            ?></div>
                  <div class="line-container">
                    <div class="vertical-line"></div>
                    <div class="circle"><i class='bx bx-check'></i></div>
                  </div>
              <?php
                }
            }

            ?>
          </div>

        </div>

      </div>
</section>


<!-- Modal -->
<div class="modal fade" id="RefundBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RefundBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="">Reason for refund</label>
        <textarea id="refund_text" class="form-control" rows="3"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary refundBtn">Submit</button>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer_ecommerce.php'; ?>


<script>
  $(document).on("click", ".view_id", function() {
    const cart_id = $(this).data("id")
    const view_id = $(".view_id").val();

    $.ajax({
      type: 'POST',
      url: '../server/function_view_order.php',
      data: {
        cart_id: cart_id,
        view_id: view_id
      },
      dataType: "json",
      success: function(response) {
        console.log(response)
        $("#display_proof").html(
          '<div class="mb-2"><label>Proof of delivery (Image)</label><img src="../ecommerce/uploads/' + response.proof_image + '" \
              alt="" width="100%" height="250px"></div>\
              <div><label>Amount you paid : ₱</label>' + response.order_remarks + '</div>'
        )
      }
    });
  })


  $(document).on("click", ".refundBtn", function(){

    const refund_text = $("#refund_text").val();
    const refundBtn = $(".refundBtn").val();
    const track_no = '<?= $_GET['track_no'] ?>';
    const cart_id = '<?= $_GET['item'] ?>';

    $.ajax({
      type: 'POST',
      url: '../server/function_view_order.php',
      data: {
        refund_text: refund_text,
        refundBtn: refundBtn,
        track_no: track_no,
        cart_id: cart_id
      },
      success: function(response){

      }
    })



  })
</script>