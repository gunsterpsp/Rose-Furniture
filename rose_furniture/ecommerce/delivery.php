<?php include '../includes/header_ecommerce.php';
if (!isset($_SESSION['user_id'])) {
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


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="imageUploadForm" action="#" method="post" enctype="multipart/form-data">
          <div>
            <input type="hidden" name="cart_id" id="cart_id">
          </div>
          <div class="mb-2">
            <label for="">Proof of delivery (Image)</label>
            <input type="file" accept=".jpg, .png" class="form-control" name="proof_image" id="proof_image">
          </div>
          <div class="mb-2">
            <input type="hidden" id="validation_amount">
            <label for="">Amount to pay by the customer : ₱<label for="" id="amount_pay"></label></label>
            <input type="text" class="form-control" name="amount" id="amount">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
      </form>
    </div>
  </div>
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
      url: "../server/order_delivery_server.php",
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
        "data": "tracking_no"
      },
      {
        "data": "action"
      },
    ]
  });


  $(document).on("click", ".view_id", function() {
    const order_id = $(this).data("id")
    const view_id = $(".view_id").val()

    $.ajax({
      type: 'POST',
      url: '../server/function_delivery.php',
      data: {
        order_id: order_id,
        view_id: view_id
      },
      dataType: "json",
      success: function(response) {
        $("#cart_id").val(response.cart_id);
        const amount_pay = response.price * response.quantity;
        $("#amount_pay").html(amount_pay)
        $("#validation_amount").val(amount_pay)
      }
    });

  })


  $('#imageUploadForm').on('submit', function(e) {
    e.preventDefault();
    const validation_amount = $("#validation_amount").val();
    const amount = $("#amount").val();


    if ($("#proof_image").val() == "") return Swal.fire('Proof of Image', 'is required!', 'info');
    if ($("#amount").val() == "") return Swal.fire('Amount pay is', 'is required!', 'info');

    var formData = new FormData(this);

    if ($("#amount").val() != $("#validation_amount").val()) return Swal.fire('Amount to pay by customer is : ₱' + validation_amount, ' Your input is : ₱' + amount + ' seems does not match!', 'info');

    Swal.fire({
      title: 'This is not ireversable, Do you want to submit this order?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        $.ajax({
          type: 'POST',
          url: '../server/function_proof.php',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            $("#staticBackdrop").modal("hide");
            $('#example').DataTable().ajax.reload();
            Swal.fire('Order has been delivered!', '', 'success');
            $("#amount").val("")
          }
        });

      }
    })


  });


  $(document).on("click", ".cancel", function() {
    const order_id = $(this).data("id")
    const cancel = $(".cancel").val()

    $.ajax({
      type: 'POST',
      url: '../server/function_delivery.php',
      data: {
        order_id: order_id,
        approve: approve
      },
      success: function(response) {
        $('#example').DataTable().ajax.reload();
      }
    });

  })


  $(document).on("click", ".view_proof", function() {
    const order_id = $(this).data("id")
    const view_proof = $(".view_proof").val()

    $.ajax({
      type: 'POST',
      url: '../server/function_delivery.php',
      data: {
        order_id: order_id,
        view_proof: view_proof
      },
      dataType: "json",
      success: function(response) {
        $("#display_proof").html(
          '<div class="mb-2"><label>Proof of delivery (Image)</label><img src="../ecommerce/uploads/' + response.proof_image + '" \
              alt="" width="100%" height="250px"></div>\
              <div><label>Amount paid by the customer : ₱</label>' + response.order_remarks + '</div>'
        )
      }
    });

  })
</script>