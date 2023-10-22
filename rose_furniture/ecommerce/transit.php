<?php include '../includes/header_ecommerce.php'; ?>


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

<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel2"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="cart_id2">
        <div class="mb-2">
          <label for="">Select a new rider for transit</label>
        <select name="" id="rider_id2" class="form-select select3" style="width: 100%;">
          <option value="">Please select one here...</option>
          <?php
            include '../database/connection.php';
            $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE group_code = 3 ");
            while($row = mysqli_fetch_assoc($sql)){
              echo '<option value='.$row['user_id'].'>'.$row['first_name'].' '.$row['last_name'].'</option>';
            }
          ?>
        </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary approve2">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="cart_id">
        <div class="mb-2">
          <label for="">Select a rider for transit</label>
        <select name="" id="rider_id" class="form-select select2" style="width: 100%;">
          <option value="">Please select one here...</option>
          <?php
            include '../database/connection.php';
            $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE group_code = 3 ");
            while($row = mysqli_fetch_assoc($sql)){
              echo '<option value='.$row['user_id'].'>'.$row['first_name'].' '.$row['last_name'].'</option>';
            }
          ?>
        </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary approve">Confirm</button>
      </div>
    </div>
  </div>
</div>



<?php include '../includes/footer_ecommerce.php'; ?>



<script>
      $(document).ready(function() {
          $('.select2').select2({
            dropdownParent: $("#staticBackdrop")
          });
          $('.select3').select2({
            dropdownParent: $("#staticBackdrop2")
          });
      });


      $('#example').dataTable({
        scrollX: true,
        processing: true,
        "destroy": true,
        "order": [[0, "desc"]],
        ajax: {
            url: "../server/in_transit_server.php",
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
          url: '../server/function_transit.php',
          data: {
            order_id: order_id,
            view_id: view_id
          },
          dataType: "json",
          success: function (response) {
            $("#cart_id").val(response.cart_id);
          }
        });
      })

      $(document).on("click", ".view_id2", function(){
        const order_id2 = $(this).data("id")
        const view_id2 = $(".view_id2").val();

        $.ajax({
          type: 'POST',
          url: '../server/function_transit.php',
          data: {
            order_id2: order_id2,
            view_id2: view_id2
          },
          dataType: "json",
          success: function (response) {
            $("#cart_id2").val(response.cart_id);
          }
        });
      })

      $(document).on("click", ".approve", function(){
        const cart_id = $("#cart_id").val();
        const rider_id = $("#rider_id").val();
        const approve = $(".approve").val()


        if(rider_id == 0 || rider_id == ""){
          alert("Please select a rider")
        }else {
          $.ajax({
          type: 'POST',
          url: '../server/function_transit.php',
          data: {
            cart_id: cart_id,
            approve: approve,
            rider_id: rider_id
          },
          success: function (response) {
            $('#example').DataTable().ajax.reload();
            $("#rider_id").val("")
            $("#staticBackdrop").modal("hide");
          }
        });
        }



      })

      $(document).on("click", ".approve2", function(){
        const cart_id2 = $("#cart_id2").val();
        const rider_id2 = $("#rider_id2").val();
        const approve2 = $(".approve2").val()




        if(rider_id2 == 0 || rider_id2 == ""){
          alert("Please select a rider")
        }else {
          $.ajax({
          type: 'POST',
          url: '../server/function_transit.php',
          data: {
            cart_id2: cart_id2,
            approve2: approve2,
            rider_id2: rider_id2
          },
          success: function (response) {
            $('#example').DataTable().ajax.reload();
            $("#rider_id2").val("")
            $("#staticBackdrop2").modal("hide");
          }
        });
        }



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