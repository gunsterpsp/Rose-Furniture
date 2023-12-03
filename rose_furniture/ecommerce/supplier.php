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
      <h5 class="card-title">Supplier List </h5>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add new Supplier
      </button>
      <table id="example" class="table table-bordered" width="100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Supplier Address</th>
            <th scope="col">Supplier Contact</th>
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

          <div class="mb-2">
            <label for="">Supplier Name</label>
            <input type="text" class="form-control" id="supp_name">
          </div>
          <div class="mb-2">
            <label for="">Supplier Address</label>
            <input type="text" class="form-control" id="supp_address">
          </div>
          <div class="mb-2">
            <label for="">Supplier Contact</label>
            <input type="text" class="form-control" id="supp_contact">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit">Submit</button>
      </div>
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
      <div class="mb-2">
        <input type="hidden" id="supplier_id">
            <label for="">Supplier Name</label>
            <input type="text" class="form-control" id="supp_name_edit">
          </div>
          <div class="mb-2">
            <label for="">Supplier Address</label>
            <input type="text" class="form-control" id="supp_address_edit">
          </div>
          <div class="mb-2">
            <label for="">Supplier Contact</label>
            <input type="text" class="form-control" id="supp_contact_edit">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary updateSupplier">Update</button>
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
      url: "../server/server_supplier.php",
      'dataSrc': ""
    },
    "columns": [{
        "data": "supplier_id"
      },
      {
        "data": "supplier_name"
      },
      {
        "data": "supplier_address"
      },
      {
        "data": "supplier_contact"
      },
      {
        "data": "action"
      },
      {
        "data": "status"
      }
    ]
  });

  $(document).on("click", ".submit", function() {
    const submit = $(".submit").val();
    const supplier_name = $("#supp_name").val();
    const supplier_address = $("#supp_address").val();
    const supplier_contact = $("#supp_contact").val();
    
    const data = {
      supplier_name: supplier_name,
      supplier_address: supplier_address,
      supplier_contact: supplier_contact,
      submit: submit
    }

    if(supplier_name == "") return Swal.fire('Supplier Name is empty!', '', 'info')
    if(supplier_address == "") return Swal.fire('Supplier Address is empty!', '', 'info')
    if(supplier_contact == "") return Swal.fire('Supplier Contact is empty!', '', 'info')

    $.ajax({
      type: 'POST',
      url: '../server/function_supplier.php',
      data: data,
      success: function(response) {
        $('#example').DataTable().ajax.reload();
        Swal.fire('New Supplier has been added!', '', 'success')
        $("#supp_name").val("");
        $("#supp_address").val("");
        $("#supp_contact").val("");
        $("#staticBackdrop").modal("hide");
      }
    });

  })



  $(document).on("click", ".getSupplier", function() {
    const getId = $(this).data("id");
    const getSupplier = $(".getSupplier").val();
    const data = {
      getId: getId,
      getSupplier: getSupplier
    }

    $.ajax({
      url: "../server/function_supplier.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function(response) {

        $("#supplier_id").val(response.supplier_id);
        $("#supp_name_edit").val(response.supplier_name);
        $("#supp_address_edit").val(response.supplier_address);
        $("#supp_contact_edit").val(response.supplier_contact);
      }
    });
  })

  $(document).on("click", ".updateSupplier", function() {
    const supplier_id = $("#supplier_id").val();
    const supplier_name = $("#supp_name_edit").val();
    const supplier_address = $("#supp_address_edit").val();
    const supplier_contact = $("#supp_contact_edit").val();
    const updateSupplier = $(".updateSupplier").val();

    const data = {
      supplier_id: supplier_id,
      supplier_name: supplier_name,
      supplier_address: supplier_address,
      supplier_contact: supplier_contact,
      updateSupplier: updateSupplier
    }

    if(supplier_name == "") return Swal.fire('Supplier Name is empty!', '', 'info')
    if(supplier_address == "") return Swal.fire('Supplier Address is empty!', '', 'info')
    if(supplier_contact == "") return Swal.fire('Supplier Contact is empty!', '', 'info')

    Swal.fire({
      title: 'Do you want to update this supplier ' + supplier_name + '?',
      showDenyButton: true,
      confirmButtonText: 'Yes',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        Swal.fire('Supplier has been updated!', '', 'success')

        $.ajax({
          url: "../server/function_supplier.php",
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
      url: "../server/function_supplier.php",
      type: "POST",
      data: {
        active: active,
        getId: getId
      },
      success: function(data) {
        $('#example').DataTable().ajax.reload();
        Swal.fire('Supplier has been lock!', '', 'success')
      }
    });
  })


  $(document).on("click", ".lock", function() {
    const lock = $(".lock").val();
    const getId = $(this).data("id");

    $.ajax({
      url: "../server/function_supplier.php",
      type: "POST",
      data: {
        lock: lock,
        getId: getId
      },
      success: function(data) {
        $('#example').DataTable().ajax.reload();
        Swal.fire('Supplier has been active!', '', 'success')
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
  });
</script>