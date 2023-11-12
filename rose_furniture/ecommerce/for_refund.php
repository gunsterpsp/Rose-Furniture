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
            <label for="">Proof of refund (Image)</label>
            <input type="file" accept=".jpg, .png" class="form-control" name="proof_image" id="proof_image">
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
<div class="modal fade" id="courierBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="display_facility"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary courierBtn">Submit</button>
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
      url: "../server/for_refund_server.php",
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


  $(document).on("click", ".view_refund", function() {
    const order_id = $(this).data("id")
    const view_refund = $(".view_refund").val()

    $.ajax({
      type: 'POST',
      url: '../server/function_refund.php',
      data: {
        order_id: order_id,
        view_refund: view_refund
      },
      dataType: "json",
      success: function(response) {
        $("#cart_id").val(response.cart_id);
      }
    });

  })


  $('#imageUploadForm').on('submit', function(e) {
    e.preventDefault();

    if ($("#proof_image").val() == "") return Swal.fire('Proof of Image', 'is required!', 'info');

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
          url: '../server/function_rider_proof.php',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            $("#staticBackdrop").modal("hide");
            $('#example').DataTable().ajax.reload();
            Swal.fire('Refund order has get!', '', 'success');
            $("#proof_image").val("");
          }
        });

      }
    })


  });


  $(document).on("click", ".courierBtn", function() {
    const courier_id = $("#courier_id").val()
    const courierBtn = $(".courierBtn").val()
    const order_id = $("#order_id").val()
    const location_id = $("#location_id").val();

    Swal.fire({
      title: 'This is not ireversable, Do you want to submit this order?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        $.ajax({
          type: 'POST',
          url: '../server/function_refund.php',
          data: {
            courier_id: courier_id,
            courierBtn: courierBtn,
            order_id: order_id,
            location_id: location_id
          },
          success: function(response) {
            $('#example').DataTable().ajax.reload();
            $("#courierBackdrop").modal("hide");
            $("#location_id").val("");
            $("#courier_id").val("");
          }
        });

      }
    })



  })


  $(document).on("click", ".select_facility", function() {
    const order_id = $(this).data("id")
    const select_facility = $(".select_facility").val()

    $.ajax({
      type: 'POST',
      url: '../server/function_refund.php',
      data: {
        order_id: order_id,
        select_facility: select_facility
      },
      success: function(response) {
        $("#display_facility").html(response)
      }
    });

  })
</script>