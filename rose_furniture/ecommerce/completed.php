<?php include '../includes/header_ecommerce.php'; 
if(!isset($_SESSION['user_id'])){
  header("../main/home");
}


?>


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Order List </h5>

                  <table id="example" class="table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Action</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="display_proof"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



<?php include '../includes/footer_ecommerce.php'; ?>



<script>

      $('#example').dataTable({
        scrollX: true,
        processing: true,
        "destroy": true,
        "order": [[0, "desc"]],
        ajax: {
            url: "../server/completed_delivery_server.php",
            'dataSrc': ""
        },
        "columns": [
        { "data": "order_id"  },
        { "data": "product_code"  },
        { "data": "product_name"  },
        { "data": "quantity"  },
        { "data": "price"  },
        { "data": "total_amount"  },
        { "data": "payment_method"  },
        { "data": "action"  },
        { "data": "status"  },
        ]
      });

      $(document).on("click", ".view_id", function(){
        const order_id = $(this).data("id")
        const view_id = $(".view_id").val();

        $.ajax({
          type: 'POST',
          url: '../server/function_completed_delivery.php',
          data: {
            order_id: order_id,
            view_id: view_id
          },
          dataType: "json",
          success: function (response) {
            $("#display_proof").html(
              '<div><label>Track No : </label> <b>'+response.tracking_no+'</b></div>\
              <div class="mb-2"><label>Proof of delivery (Image)</label><img src="../ecommerce/uploads/'+response.proof_image+'" \
              alt="" width="100%" height="250px"></div>\
              <div><label>Amount paid by the customer : ₱</label>'+response.order_remarks+'</div>\
              <div><label>Delivered by : </label> '+response.rider_name+'</div>'
            )
          }
        });
      })







      // $(document).on("click", ".cancel", function(){
      //   const order_id = $(this).data("id")
      //   const cancel = $(".cancel").val()

      //   $.ajax({
      //     type: 'POST',
      //     url: '../server/function_approval.php',
      //     data: {
      //       order_id: order_id,
      //       cancel: cancel
      //     },
      //     success: function (response) {
      //       $('#example').DataTable().ajax.reload();
      //     }
      //   });
        
      // })







   </script>