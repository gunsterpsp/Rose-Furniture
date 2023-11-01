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
          <option value="0">Select a Category</option>
          <?php
            include '../database/connection.php';
            $sql = mysqli_query($conn, "SELECT * FROM tbl_category WHERE category_status = 1 ");
            while($row = mysqli_fetch_assoc($sql)){
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
          <input type="file" accept=".jpg, .png" class="form-control" name="product_image" id="product_image">
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
        <button type="submit" class="btn btn-primary updateUser">Submit</button>
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
            url: "../server/products_server.php",
            'dataSrc': ""
        },
        "columns": [
        { "data": "product_id"  },
        { "data": "product_code"  },
        { "data": "product_name"  },
        { "data": "product_price"  },
        { "data": "product_quantity"  },
        { "data": "product_category"  },
        { "data": "product_image"  },
        { "data": "action"  },
        { "data": "product_status"  },
        ]
      });

      $('#imageUploadForm').on('submit', function (e) {
            e.preventDefault();

            if($("#product_name").val() == "") return Swal.fire('Product Name','cannot be empty!','info');
            if($("#product_price").val() == "") return Swal.fire('Product Price','cannot be empty!','info');
            if($("#product_quantity").val() == "") return Swal.fire('Product Quantity','cannot be empty!','info');
            if($("#product_description").val() == "") return Swal.fire('Description','cannot be empty!','info');
            if($("#product_category").val() == 0) return Swal.fire('Product Category','cannot be empty!','info');
            if($("#product_image").val() == "") return Swal.fire('Product Image','cannot be empty!','info');


            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '../server/create_product.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                  $('#example').DataTable().ajax.reload();
                  $("#staticBackdrop").modal("hide");
                  $("#product_name").val("");
                  $("#product_price").val("");
                  $("#product_quantity").val("");
                  $("#product_description").val("");
                  $("#product_category").val(0);
                  $("#product_image").val("");
                
                }
            });
      });


      $(document).on("click", ".getProduct", function(){
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
            success: function(response){
              $("#display_category").html(response);

              // console.log(response)
              // $("#edit_product_name").val(response.product_name);
              // $("#edit_product_price").val(response.product_price);
              // $("#edit_product_quantity").val(response.product_quantity);
              // $("#edit_product_description").val(response.product_description);
              // $("#edit_product_category").val(response.product_category);
              // $("#edit_product_image").val(response.product_image);
            }
        });
      })

      $(document).on("click", ".updateUser", function(){
        const firstname = $("#edit_firstname").val();
        const lastname = $("#edit_lastname").val();
        const username = $("#edit_username").val();
        const password = $("#edit_password").val();
        const email = $("#edit_email").val();
        const group = $("#edit_group").val();
        const id = $("#edit_id").val();
        const updateUser = $(".updateUser").val();

        const data = {
          firstname: firstname,
          lastname: lastname,
          username: username,
          password: password,
          email: email,
          group: group,
          id: id,
          updateUser: updateUser
        }

        if(firstname == "") return Swal.fire('First Name','cannot be empty!','info');
        if(lastname == "") return Swal.fire('Last Name','cannot be empty','info');
        if(username == "") return Swal.fire('Username','cannot be empty','info');
        if(password == "") return Swal.fire('Password','cannot be empty','info');
        if(email == "") return Swal.fire('Email','cannot be empty','info');
        if(group == 0) return Swal.fire('Group','cannot be empty','info');
        

        $.ajax({
            url: "../server/function_user.php",
            type: "POST",
            data: data, 
            success: function(data){
              $('#example').DataTable().ajax.reload();
              $("#EditBackdrop").modal("hide")
            }
        });
      })


      $(document).on("click", ".active", function(){
        const active = $(".active").val();
        const getId = $(this).data("id");
      
        $.ajax({
            url: "../server/function_product.php",
            type: "POST",
            data: {
              active: active,
              getId: getId
            }, 
            success: function(data){
              $('#example').DataTable().ajax.reload();
            }
        });
      })


      $(document).on("click", ".lock", function(){
        const lock = $(".lock").val();
        const getId = $(this).data("id");
      
        $.ajax({
            url: "../server/function_product.php",
            type: "POST",
            data: {
              lock: lock,
              getId: getId
            }, 
            success: function(data){
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
      });
   </script>