
<?php include '../includes/header_ecommerce.php'; ?>
<style>
.rating {
  font-size: 17px;
}

.star {
  cursor: pointer;
  color: gray;
  transition: color 0.2s;
}

.star:hover {
  color: gold;
}

.star-2 {
  color: gray;
}

.star-3 {
  color: gold;
}
</style>
<?php
@require_once '../database/connection.php';
if(!isset($_SESSION['user_id'])){
  header('Location: ../main/home');
  exit;
}

$product_code = $_GET['code'];
$id = $_GET['id'];
$query = $conn->query("SELECT * FROM `tbl_products` WHERE `product_code` = '$product_code' AND  product_id = '$id' ");
$row = $query->fetch_assoc();

?>


    <div class="pagetitle">
      <h1></h1>

    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-6">
          <div class="row">
              <div class="card info-card customers-card">
                <div class="p-4 text-center">
                <img src="../ecommerce/uploads/<?= $row['product_image'] ?>" width="90%" height="350px" alt="">
                </div>
                



  <div class="text-center">
    <input type="text" class="" id="comment_text" placeholder="Write a comment" style="width: 80%;">
    <button type="button" class="btn-primary submit" id="submit"><i class='bx bxl-telegram'></i></button>
            <div class="rating">
          <span class="star" data-rating="1">&#9733;</span>
          <span class="star" data-rating="2">&#9733;</span>
          <span class="star" data-rating="3">&#9733;</span>
          <span class="star" data-rating="4">&#9733;</span>
          <span class="star" data-rating="5">&#9733;</span>
        </div>
        <div id="rating-value"></div>

  </div>
  <div>
    <div class="mb-3"></div>
  <?php 
    $sqlComment = mysqli_query($conn, "SELECT * FROM tbl_product_comments WHERE product_id = '".$_GET['id']."' ORDER BY comment_id ASC ");
    while($rowComments = mysqli_fetch_assoc($sqlComment)){
      $sqlName = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '".$rowComments['user_id']."' ");
      $rowFullName = mysqli_fetch_assoc($sqlName);

      $full_name = $rowFullName['first_name'] . ' ' . $rowFullName['last_name']; 

      $comment_id = $rowComments['comment_id'];

      ?>
      <div class="mb-2">
        <div>
        <b><?= $full_name ?></b> 
        <label class="rating-2">
          <?php
            if($rowComments['stars'] == 1){
              echo '<span class="star-3" data-rating="1">&#9733;</span>';
              echo '<span class="star-2" data-rating="2">&#9733;</span>';
              echo '<span class="star-2" data-rating="3">&#9733;</span>';
              echo '<span class="star-2" data-rating="4">&#9733;</span>';
              echo '<span class="star-2" data-rating="5">&#9733;</span>';
            }else if($rowComments['stars'] == 2){
              echo '<span class="star-3" data-rating="1">&#9733;</span>';
              echo '<span class="star-3" data-rating="2">&#9733;</span>';
              echo '<span class="star-2" data-rating="3">&#9733;</span>';
              echo '<span class="star-2" data-rating="4">&#9733;</span>';
              echo '<span class="star-2" data-rating="5">&#9733;</span>';
            }else if($rowComments['stars'] == 3){
              echo '<span class="star-3" data-rating="1">&#9733;</span>';
              echo '<span class="star-3" data-rating="2">&#9733;</span>';
              echo '<span class="star-3" data-rating="3">&#9733;</span>';
              echo '<span class="star-2" data-rating="4">&#9733;</span>';
              echo '<span class="star-2" data-rating="5">&#9733;</span>';
            }else if($rowComments['stars'] == 4){
              echo '<span class="star-3" data-rating="1">&#9733;</span>';
              echo '<span class="star-3" data-rating="2">&#9733;</span>';
              echo '<span class="star-3" data-rating="3">&#9733;</span>';
              echo '<span class="star-3" data-rating="4">&#9733;</span>';
              echo '<span class="star-2" data-rating="5">&#9733;</span>';
            }else {
              echo '<span class="star-3" data-rating="1">&#9733;</span>';
              echo '<span class="star-3" data-rating="2">&#9733;</span>';
              echo '<span class="star-3" data-rating="3">&#9733;</span>';
              echo '<span class="star-3" data-rating="4">&#9733;</span>';
              echo '<span class="star-3" data-rating="5">&#9733;</span>';
            }
          ?>
        </label>
        </div>
        <div style="margin-left: 10px;"><?= $rowComments['comment_text'] ?>
        - <label style="font-size: 11px;"><?php 
          $dateString = $rowComments['date']; // Replace this with your date string
          $dateTime = new DateTime($rowComments['date']);
          $formattedDate = $dateTime->format('F j, Y g:i A');
          echo $formattedDate; ?>
        </label>
        </div>
        <div>
        <a href="#" style="font-size: 12px;">Like</a>
            <?php
              if($rowComments['user_id'] == $_SESSION['user_id']){
                ?>
                <label style="font-size: 12px;">Self Reply(disabled)</label>
                <?php
              }else {
                ?>
                    <a href="#" class="get_id" style="font-size: 12px;" data-comment="<?= $rowComments['comment_id'] ?>" data-id="<?= $rowComments['user_id'] ?>" data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Reply</a>
                <?php
              }
            ?>
        </div>
        <div style="margin-left: 30px;">
          <?php
            $reply = mysqli_query($conn, "SELECT * FROM tbl_reply_comment WHERE comment_id = '$comment_id' ");
            while($fetchReply = mysqli_fetch_assoc($reply)){

              $userId = $fetchReply['user_id'];

              $sqlName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = $userId ");
              $fetchName = mysqli_fetch_assoc($sqlName);
              
              $full_name = $fetchName['first_name'] . ' ' . $fetchName['last_name'];
              ?>
              <div><b><?= $full_name ?></b></div>
              <div style="margin-left: 30px;">
                <?= $fetchReply['reply_text'] ?>
                - <label style="font-size: 11px;"><?php 

                $dateString = $fetchReply['date']; // Replace this with your date string
                $dateTime = new DateTime($rowComments['date']);
                $formattedDate = $dateTime->format('F j, Y g:i A');
                echo $formattedDate; 
                 ?>
              </div>    
              <a href="#" style="font-size: 12px;">Like</a>
              <?php
                if($fetchReply['user_id'] == $_SESSION['user_id']){
                  ?>
                  <label style="font-size: 12px;">Self Reply(disabled)</label>
                  <?php
                }else {
                  ?>
                  <a href="#" class="get_id2" style="font-size: 12px;" data-comment="<?= $fetchReply['comment_id'] ?>" data-id="<?= $fetchReply['user_id'] ?>" data-bs-toggle='modal' data-bs-target='#reply2Modal'>Reply</a>
                  <?php
                }
              ?>
              <?php
            }
                  
          ?>
        </div>
        <hr>
      </div>
      <?php
    }
  
  ?>
  </div>

              </div>
          </div>
        </div><!-- End Left side columns -->
        

        <!-- Right side columns -->
        <div class="col-lg-6">

          <!-- Recent Activity -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title"><?= $row['product_name'] ?> <span>| <?= $row['product_code'] ?></span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div style="margin-right: 5px;"><b>Price : </b><?= $row['product_price'] ?></div>
                </div>
                <div class="activity-item d-flex">
                  <div style="margin-right: 5px;"><b>Category : </b><?= $row['product_category'] ?></div>
                </div>
                <div class="activity-item d-flex">
                  <div class="" style="margin-right: 5px;"><b>Description : </b><?= $row['product_description'] ?></div>
                </div>
                <div class="activity-item d-flex">
                  <div style="margin-right: 5px;"><b>Available Stocks : </b><?= $row['product_quantity'] ?>
                <input type="hidden" id="limitQty" value="<?= $row['product_quantity'] ?>"></div>
                </div>

                <div class="mt-2">
                  <button id="countMinus" style="width: 35px; height: 34px;">-</button>
                  <input type="text" id="count" value="1" readonly style="width: 35px; height: 34px;">
                  <button id="countPlus" style="width: 35px; height: 34px;">+</button>
                  <button class="btn btn-primary w-100 mt-2 addItem">Add to Cart</button>
                </div>



              </div>

            </div>
          </div><!-- End Recent Activity -->


        </div><!-- End Right side columns -->

      </div>
    </section>



    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reply to : <label for="" id="reply_name"></label></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="comment_id">
        <textarea name="" id="reply_text" class="form-control" placeholder="Write a reply.." rows="2"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary comment_reply">Reply</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reply2Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reply to : <label for="" id="reply_name2"></label></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="comment_id2">
        <textarea name="" id="reply_text2" class="form-control" placeholder="Write a reply.." rows="2"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary comment_reply2">Reply</button>
      </div>
    </div>
  </div>
</div>

  <?php include '../includes/footer_ecommerce.php'; ?>


  <script>
const countPlus = document.getElementById('countPlus');
const countMinus = document.getElementById('countMinus');
const countInput = document.getElementById('count');
let count = 1;

countPlus.addEventListener('click', () => {
    count++; // Increment the count
    countInput.value = count; // Update the value of the input field to display the updated count
});

countMinus.addEventListener('click', () => {
    count--; // Increment the count
    countInput.value = count; // Update the value of the input field to display the updated count
});

$(document).ready(function(){
  const count = $("#count").val();
  if(count == 1){
    $("#countMinus").prop("disabled", true)
  }else {
    $("#countMinus").prop("disabled", false)
  }
})

$(document).on("click", "#countPlus", function(){
  const count = parseInt($("#count").val());
  const limitQty = parseInt($("#limitQty").val());
  
  if(count > 1){
    $("#countMinus").prop("disabled", false)
  }
  if(limitQty == count){
    $("#countPlus").prop("disabled", true)
  }
})

$(document).on("click", "#countMinus", function(){
  const count = parseInt($("#count").val());
  const limitQty = parseInt($("#limitQty").val());
  
  if(count == 1){
    $("#countMinus").prop("disabled", true)
  }
  if(count < limitQty){
    $("#countPlus").prop("disabled", false)
  }
})



  $(document).on("click", ".addItem", function(){
    const product_code = '<?php echo $row['product_code'] ?>';
    const product_name = '<?php echo $row['product_name'] ?>';
    const product_price = '<?php echo $row['product_price'] ?>';
    const product_quantity = $("#count").val();
    const addItem = $(".addItem").val();

    const data = {
      product_code: product_code,
      product_name: product_name,
      product_price: product_price,
      product_quantity: product_quantity,
      addItem: addItem
    }

    $.ajax({
        type: 'POST',
        url: '../server/function_cart.php',
        data: data,
        success: function (response) {

            location.reload();
        }
    });


  })


  const stars = document.querySelectorAll('.star');
const ratingValue = document.getElementById('rating-value');


stars.forEach((star) => {
  star.addEventListener('click', setRating);
  star.addEventListener('mouseover', hoverRating);
  star.addEventListener('mouseout', resetRating);
});

let rating = 0;

function setRating(e) {
  const clickedStar = e.target;
  const ratingValue = clickedStar.getAttribute('data-rating');
  rating = ratingValue;
  updateRating();
  commentProduct();
}

function hoverRating(e) {
  const hoveredStar = e.target;
  const ratingValue = hoveredStar.getAttribute('data-rating');
  stars.forEach((star) => {
    if (ratingValue >= star.getAttribute('data-rating')) {
      star.style.color = 'gold';
    } else {
      star.style.color = 'gray';
    }
  });
}

function resetRating() {
  stars.forEach((star) => {
    if (rating >= star.getAttribute('data-rating')) {
      star.style.color = 'gold';
    } else {
      star.style.color = 'gray';
    }
  });
}

function updateRating() {
  ratingValue.innerHTML = `You will be rated this product as ${rating} star(s).`;
}


const commentProduct = $(document).on("click", "#submit", function(){
    const product_id = '<?php echo $_GET['id'] ?>';
    const comment_text = $("#comment_text").val();
    const submit = $(".submit").val();
    const stars = rating;


    const maxLength = 100; // Set your desired maximum length


    if(comment_text == ""){
      alert("Please write a comment!");
    }else if(rating == 0){
      alert("Please rate this product by choosing a desired stars");
    }else if(comment_text.length >= maxLength){
      alert("Comment cannot be more than 100 characters!");
    }else {
      const data = {
      product_id: product_id,
      comment_text: comment_text,
      submit: submit,
      stars: stars
    }

    $.ajax({
        type: 'POST',
        url: '../server/function_comment.php',
        data: data,
        success: function (response) {

           location.reload();
        }
    });
  }
})



$(document).on("click", ".get_id", function(){
  const get_id = $(".get_id").val();
  const user_id = $(this).data("id")
  const comment_id = $(this).data("comment");

  const data = {
    get_id: get_id,
    user_id: user_id
  }

  $.ajax({
        type: 'POST',
        url: '../server/function_comment.php',
        data: data,
        dataType: "json",
        success: function (response) {
          $("#reply_name").html(response.first_name + ' ' +response.last_name);
          $("#comment_id").val(comment_id)
        }
    });

})

$(document).on("click", ".comment_reply", function(){
  const comment_id = $("#comment_id").val();
  const comment_reply = $(".comment_reply").val();
  const reply_text = $("#reply_text").val();

  const maxLength = 100;

  if(reply_text.length >= maxLength){
      alert("Reply cannot be more than 100 characters!");
  }else {
    const data = {
    comment_id: comment_id,
    comment_reply: comment_reply,
    reply_text: reply_text
  }

  $.ajax({
      type: 'POST',
      url: '../server/function_comment.php',
      data: data,
      success: function (response) {
        location.reload();
      }
  });

  }

})


$(document).on("click", ".get_id2", function(){
  const get_id2 = $(".get_id2").val();
  const user_id = $(this).data("id")
  const comment_id = $(this).data("comment");

  const data = {
    get_id2: get_id2,
    user_id: user_id,
  }

  $.ajax({
        type: 'POST',
        url: '../server/function_comment.php',
        data: data,
        dataType: "json",
        success: function (response) {
          $("#reply_name2").html(response.first_name + ' ' +response.last_name);
          $("#comment_id2").val(comment_id)
        }
    });

})

$(document).on("click", ".comment_reply2", function(){
  const comment_id = $("#comment_id2").val();
  const reply_text = $("#reply_text2").val();
  const comment_reply2 = $(".comment_reply2").val();

  const maxLength = 100;


  if(reply_text.length >= maxLength){
      alert("Reply cannot be more than 100 characters!");
  }else {
    const data = {
    comment_id: comment_id,
    comment_reply2: comment_reply2,
    reply_text: reply_text
  }


  $.ajax({
      type: 'POST',
      url: '../server/function_comment.php',
      data: data,
      success: function (response) {
        location.reload();
      }
  });
  }



})



  </script>