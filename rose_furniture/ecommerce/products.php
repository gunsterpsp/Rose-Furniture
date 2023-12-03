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
      <h5 class="card-title">Products List </h5>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add Product
      </button>
      <table id="example" class="table table-bordered" width="100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product Code</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Product Category</th>
            <th scope="col">Image</th>
            <th scope="col">Supplier Name</th>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="imageUploadForm" action="#" method="post" enctype="multipart/form-data">
          <div class="mb-2">
            <label for="">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="product_name">
          </div>
          <div class="mb-2">
            <label for="">Product Price</label>
            <input type="text" class="form-control" name="product_price" id="product_price">
          </div>
          <div class="mb-2">
            <label for="">Product Quantity</label>
            <input type="text" class="form-control" name="product_quantity" id="product_quantity">
          </div>
          <div class="mb-2">
            <label for="">Description</label>
            <textarea name="product_description" id="product_description" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-2">
            <label for="">Product Category</label>
            <select class="form-select select2" name="product_category" id="product_category" style="width: 100%;">
              <option value="">Select a Category</option>
              <?php
              include '../database/connection.php';
              $sql = mysqli_query($conn, "SELECT * FROM tbl_category WHERE category_status = 1 ");
              while ($row = mysqli_fetch_assoc($sql)) {
              ?>
                <option value="<?= $row['category_name'] ?>"><?= $row['category_name'] ?></option>
              <?php
              }
              ?>
            </select>
            <!-- <input type="text" class="form-control" name="product_category" id="product_category"> -->
          </div>
          <div class="mb-2">
            <label for="">Product Image</label>
            <input type="file" accept=".jpg, .png, .jpeg" class="form-control" name="product_image" id="product_image">
          </div>
          <div class="mb-2">
            <label for="">Supplier</label>
            <select class="form-select select4" name="supplier_id" id="supplier_id" style="width: 100%;">
              <option value="">Select a supplier</option>
              <?php
              include '../database/connection.php';
              $sql = mysqli_query($conn, "SELECT * FROM tbl_supplier WHERE supplier_status = 1 ");
              while ($row = mysqli_fetch_assoc($sql)) {
              ?>
                <option value="<?= $row['supplier_id'] ?>"><?= $row['supplier_name'] ?></option>
              <?php
              }
              ?>
            </select>
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
<div class="modal fade" id="EditBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="display_category"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary updateProduct">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="EditImageBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditImageBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="imageEditForm" action="#" method="post" enctype="multipart/form-data">
          <div id="disp_image" class="mb-2"></div>
          <div class="mb-2">
            <input type="file" accept=".jpg, .png, .jpeg" class="form-control" name="edit_product_image" id="edit_product_image">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="update">Update</button>
      </div>
      </form>
    </div>
    <!-- <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div> -->
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
      url: "../server/products_server.php",
      'dataSrc': ""
    },
    "columns": [{
        "data": "product_id"
      },
      {
        "data": "product_code"
      },
      {
        "data": "product_name"
      },
      {
        "data": "product_price"
      },
      {
        "data": "product_quantity"
      },
      {
        "data": "product_category"
      },
      {
        "data": "product_image"
      },
      {
        "data": "supplier_name"
      },
      {
        "data": "action"
      },
      {
        "data": "product_status"
      },
    ]
  });

  $(document).on("click", ".viewImage", function() {
    const viewImage = $(".viewImage").val();
    const data_id = $(this).data("id");

    $.ajax({
      type: 'POST',
      url: '../server/function_product.php',
      data: {
        viewImage: viewImage,
        data_id: data_id
      },
      dataType: "json",
      success: function(response) {
        $("#disp_image").html("<input type='hidden' name='edit_id' value='" + response.product_id + "'>\
        <img src='../ecommerce/uploads/" + response.product_image + "' style='width: 100%; height: 200px;'>");
      }
    });

  })

  $('#imageUploadForm').on('submit', function(e) {
    e.preventDefault();

    if ($("#product_name").val() == "") return Swal.fire('Product Name', 'cannot be empty!', 'info');
    if ($("#product_price").val() == "") return Swal.fire('Product Price', 'cannot be empty!', 'info');
    if ($("#product_quantity").val() == "") return Swal.fire('Product Quantity', 'cannot be empty!', 'info');
    if ($("#product_description").val() == "") return Swal.fire('Description', 'cannot be empty!', 'info');
    if ($("#product_category").val() == "") return Swal.fire('Product Category', 'cannot be empty!', 'info');
    if ($("#product_image").val() == "") return Swal.fire('Product Image', 'cannot be empty!', 'info');
    if ($("#supplier_id").val() == "") return Swal.fire('Supplier', 'cannot be empty!', 'info');

    const prd = $("#product_name").val();

    var formData = new FormData(this);

    Swal.fire({
      title: 'Do you want to add this item ' + prd + '?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Product has been added!', '', 'success')

        $.ajax({
          type: 'POST',
          url: '../server/create_product.php',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            $('#example').DataTable().ajax.reload();
            $("#staticBackdrop").modal("hide");
            $("#product_name").val("");
            $("#product_price").val("");
            $("#product_quantity").val("");
            $("#product_description").val("");
            $("#product_category").val("");
            $("#product_image").val("");
          }
        });

      }
    })

  });


  $('#imageEditForm').on('submit', function(e) {
    e.preventDefault();

    if ($("#edit_product_image").val() == "") return Swal.fire('Please select a file!', '', 'info');

    var formData = new FormData(this);


    Swal.fire({
      title: 'Do you want to update this image?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Product Image been updated!', '', 'success')

        $.ajax({
          type: 'POST',
          url: '../server/create_product.php',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            $.ajax({
              type: 'POST',
              url: '../server/update_product.php',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response) {
                $('#example').DataTable().ajax.reload();
                $("#EditImageBackdrop").modal("hide");
                $("#edit_product_image").val("");
              }
            });
          }
        });

      }
    })


  });


  $(document).on("click", ".getProduct", function() {
    const getId = $(this).data("id");
    const getProduct = $(".getProduct").val();

    const data = {
      getId: getId,
      getProduct: getProduct
    }

    $.ajax({
      url: "../server/function_product.php",
      type: "POST",
      data: data,
      // dataType: "json",
      success: function(response) {
        $("#display_category").html(response);
      }
    });
  })

  $(document).on("click", ".updateProduct", function() {
    const edit_id = $("#edit_id").val();
    const edit_product_name = $("#edit_product_name").val();
    const edit_product_price = $("#edit_product_price").val();
    const edit_product_quantity = $("#edit_product_quantity").val();
    const edit_product_description = $("#edit_product_description").val();
    const edit_product_category = $("#edit_product_category").val();
    const edit_supplier = $("#edit_supplier").val();
    const updateProduct = $(".updateProduct").val();

    const data = {
      edit_id: edit_id,
      edit_product_name: edit_product_name,
      edit_product_price: edit_product_price,
      edit_product_quantity: edit_product_quantity,
      edit_product_description: edit_product_description,
      edit_product_category: edit_product_category,
      edit_supplier: edit_supplier,
      updateProduct: updateProduct
    }

    if (edit_product_name == "") return Swal.fire('Product Name', 'cannot be empty!', 'info');
    if (edit_product_price == "") return Swal.fire('Product Price', 'cannot be empty', 'info');
    if (edit_product_quantity == "") return Swal.fire('Product Qty', 'cannot be empty', 'info');
    if (edit_product_description == "") return Swal.fire('Product Description', 'cannot be empty', 'info');
    if (edit_product_category == "") return Swal.fire('Product Category', 'cannot be empty', 'info');
    if (edit_supplier == "") return Swal.fire('Supplier', 'cannot be empty', 'info');


    Swal.fire({
      title: 'Do you want to update this item ' + edit_product_name + '?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Product has been updated!', '', 'success')

        $.ajax({
          url: "../server/function_product.php",
          type: "POST",
          data: data,
          success: function(data) {
            $('#example').DataTable().ajax.reload();
            $("#EditBackdrop").modal("hide")
          }
        });
      }
    })


  })


  $(document).on("click", ".active", function() {
    const active = $(".active").val();
    const getId = $(this).data("id");

    $.ajax({
      url: "../server/function_product.php",
      type: "POST",
      data: {
        active: active,
        getId: getId
      },
      success: function(data) {
        $('#example').DataTable().ajax.reload();
      }
    });
  })


  $(document).on("click", ".lock", function() {
    const lock = $(".lock").val();
    const getId = $(this).data("id");

    $.ajax({
      url: "../server/function_product.php",
      type: "POST",
      data: {
        lock: lock,
        getId: getId
      },
      success: function(data) {
        $('#example').DataTable().ajax.reload();
      }
    });
  })


  const priceInput = document.getElementById("product_price");

  // Add an input event listener to validate the input
  priceInput.addEventListener("input", function() {
    const valuePrice = this.value;
    const priceValue = parseFloat(valuePrice);

    if (isNaN(priceValue)) {
      // Clear the input field if the input is not a valid number
      this.value = "";
      alert("Please enter a valid price number!");
    }
  });

  const quantityInput = document.getElementById("product_quantity");

  // Add an input event listener to validate the input
  quantityInput.addEventListener("input", function() {
    const valueQuantity = this.value;
    const quantityValue = parseFloat(valueQuantity);

    if (isNaN(quantityValue)) {
      // Clear the input field if the input is not a valid number
      this.value = "";
      alert("Please enter a valid quantity number!");
    }
  });

  $(document).ready(function() {
    $('.select2').select2({
      dropdownParent: $("#staticBackdrop")
    });
    $('.select3').select2({
      dropdownParent: $("#EditBackdrop")
    });
    $('.select4').select2({
      dropdownParent: $("#staticBackdrop")
    });
  });
</script>