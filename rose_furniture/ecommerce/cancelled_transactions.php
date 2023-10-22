
<?php include '../includes/header_ecommerce.php'; ?>
<style>

</style>

    <div class="pagetitle">
      <h1>Cancelled Transactions</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <?php 
              include '../database/connection.php';

              $sql = mysqli_query($conn, "SELECT t1.order_id, t1.product_code, t1.product_name, 
              t1.price, t1.quantity, t1.user_id, t1.status, t2.product_image FROM 
              tbl_order_detail_items t1 LEFT JOIN tbl_products t2 ON 
              t1.product_code = t2.product_code WHERE t1.user_id = '".$_SESSION['user_id']."' AND t1.status = 0");

              while($row = mysqli_fetch_assoc($sql)){

                $totalQty = $row['price'] * $row['quantity'];

                $sum = $conn->query("SELECT price, SUM(quantity) AS 'quantity' FROM tbl_cart_items WHERE user_id = '".$_SESSION['user_id']."' ");
                $fetchSum      = $sum->fetch_assoc();
                
                $totalSum = $fetchSum['price'] * $fetchSum['quantity'];
              
                ?>
                  <div class="col-xxl-4 col-md-3 btn-link view_id" data-id="<?= $row['order_id'] ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                   
                    <div class="card info-card">


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
        <div id="image_append"></div>
        <div>
        <label for="" id="details"></label>
        </div>
        <div>
        <label for="" id="total_amount"></label>
        </div>
        <div>
        <label for="" id="date_cancelled"></label>
        </div>
        
        
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



  <?php include '../includes/footer_ecommerce.php'; ?>


  <script>

    $(document).on("click", ".view_id", function(){
      const order_id = $(this).data("id");
      const view_btn = $(".view_id").val();

        $.ajax({
                url: "../server/function_cancelled.php",
                type: "POST",
                data: {
                  order_id: order_id,
                  view_btn: view_btn
                }, 
                dataType: "json",
                success: function(response){  
                  $("#staticBackdropLabel").html(response.product_name)

                  $("#image_append").html(
                    '<img src="../ecommerce/uploads/'+response.product_image+'" alt="" width="100%" height="300px">'
                  )

                  var total = response.price * response.quantity;


                  $("#details").html('Price/ea : ' + response.price + '| Quantity : ' + response.quantity);
                  $("#total_amount").html('Total Amount : ' + total)
                  $("#date_cancelled").html('Date Cancelled : ' + response.date_cancelled)
                   
                }
            });
      


    })

  </script>