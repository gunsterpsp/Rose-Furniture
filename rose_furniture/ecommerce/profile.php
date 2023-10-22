
<?php include '../includes/header_ecommerce.php'; ?>
<?php 

global $conn;
$user_id = $_GET["user_id"];
$sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$user_id' ");
$row = mysqli_fetch_assoc($sql);

?>

    <div class="pagetitle">
      <h1>My Profile</h1>
      <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">My Profile</li>
        </ol>
      </nav> -->
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-6">
          <div class="row">



            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Basic <span>| Information</span></h5>
                  <div>
                    <label for="">First Name</label>
                    <input type="text" class="form-control" id="first_name" value="<?= $row['first_name'] ?>">
                  </div>
                  <div>
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" id="last_name" value="<?= $row['last_name'] ?>">
                  </div>
                  <div>
                    <label for="">Address</label>
                    <input type="text" class="form-control" id="address" value="<?= $row['address'] ?>">
                  </div>
                  <div>
                    <label for="">Contact No</label>
                    <input type="text" class="form-control" id="contact_no" value="<?= $row['contact_no'] ?>">
                  </div>
                  <div class="mb-2">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" value="<?= $row['email'] ?>">
                  </div>
                  <div>
                    <button type="button" class="btn btn-primary w-100 updateInfo">Update</button>
                  </div>
                </div>

              </div>
            </div><!-- End Recent Sales -->


          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- Recent Activity -->
          <div class="card">


            <div class="card-body">
              <h5 class="card-title">Change <span>| Password</span></h5>

              <div class="activity">

              <div>
                    <label for="">Password</label>
                    <input type="password" disabled class="form-control" value="<?= $row['password'] ?>">
                  </div>
                  <div>
                    <label for="">New Password</label>
                    <input type="password" class="form-control" value="" id="new_password">
                  </div>
                  <div class="mb-2">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" value=""  id="confirm_password">
                  </div>
                  <div>
                    <button type="button" class="btn btn-primary w-100 updatePassword">Update</button>
                  </div>
              </div>

            </div>
          </div><!-- End Recent Activity -->




        </div><!-- End Right side columns -->

      </div>
    </section>


  <?php include '../includes/footer_ecommerce.php'; ?>

  <script>
      $(document).on("click", ".updatePassword", function(){
        const new_password = $("#new_password").val();
        const confirm_password = $("#confirm_password").val();
        const user_id = '<?php echo $_GET["user_id"] ?>';
        const updatePassword = $(".updatePassword").val();

        if(new_password != confirm_password){
          return Swal.fire('New Password & Confirm Passwod','not match!','info');
        }else if(new_password == "" || confirm_password == ""){
          return Swal.fire('New Password & Confirm Passwod','cannot be empty!','info');
        }else {
            const data = {
              new_password: new_password,
              user_id: user_id,
              updatePassword: updatePassword
            }
            $.ajax({
                url: "../server/function_user.php",
                type: "POST",
                data: data, 
                success: function(data){
                  $("#new_password").val("");
                  $("#confirm_password").val("");
                  return Swal.fire('Password','has been changed','success');
                }
            });
        }
      });



      $(document).on("click", ".updateInfo", function(){
        const first_name = $("#first_name").val();
        const last_name = $("#last_name").val();
        const address = $("#address").val();
        const contact_no = $("#contact_no").val();
        const email = $("#email").val();
        const user_id = '<?php echo $_GET["user_id"] ?>';
        const updateInfo = $(".updateInfo").val();

        if(first_name == "") return Swal.fire('First Name','cannot be empty!','info');
        if(last_name == "") return Swal.fire('Last Name','cannot be empty','info');
        if(address == "") return Swal.fire('Address','cannot be empty!','info');
        if(contact_no == "") return Swal.fire('Contact No','cannot be empty','info');
        if(email == "") return Swal.fire('Email','cannot be empty','info');

        const data = {
          first_name: first_name,
          last_name: last_name,
          address: address,
          contact_no: contact_no,
          email: email,
          user_id: user_id,
          updateInfo: updateInfo
        }
        
        $.ajax({
            url: "../server/function_user.php",
            type: "POST",
            data: data, 
            success: function(data){
              return Swal.fire('Information','has been changed','success');
            }
        });

      })



  </script>