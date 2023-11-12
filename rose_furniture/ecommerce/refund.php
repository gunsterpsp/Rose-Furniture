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
                        <th scope="col">Tracking No.</th>
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
      <button type="button" class="btn btn-primary approveRefund">Approve</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="RefundBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RefundBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="display_rider"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary approveRider">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changeRiderBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeRiderBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="display_change"></div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary changeRider">Confirm</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ConfirmBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ConfirmBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="imageUploadForm" action="#" method="post" enctype="multipart/form-data">
          <div>
            <input type="hidden" name="cart_id" id="cart_id">
          </div>
          <div class="mb-2">
            <label for="">Proof of refund GCASH No.(Screenshot)</label>
            <input type="file" accept=".jpg, .png" class="form-control" name="new_image" id="new_image">
          </div>
          <div class="mb-2">
          <label for="">Gcash No.</label>
            <input type="text" id="gcash" name="gcash" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
      </form>
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
            url: "../server/refund_server_admin.php",
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
        { "data": "tracking_no"  },
        { "data": "action"  },
        { "data": "status"  },
        ]
      });

      $(document).on("click", ".view_id", function(){
        const order_id = $(this).data("id")
        const view_id = $(".view_id").val();

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: {
            order_id: order_id,
            view_id: view_id
          },
          dataType: "json",
          success: function (response) {
            $("#display_proof").html(
              '<div><input type="hidden" id="tracking_no" value='+response.tracking_no+'><label>Track No : </label> <b>'+response.tracking_no+'</b></div>\
              <div>'+response.order_remarks+'</div>\
              <div><label>Reason</label><div>'+response.refund_text+'</div></div>'
            )
          }
        });
      })



      $(document).on("click", ".approveRefund", function(){
        const detail_code = $("#tracking_no").val();
        const approveRefund = $(".approveRefund").val();
        
        Swal.fire({
        title: 'Do you want to approve this order?'+ ' '+detail_code,
        showDenyButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('Order '+detail_code+' has been approved for refund', '', 'success');
          $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: {
            detail_code: detail_code,
            approveRefund: approveRefund
          },
          success: function (response) {
            $('#example').DataTable().ajax.reload();
            $("#staticBackdrop").modal("hide")
          }
        });

        }
      })
      })

      $(document).on("click", ".refund_view", function(){

        const refund_view = $(".refund_view").val();
        const order_id = $(this).data("id");

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: {
            refund_view: refund_view,
            order_id: order_id
          },
          success: function (response) {
            $("#display_rider").html(response);
          }
        });
      });

      $(document).on("click", ".change_view", function(){

        const change_view = $(".change_view").val();
        const order_id = $(this).data("id");

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: {
            change_view: change_view,
            order_id: order_id
          },
          success: function (response) {
            $("#display_change").html(response);
          }
        });
        });

      $(document).on("click", ".approveRider", function(){
        const order_id = $("#order_id").val();
        const rider_id = $("#rider_id").val();
        const approveRider = $(".approveRider").val();

        Swal.fire({
        title: 'Do you want to set this rider?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('Rider for refund has been set!', '', 'success');

          const data = {
          order_id: order_id,
          rider_id: rider_id,
          approveRider: approveRider
        }

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: data,
          success: function (response) {
            $('#example').DataTable().ajax.reload();
            $("#RefundBackdrop").modal("hide");
          }
        });

        }
      })
      })

      $(document).on("click", ".changeRider", function(){
        const order_id = $("#order_id").val();
        const rider_id = $("#rider_id").val();
        const changeRider = $(".changeRider").val();

        Swal.fire({
        title: 'Do you want to set this rider?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('Rider for refund has been set!', '', 'success');

          const data = {
          order_id: order_id,
          rider_id: rider_id,
          changeRider: changeRider
        }

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: data,
          success: function (response) {
            $('#example').DataTable().ajax.reload();
            $("#changeRiderBackdrop").modal("hide");
          }
        });

        }
      })
      })




      

      $(document).on("click", ".getView", function(){
        const getView = $(".getView").val();
        const order_id = $(this).data("id");
        

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: {
            order_id: order_id,
            getView: getView
          },
          dataType: "json",
          success: function (response) {
            $("#cart_id").val(response.cart_id)
          }
        });

      })


    $('#imageUploadForm').on('submit', function(e) {
    e.preventDefault();

    if ($("#new_image").val() == "") return Swal.fire('Proof of Image', 'is required!', 'info');
    if ($("#gcash").val() == "") return Swal.fire('Gcash No.', 'is required!', 'info');
    
    var formData = new FormData(this);

    Swal.fire({
      title: 'This is not ireversable, Do you want to submit this order?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        $.ajax({
          type: 'POST',
          url: '../server/function_refund_last.php',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            $("#ConfirmBackdrop").modal("hide");
            $('#example').DataTable().ajax.reload();
            $("#new_image").val("")
            $("#gcash").val("")
            Swal.fire('This item order has been refunded!', '', 'success');
          }
        });

      }
    })


  });

      // $(document).on("click", ".confirmRefund", function(){
      //   const order_id = $(this).data("id");
      //   const cart_id = $("#cart_id").val();
      //   const confirmRefund = $(".confirmRefund").val();

      //   const data = {
      //     order_id: order_id,
      //     cart_id: cart_id,
      //     confirmRefund: confirmRefund
      //   }

      //   $.ajax({
      //     type: 'POST',
      //     url: '../server/function_refund.php',
      //     data: data,
      //     success: function (response) {
      //       $('#example').DataTable().ajax.reload();
      //       $("#ConfirmBackdrop").modal("hide");
      //     }
      //   });
        
      // })

      

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