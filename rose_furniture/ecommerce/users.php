<?php include '../includes/header_ecommerce.php'; ?>


            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Users List </h5>

         <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add User
        </button>
                  <table id="example" class="table table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">Group</th>
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
          <label for="">First Name</label>
          <input type="text" class="form-control" id="firstname">
        </div>
        <div class="mb-2">
          <label for="">Last Name</label>
          <input type="text" class="form-control" id="lastname">
        </div>
        <div class="mb-2">
          <label for="">Address</label>
          <input type="text" class="form-control" id="address">
        </div>
        <div class="mb-2">
          <label for="">Contact No.</label>
          <input type="text" class="form-control" id="contact_no">
        </div>
        <div class="mb-2">
          <label for="">Username</label>
          <input type="text" class="form-control" id="username">
        </div>
        <div class="mb-2">
          <label for="">Password</label>
          <input type="text" class="form-control" id="password">
        </div>
        <div class="mb-2">
          <label for="">Email</label>
          <input type="text" class="form-control" id="email">
        </div>
        <div class="mb-2">
          <label for="">Group</label>
          <select name="" class="form-select" id="group">
            <option value="0">Select Group</option>
            <option value="1">Admin</option>
            <option value="2">User</option>
            <option value="3">Rider</option>
          </select>
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
      <input type="hidden" class="form-control" id="edit_id">
        <div class="mb-2">
          <label for="">First Name</label>
          <input type="text" class="form-control" id="edit_firstname">
        </div>
        <div class="mb-2">
          <label for="">Last Name</label>
          <input type="text" class="form-control" id="edit_lastname">
        </div>
        <div class="mb-2">
          <label for="">Address</label>
          <input type="text" class="form-control" id="edit_address">
        </div>
        <div class="mb-2">
          <label for="">Contact No.</label>
          <input type="text" class="form-control" id="edit_contact_no">
        </div>
        <div class="mb-2">
          <label for="">Username</label>
          <input type="text" class="form-control" id="edit_username">
        </div>
        <div class="mb-2">
          <label for="">Password</label>
          <input type="text" class="form-control" id="edit_password">
        </div>
        <div class="mb-2">
          <label for="">Email</label>
          <input type="text" class="form-control" id="edit_email">
        </div>
        <div class="mb-2">
          <label for="">Group</label>
          <select name="" class="form-select" id="edit_group">
            <option value="0">Select Group</option>
            <option value="1">Admin</option>
            <option value="2">User</option>
            <option value="3">Rider</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary updateUser">Submit</button>
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
            url: "../server/users_server.php",
            'dataSrc': ""
        },
        "columns": [
        { "data": "id"  },
        { "data": "first_name"  },
        { "data": "last_name"  },
        { "data": "address"  },
        { "data": "contact_no"  },
        { "data": "username"  },
        { "data": "password"  },
        { "data": "email"  },
        { "data": "group"  },
        { "data": "action"  },
        { "data": "status"  },
            ]

      });

      $(document).on("click", ".submit", function(){
        const firstname = $("#firstname").val();
        const lastname = $("#lastname").val();
        const address = $("#address").val();
        const contact_no = $("#contact_no").val();
        const username = $("#username").val();
        const password = $("#password").val();
        const email = $("#email").val();
        const group = $("#group").val();
        const submit = $(".submit").val();

        const data = {
          firstname: firstname,
          lastname: lastname,
          address: address,
          contact_no: contact_no,
          username: username,
          password: password,
          email: email,
          group: group,
          submit: submit
        }

        if(firstname == "") return Swal.fire('First Name','cannot be empty!','info');
        if(lastname == "") return Swal.fire('Last Name','cannot be empty','info');
        if(address == "") return Swal.fire('Address','cannot be empty!','info');
        if(contact_no == "") return Swal.fire('Contact No','cannot be empty','info');
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
              $("#staticBackdrop").modal("hide")
              $("#firstname").val("");
              $("#lastname").val("");
              $("#username").val("");
              $("#password").val("");
              $("#email").val("");
              $("#group").val(0);
            }
        });
      })


      $(document).on("click", ".getUser", function(){
        const getId = $(this).data("id");
        const getUser = $(".getUser").val();

        const data = { 
          getId: getId,
          getUser: getUser
        }

        $.ajax({
            url: "../server/function_user.php",
            type: "POST",
            data: data, 
            dataType: "json",
            success: function(data){
              $("#edit_id").val(data.user_id);
              $("#edit_firstname").val(data.first_name);
              $("#edit_lastname").val(data.last_name);
              $("#edit_address").val(data.address);
              $("#edit_contact_no").val(data.contact_no);
              $("#edit_username").val(data.username);
              $("#edit_password").val(data.password);
              $("#edit_email").val(data.email);
              $("#edit_group").val(data.group_code);

            }
        });
      })

      $(document).on("click", ".updateUser", function(){
        const firstname = $("#edit_firstname").val();
        const lastname = $("#edit_lastname").val();
        const address = $("#edit_address").val();
        const contact_no = $("#edit_contact_no").val();
        const username = $("#edit_username").val();
        const password = $("#edit_password").val();
        const email = $("#edit_email").val();
        const group = $("#edit_group").val();
        const id = $("#edit_id").val();
        const updateUser = $(".updateUser").val();

        const data = {
          firstname: firstname,
          lastname: lastname,
          address: address,
          contact_no: contact_no,
          username: username,
          password: password,
          email: email,
          group: group,
          id: id,
          updateUser: updateUser
        }

        if(firstname == "") return Swal.fire('First Name','cannot be empty!','info');
        if(lastname == "") return Swal.fire('Last Name','cannot be empty','info');
        if(address == "") return Swal.fire('Address','cannot be empty!','info');
        if(contact_no == "") return Swal.fire('Contact No','cannot be empty','info');
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
            url: "../server/function_user.php",
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
            url: "../server/function_user.php",
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


   </script>