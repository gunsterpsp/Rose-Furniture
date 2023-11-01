
<?php include '../includes/header_ecommerce.php'; 

$history = $_GET['history'];

?>
<style>

</style>

    <div class="pagetitle">
      <h1>My Purchase</h1>
    </div><!-- End Page Title -->
    <div>
    <nav class="mb-3">
      <button class="btn btn-gray"><a href="my_purchase?history=to_pay">To Pay 
        <?php 
                $cartSelect = $conn->query("SELECT COUNT(order_id) AS 'count' FROM tbl_order_detail_items WHERE user_id = '$getID' AND to_pay = 1 AND status = 1 ");
                $cartItem = $cartSelect->fetch_assoc();
            ?>
           <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span>  
           </a>
          </button>
          <button class="btn btn-gray"><a href="my_purchase?history=to_ship">To Ship 
          <?php 
                $cartSelect = $conn->query("SELECT COUNT(order_id) AS 'count' FROM tbl_order_detail_items WHERE user_id = '$getID' AND to_ship IN (1, 2) AND to_pickup IN (0, 1, 2) AND in_transit IN (0,1,2) AND to_deliver IN (0,1) ");
                $cartItem = $cartSelect->fetch_assoc();
            ?>
           <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span> 
          </a></button>
          <button class="btn btn-gray"><a href="my_purchase?history=to_receive">To Receive 
          <?php 
                $cartSelect = $conn->query("SELECT COUNT(order_id) AS 'count' FROM tbl_order_detail_items WHERE user_id = '$getID' AND to_deliver IN (1, 2) AND to_complete = 1 ");
                $cartItem = $cartSelect->fetch_assoc();
            ?>
           <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span> 
          </a></button>
          <button class="btn btn-gray">
            <a href="my_purchase?history=completed">Completed</a>
          </button>
          <button class="btn btn-gray">
            <a href="my_purchase?history=cancelled">Cancelled</a>
          </button>
      </nav>
    </div>
<!-- 

             <div class="text-end" style="margin-left: 5px;">
            <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span>
            </div> -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
        
            <?php
              if($_GET['history'] == "to_pay"){
                ?>
                
            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT t1.status, t1.cart_id, t1.detail_code, t1.order_id, t1.product_code, t1.product_name, 
              t1.price, t1.quantity, t1.user_id, t1.to_pay, t2.product_image FROM 
              tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
              t1.product_code = t2.product_code WHERE t1.user_id = '".$_SESSION['user_id']."' AND t1.to_pay = 1 AND t1.status = 1 ");

              if(mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_assoc($sql)){

                  $totalQty = $row['price'] * $row['quantity'];
  
                  $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
                  $fetchSum      = $sum->fetch_assoc();
                  
                  $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
                
                  ?>
                  
                    <div class="col-xxl-4 col-md-3 btn-link">
                    
                      <div class="card info-card">
                        <div style="position: relative;">
                          <button class="btn btn-danger btn-sm deleteItem" data-name="<?= $row['product_name'] ?>" data-id="<?= $row['order_id'] ?>" style="position: absolute; right: 3px; top: 3px;">X</button>
                        </div>
                        <a href="view_order?code=<?= $row['order_id']; ?>&item=<?= $row['cart_id']; ?>&track_no=<?= $row['detail_code'] ?>">
                      <div class="border">
                      <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                      </div>
                      <div style="margin-left: 5px;">
                      <div class="ml-2 ">
                          <label class=""><?= $row['product_name'] ?></label>
                        </div>
                        <div>
                        <label class="">Price/ea : ₱<?= $row['price'] ?> | Qty : <?= $row['quantity'] ?></label>
                        </div>
                        <div>
                        <label class="">Total : ₱<?= $totalQty ?></label>
                        </div>
                      </div>
  
                      </div>
                      </a>
                    </div>  
                    
                  <?php
                }
              }else {
                ?>
                  <div class="text-center">
                    <h1>No available items!</h1>
                  </div>
                <?php
              }


            
            ?>
                
                <?php
              }else if($_GET['history'] == "to_ship"){
                ?>
                <?php 
                  include '../database/connection.php';

                  $sql = mysqli_query($conn, "SELECT t1.to_deliver, t1.in_transit, t1.to_pickup, t1.cart_id, t1.detail_code, t1.order_id, t1.product_code, t1.product_name, 
                  t1.price, t1.quantity, t1.user_id, t1.to_pay, t2.product_image FROM 
                  tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
                  t1.product_code = t2.product_code WHERE t1.user_id = '".$_SESSION['user_id']."' AND t1.to_ship IN (1, 2) AND t1.to_pickup IN (0, 1, 2) AND t1.in_transit IN (0,1,2) AND t1.to_deliver IN (0,1) ");

                  if(mysqli_num_rows($sql)){

                    while($row = mysqli_fetch_assoc($sql)){

                      $totalQty = $row['price'] * $row['quantity'];
  
                      $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
                      $fetchSum      = $sum->fetch_assoc();
                      
                      $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
                    
                      ?>
                      
                        <div class="col-xxl-4 col-md-3 btn-link">
                        
                          <div class="card info-card">
                            <a href="view_order?code=<?= $row['order_id']; ?>&item=<?= $row['cart_id']; ?>&track_no=<?= $row['detail_code'] ?>">
                          <div class="border">
                          <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                          </div>
                          <div style="margin-left: 5px;">
                          <div class="ml-2 ">
                              <label class=""><?= $row['product_name'] ?></label>
                            </div>
                            <div>
                            <label class="">Price/ea : ₱<?= $row['price'] ?> | Qty : <?= $row['quantity'] ?></label>
                            </div>
                            <div>
                            <label class="">Total : ₱<?= $totalQty ?></label>
                            </div>
                          </div>
  
                          </div>
                          </a>
                        </div>  
                        
                      <?php
                    }
                  }else {
                    ?>
                    <div class="text-center">
                      <h1>No available items!</h1>
                    </div>
                  <?php
                  }

                
                ?>
                
                <?php
              }else if($_GET['history'] == "to_receive"){
                ?>
            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT t1.cart_id, t1.detail_code, t1.order_id, t1.product_code, t1.product_name, 
              t1.price, t1.quantity, t1.user_id, t1.to_pay, t2.product_image FROM 
              tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
              t1.product_code = t2.product_code WHERE t1.user_id = '".$_SESSION['user_id']."' AND t1.to_deliver IN (1, 2) AND to_complete IN (1)");

              if(mysqli_num_rows($sql)){
                while($row = mysqli_fetch_assoc($sql)){

                  $totalQty = $row['price'] * $row['quantity'];

                  $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
                  $fetchSum      = $sum->fetch_assoc();
                  
                  $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
                
                  ?>
                  
                    <div class="col-xxl-4 col-md-3 btn-link">
                    
                      <div class="card info-card">
                        <a href="view_order?code=<?= $row['order_id']; ?>&item=<?= $row['cart_id']; ?>&track_no=<?= $row['detail_code'] ?>">
                      <div class="border">
                      <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                      </div>
                      <div style="margin-left: 5px;">
                      <div class="ml-2 ">
                          <label class=""><?= $row['product_name'] ?></label>
                        </div>
                        <div>
                        <label class="">Price/ea : ₱<?= $row['price'] ?> | Qty : <?= $row['quantity'] ?></label>
                        </div>
                        <div>
                        <label class="">Total : ₱<?= $totalQty ?></label>
                        </div>
                      </div>

                      </div>
                      </a>
                    </div>  
                    
                  <?php
                }
              }else {
                ?>
                <div class="text-center">
                  <h1>No available items!</h1>
                </div>
              <?php
              }


            
            ?>
                <?php
              }else if($_GET['history'] == "completed"){
                ?>
            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT t1.cart_id, t1.detail_code, t1.order_id, t1.product_code, t1.product_name, 
              t1.price, t1.quantity, t1.user_id, t1.to_pay, t2.product_image FROM 
              tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
              t1.product_code = t2.product_code WHERE t1.user_id = '".$_SESSION['user_id']."' AND to_complete = 2");

              if(mysqli_num_rows($sql)){
                while($row = mysqli_fetch_assoc($sql)){

                  $totalQty = $row['price'] * $row['quantity'];

                  $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
                  $fetchSum      = $sum->fetch_assoc();
                  
                  $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
                
                  ?>
                  
                    <div class="col-xxl-4 col-md-3 btn-link">
                    
                      <div class="card info-card">
                        <a href="view_order?code=<?= $row['order_id']; ?>&item=<?= $row['cart_id']; ?>&track_no=<?= $row['detail_code'] ?>">
                      <div class="border">
                      <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                      </div>
                      <div style="margin-left: 5px;">
                      <div class="ml-2 ">
                          <label class=""><?= $row['product_name'] ?></label>
                        </div>
                        <div>
                        <label class="">Price/ea : ₱<?= $row['price'] ?> | Qty : <?= $row['quantity'] ?></label>
                        </div>
                        <div>
                        <label class="">Total : ₱<?= $totalQty ?></label>
                        </div>
                      </div>

                      </div>
                      </a>
                    </div>  
                    
                  <?php
                }
              }else {
                ?>
                <div class="text-center">
                  <h1>No available items!</h1>
                </div>
              <?php
              }


            
            ?>
            <?php
              }else if($_GET['history'] == "cancelled"){
                ?>
            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT t1.cart_id, t1.detail_code, t1.order_id, t1.product_code, t1.product_name, 
              t1.price, t1.quantity, t1.user_id, t1.to_pay, t2.product_image FROM 
              tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
              t1.product_code = t2.product_code WHERE t1.user_id = '".$_SESSION['user_id']."' AND status = 0");

              if(mysqli_num_rows($sql)){
                while($row = mysqli_fetch_assoc($sql)){

                  $totalQty = $row['price'] * $row['quantity'];

                  $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
                  $fetchSum      = $sum->fetch_assoc();
                  
                  $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
                
                  ?>
                  
                    <div class="col-xxl-4 col-md-3 btn-link">
                    
                      <div class="card info-card">
                        <a href="view_order?code=<?= $row['order_id']; ?>&item=<?= $row['cart_id']; ?>&track_no=<?= $row['detail_code'] ?>">
                      <div class="border">
                      <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                      </div>
                      <div style="margin-left: 5px;">
                      <div class="ml-2 ">
                          <label class=""><?= $row['product_name'] ?></label>
                        </div>
                        <div>
                        <label class="">Price/ea : ₱<?= $row['price'] ?> | Qty : <?= $row['quantity'] ?></label>
                        </div>
                        <div>
                        <label class="">Total : ₱<?= $totalQty ?></label>
                        </div>
                      </div>

                      </div>
                      </a>
                    </div>  
                    
                  <?php
                }
              }else {
                ?>
                <div class="text-center">
                  <h1>No available items!</h1>
                </div>
              <?php
              }


            
            ?>
            <?php
              }
            
            ?>



          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>



  <?php include '../includes/footer_ecommerce.php'; ?>


  <script>
      $(document).on("click", ".deleteItem", function(){
        const order_id = $(this).data("id");
        const product_name = $(this).data("name");
        const deleteItem = $(".deleteItem").val();

        Swal.fire({
          title: 'Do you want to remove this item ' + product_name +'?',
          showDenyButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Saved!', '', 'success')
            const data = {
              deleteItem: deleteItem,
              order_id: order_id
            }
            $.ajax({
                url: "../server/function_po.php",
                type: "POST",
                data: data, 
                success: function(data){
                  setTimeout((function() {
                    location.reload();
                  }), 1500);
                }
            });
          }
        })
      })

      $(document).on("click", ".confirmItem", function(){
        const full_name = $("#full_name").val();
        const delivery_address = $("#delivery_address").val();
        const contact_no = $("#contact_no").val();
        const total_price = $("#total_price").val();
        const payment_method = $("#payment_method").val();
        const confirmItem = $(".confirmItem").val();

        const data = {
          full_name: full_name,
          delivery_address: delivery_address,
          contact_no: contact_no,
          total_price: total_price,
          payment_method: payment_method,
          confirmItem: confirmItem
        }

        if(payment_method == 0) return Swal.fire('Payment Method','cannot be empty!','info');

        Swal.fire({
          title: 'Do you want all this item to order?',
          showDenyButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Saved!', '', 'success');
            $.ajax({
                url: "../server/function_cart.php",
                type: "POST",
                data: data, 
                success: function(data){
                  $("#staticBackdrop").modal("hide")
                  setTimeout((function() {
                    location.reload();
                  }), 1500);
                }
            });

          }
        })


      })

  </script>