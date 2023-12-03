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
            <th scope="col">Action</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
      </table>

    </div>

  </div>
</div><!-- End Recent Sales -->




<!-- Modal -->
<div class="modal fade" id="shippingBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel1"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="display_logistic"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary approve">Confirm</button>
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
        <div id="display_data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary approve_ship">Confirm</button>
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
    "order": [
      [0, "desc"]
    ],
    ajax: {
      url: "../server/order_ship_server.php",
      'dataSrc': ""
    },
    "columns": [{
        "data": "order_id"
      },
      {
        "data": "product_code"
      },
      {
        "data": "product_name"
      },
      {
        "data": "quantity"
      },
      {
        "data": "price"
      },
      {
        "data": "total_amount"
      },
      {
        "data": "payment_method"
      },
      {
        "data": "action"
      },
      {
        "data": "status"
      },
    ]
  });

  $(document).on("click", ".view_logistic", function() {
    const order_id = $(this).data("id")
    const view_logistic = $(".view_logistic").val();

    $.ajax({
      type: 'POST',
      url: '../server/function_ship.php',
      data: {
        order_id: order_id,
        view_logistic: view_logistic
      },
      success: function(response) {
        $("#display_logistic").html(response);
      }
    });
  })

  $(document).on("change", "#last_departure", function(){
      const valme = $("#last_departure").val();

      if(valme == 0){
        $("#logistics_data").hide();
      }else {
        $.ajax({
            type: 'POST',
            url: '../server/function_ship.php',
            data: {
              valme: valme
            },
            success: function(response) {
              $("#logistics_data").show()
              $("#logistics_data").html(response)
            }
      });
      }


            
  })


  $(document).on("click", ".approve", function() {
    const order_id = $("#order_id").val()
    const logistic_name = $("#logistic_name").val()
    const approve = $(".approve").val()

    if (logistic_name == 0) {
      alert("Please select on logistic name in the list");
    } else {

      Swal.fire({
        title: 'Do you want to prepare to ship this order?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire('Order has been prepared!', '', 'success');

          $.ajax({
            type: 'POST',
            url: '../server/function_ship.php',
            data: {
              order_id: order_id,
              approve: approve,
              logistic_name: logistic_name
            },
            success: function(response) {
              $('#example').DataTable().ajax.reload();
              $("#shippingBackdrop").modal("hide");
              $("#logistic_name").val("");

            }
          });

        }
      })
    }



  })


  $(document).on("click", ".view_id", function() {
    const order_id = $(this).data("id")
    const view_id = $(".view_id").val();

    $.ajax({
      type: 'POST',
      url: '../server/function_ship.php',
      data: {
        order_id: order_id,
        view_id: view_id
      },
      success: function(response) {
        $("#display_data").html(response);
      }
    });
  })



  $(document).on("click", ".approve_ship", function() {
    const cart_id = $("#cart_id").val();
    const action_id = $("#action_id").val();
    const location_id = $("#location_id").val();
    const approve_ship = $(".approve_ship").val()
    const last_departure = $("#last_departure").val()
    const user_id = $("#user_id").val()

    if(action_id == 0) return alert("Please select an action")
    if(location_id == "") return alert("Please set a location");

    Swal.fire({
      title: 'This is not ireversable, Do you want to confirm this order?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        if(action_id == "Arrived"){
          Swal.fire('Order has been arrived!', '', 'success');
        }else {
          Swal.fire('Order has been departed!', '', 'success');
        }


        $.ajax({
          type: 'POST',
          url: '../server/function_ship.php',
          data: {
            cart_id: cart_id,
            approve_ship: approve_ship,
            action_id: action_id,
            location_id: location_id,
            last_departure: last_departure,
            user_id: user_id
          },
          success: function(response) {
            $('#example').DataTable().ajax.reload();
            $("#staticBackdrop").modal("hide");
            $("#location_id").val("");
          }
        });
      }
    })
  })


</script>