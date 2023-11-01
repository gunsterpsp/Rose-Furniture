<?php include '../includes/header_ecommerce.php'; 
if(!isset($_SESSION['user_id'])){
  header('Location: ../main/home');
  exit;
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
                      </tr>
                    </thead>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->






<?php include '../includes/footer_ecommerce.php'; ?>

<script>
      $('#example').dataTable({
        scrollX: true,
        processing: true,
        "destroy": true,
        "order": [[0, "desc"]],
        ajax: {
            url: "../server/order_receiving_server.php",
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
        ]
      });


      $(document).on("click", ".approve", function(){
        const order_id = $(this).data("id")
        const code = $(this).data("code") 
        const approve = $(".approve").val()

        Swal.fire({
        title: 'Do you want to confirm this order?'+ ' '+code,
        showDenyButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('Order '+code+' has been confirm', '', 'success');
          $.ajax({
          type: 'POST',
          url: '../server/function_receiving.php',
          data: {
            order_id: order_id,
            approve: approve
          },
          success: function (response) {
            $('#example').DataTable().ajax.reload();
          }
        });

        }
      })



      })


      $(document).on("click", ".cancel", function(){
        const order_id = $(this).data("id")
        const cancel = $(".cancel").val()

        $.ajax({
          type: 'POST',
          url: '../server/function_receiving.php',
          data: {
            order_id: order_id,
            approve: approve
          },
          success: function (response) {
            $('#example').DataTable().ajax.reload();
          }
        });
        
      })







   </script>