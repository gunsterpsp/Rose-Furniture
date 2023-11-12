
<?php include '../includes/header_ecommerce.php'; 
if(!isset($_SESSION['user_id']) || !isset($_SESSION['group_code'])){
  header('Location: ../main/home');
  die();
}


?>
<style>
      /* Style for the checkbox container */
      .checkbox-container {
      display: inline-block;
      position: relative;
      padding-left: 30px; /* Space for the checkbox */
      cursor: pointer;
    }

    /* Style for the checkbox input */
    .checkbox-container input {
      position: absolute;
      opacity: 0; /* Hide the actual checkbox */
      cursor: pointer;
    }

    /* Style for the custom checkbox design */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #eee;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    /* Style for the checkmark when the checkbox is checked */
    .checkbox-container input:checked + .checkmark {
      background-color: #2196F3;
    }

    /* Style for the checkmark icon */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Display the checkmark icon when the checkbox is checked */
    .checkbox-container input:checked + .checkmark:after {
      display: block;
    }

    /* Style for the checkmark icon itself */
    .checkbox-container .checkmark:after {
      left: 7px;
      top: 3px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }
</style>



    <div class="pagetitle">
      <h1>My Cart</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT t1.cart_id, t1.product_code, 
              t1.product_name, t1.price, t1.quantity, t2.product_image FROM 
              tbl_cart_items t1 LEFT JOIN tbl_products t2 ON t1.product_code = t2.product_code 
              WHERE user_id = '".$_SESSION['user_id']."' AND status = 1 ");

              while($row = mysqli_fetch_assoc($sql)){

                $totalQty = $row['price'] * $row['quantity'];

                $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' AND status = 1 ");
                $fetchSum      = $sum->fetch_assoc();
                
                $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
              
                ?>
                  <div class="col-xxl-4 col-md-3 btn-link">
                   
                    <div class="card info-card">
                    <label class="checkbox-container">
                      <input type="checkbox" value="<?= $row['cart_id'] ?>" name="all_cartId[]">
                      <span class="checkmark"></span>
                    </label>
                      <!-- <div style="position: relative;">
                      <input type="checkbox" style="position: absolute; left: 3px; top: 3px;">
                      </div> -->
                      <div style="position: relative;">
                        <button class="btn btn-danger btn-sm deleteItem" data-name="<?= $row['product_name'] ?>" data-id="<?= $row['cart_id'] ?>" style="position: absolute; right: 3px; top: 3px;">X</button>
                      </div>

                    <div class="border">
                    <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="100%" height="150px" alt="">
                    </div>
                    <div style="margin-left: 5px;">
                    <div class="ml-2 ">
                        <label class=""><?= $row['product_name'] ?></label>
                      </div>
                      <div>
                      <label class="">Price/ea : <?= $row['price'] ?> | Qty : <?= $row['quantity'] ?></label>
                      </div>
                      <div>
                      <label class="">Total : <?= $totalQty ?></label>
                      </div>
                    </div>

                    </div>
         
                  </div>  
                <?php
              }
            
            ?>

            <?php
                $count = $conn->query("SELECT COUNT(cart_id) AS 'count' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' AND status = 1 ");
                $fetchCount = $count->fetch_assoc();

                if($fetchCount['count'] == 0){
                  ?>
                <div class="text-center">
                  <h4>NO AVAILABLE ITEMS IN YOUR <br>CART PLEASE ADD ONE <a href="home">HERE</a></h4>
                </div>
                  <?php
                }else {
                  ?>
                    <div>
                      <button class="btn btn-primary view_id">Place Order</button>
                    </div>
                  <?php
                }
            
            ?>
            



          </div>
        </div><!-- End Left side columns -->



      </div>
    </section>




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
          // $userData = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '".$_SESSION['user_id']."' ");
          // $userRow = mysqli_fetch_assoc($userData);

          // $full_name = $userRow['first_name'] . ' ' . $userRow['last_name'];
        ?>
        <div class="mb-2">
          <label for="">Note!, Please check your if all your information is correct before you confirm!</label>
        </div>
        <div>
          <label for=""><b>Full Name :</b> <label for="" id="full_name_label"></label></label>
          <input type="hidden" id="full_name">
        </div>
        <div>
          <label for=""><b>Delivery Address :</b> <label for="" id="delivery_address_label"></label></label>
          <input type="hidden" id="delivery_address">
        </div>
        <div>
          <label for=""><b>Contact No :</b> <label for="" id="contact_no_label"></label></label>
          <input type="hidden" id="contact_no">
        </div>
        <div>
          <label for=""><b>Total Price :</b> ₱<label for="" id="total_price_label"></label></label>
          <input type="hidden" id="total_price">
        </div>
        <!-- <div>
          <select name="" id="payment_method" class="form-select">
            <option value="0">Select Payment Method</option>
            <option value="Cash On Deliery">Cash On Deliery</option>
            <option value="GCASH">GCASH</option>
          </select>
        </div> -->
        <div class="new_data"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary confirmItem">Confirm</button>
      </div>
    </div>
  </div>
</div>


  <?php include '../includes/footer_ecommerce.php'; ?>


  <script>
      $(document).on("click", ".deleteItem", function(){
        const cart_id = $(this).data("id");
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
              cart_id: cart_id
            }
            $.ajax({
                url: "../server/function_cart.php",
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

        var cart_id = [];
            $("input[name='all_cartId[]']:checked").each(function(){
              
              cart_id.push(this.value);
            });
            var count1 = cart_id.length;
          
          for(var i=0; i<count1; i++){
            
                var url = cart_id[i];
          }
          
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
          confirmItem: confirmItem,
          cart_id: cart_id
        }

        if(payment_method == 0) return Swal.fire('Payment Method','cannot be empty!','info');

        Swal.fire({
          title: 'Do you want all this item to order?',
          showDenyButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Ordered Successfully!', '', 'success');
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



      $(document).on("click", ".view_id", function(){
        const view_id = $(".view_id").val();
        var cart_id = [];
            $("input[name='all_cartId[]']:checked").each(function(){
              
              cart_id.push(this.value);
            });
            var count1 = cart_id.length;
          
          for(var i=0; i<count1; i++){
            
                var url = cart_id[i];
          }

          if(count1 == 0){
            return Swal.fire('Please select an item you wish to place order!','','info');
          }else {
            const data = {
            cart_id: cart_id,
            view_id: view_id
          }
          $.ajax({
                url: "../server/function_cart.php",
                type: "POST",
                data: data, 
                dataType: "json",
                success: function(response){
                  $("#full_name_label").html(response.full_name)
                  $("#full_name").val(response.full_name)

                  $("#delivery_address_label").html(response.delivery_address)
                  $("#delivery_address").val(response.delivery_address)

                  $("#contact_no_label").html(response.contact_no)
                  $("#contact_no").val(response.contact_no)


                  $("#total_price_label").html(response.total_price)
                  $("#total_price").val(response.total_price)
                  // data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                  $("#staticBackdrop").modal("show");


                }
            });
          }



        
      })





  </script>