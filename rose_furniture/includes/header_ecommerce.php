<?php
@require_once '../database/connection.php';

$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

$username1 = $_SESSION['username'];
$getID     = $_SESSION['user_id'];
$queryUser = $conn->query("SELECT * FROM `tbl_users` WHERE `user_id` = '" . $getID . "' ");
$user      = $queryUser->fetch_assoc();

// 2023-11-12 01:23:39
@$date = new DateTime('now', new DateTimeZone('Asia/Manila'));
@$days_to_subtract = 3;
// Use the modify method to subtract days
@$date->modify("-$days_to_subtract days");
@$new_date = @$date->format('Y-m-d H:i:s');

@$sqlDate = mysqli_query($conn, "SELECT date_completed FROM tbl_order_detail_items WHERE refund_status = 1 ");
@$fetchDate = mysqli_fetch_assoc($sqlDate);

if(@$new_date > @$fetchDate['date_completed']){
  @$updateRefund = "UPDATE tbl_order_detail_items SET refund_status = 0 WHERE refund_status = 1 ";
  mysqli_query($conn, $updateRefund);
}

if(!isset($_SESSION['user_id'])){
  header('Location: ../main/home');
  die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rose Furniture</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bsDatatable.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="home" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Rose Furniture</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <?php
      if($_SESSION['group_code'] == 2){

        if ($curPageName == "home.php") {
          echo '<div class="search-bar">
          <div class="search-form d-flex align-items-center">
            <input type="text" id="search" name="query" placeholder="Search" title="Enter search keyword">
            <button type="button" id="submit" title="Search"><i class="bi bi-search"></i></button>
          </div>
        </div>';
        }
      }
    ?>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->



        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">
              <?php
              $sqlCountAdmin = mysqli_query($conn, "SELECT COUNT(notification_id) as 'id' FROM tbl_notifications WHERE receiver_id = '" . $_SESSION['user_id'] . "' AND status = 1 ");
              $rowCoundAdmin = mysqli_fetch_assoc($sqlCountAdmin);
              echo $rowCoundAdmin['id'];
              ?>
            </span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <?php
                        $sqlCountAdmin = mysqli_query($conn, "SELECT COUNT(notification_id) as 'id' FROM tbl_notifications WHERE receiver_id = '" . $_SESSION['user_id'] . "' AND status = 1");
                        $rowCoundAdmin = mysqli_fetch_assoc($sqlCountAdmin);
                        echo $rowCoundAdmin['id'];
                        ?> new notifications
              <a href="notifications" class="notifViewAll"><span style="cursor: pointer;" class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
              <span style="cursor: pointer;" class="badge rounded-pill bg-primary p-2 ms-2 markRead">Mark all as read</span>
            </li>
            <!-- <li>
              <hr class="dropdown-divider">
            </li> -->

            <!-- <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li> -->

            <!-- <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li> -->




            <?php
            $admin_id = $_SESSION['user_id'];
            $sqlAllNotifs = mysqli_query($conn, "SELECT * FROM tbl_notifications WHERE receiver_id = $admin_id ORDER BY notification_id DESC LIMIT 5");
            while ($rowNotifsAdmin = mysqli_fetch_assoc($sqlAllNotifs)) {
              $sqlViewOrder = mysqli_query($conn, "SELECT order_id, cart_id, detail_code FROM tbl_order_detail_items WHERE detail_code = '" . $rowNotifsAdmin['detail_code'] . "' ");
              $fetchOrder = mysqli_fetch_assoc($sqlViewOrder);

            ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php
              if ($_SESSION['group_code'] == 2) {

                if($rowNotifsAdmin['status'] == 1){
                  ?>
                                  <a id="updateStatus" data-id="<?= $fetchOrder['detail_code'] ?>" href="view_order?code=<?= $fetchOrder['order_id']; ?>&item=<?= $fetchOrder['cart_id']; ?>&track_no=<?= $fetchOrder['detail_code'] ?>">
                  <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <b>
                    <div>
                      <p class="text-justify"><?= $rowNotifsAdmin['notification_text'] ?></p>
                      <p><?php echo date('m-d-Y h:i A', strtotime($rowNotifsAdmin['date'])); ?></p>
                    </div>
                    </b>
                  </li>
                </a>
                  <?php
                }else {
                  ?>
                    <a id="updateStatus" data-id="<?= $fetchOrder['detail_code'] ?>" href="view_order?code=<?= $fetchOrder['order_id']; ?>&item=<?= $fetchOrder['cart_id']; ?>&track_no=<?= $fetchOrder['detail_code'] ?>">
                  <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                      <p class="text-justify"><?= $rowNotifsAdmin['notification_text'] ?></p>
                      <p><?php echo date('m-d-Y h:i A', strtotime($rowNotifsAdmin['date'])); ?></p>
                    </div>
                  </li>
                </a>
                  <?php
                }
              ?>
              <?php
              }else if($_SESSION['group_code'] == 1){
                ?>
                <?php
                  if($rowNotifsAdmin['status'] == 1){
                    ?>
                                    <a href="approval" id="updateStatus" data-id="<?= $fetchOrder['detail_code'] ?>">
                  <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                      <b>
                      <p class="text-justify"><?= $rowNotifsAdmin['notification_text'] ?></p>
                      <p><?php echo date('m-d-Y h:i A', strtotime($rowNotifsAdmin['date'])); ?></p>
                      </b>
                    </div>
                  </li>
                </a>
                    <?php
                  }else {
                    ?>
                  <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                      <p class="text-justify"><?= $rowNotifsAdmin['notification_text'] ?></p>
                      <p><?php echo date('m-d-Y h:i A', strtotime($rowNotifsAdmin['date'])); ?></p>
                    </div>
                  </li>
                    <?php
                  }
                ?>
              <?php
              }else if($_SESSION['group_code'] == 3){
                if($rowNotifsAdmin['status'] == 1){
                  ?>
                  <a id="updateStatus" data-id="<?= $fetchOrder['detail_code'] ?>" href="receiving">
                  <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <b>
                    <div>
                      <p class="text-justify"><?= $rowNotifsAdmin['notification_text'] ?></p>
                      <p><?php echo date('m-d-Y h:i A', strtotime($rowNotifsAdmin['date'])); ?></p>
                    </div>
                    </b>
                  </li>
                </a>
                  <?php
                }else {
                  ?>
                    <a id="updateStatus" data-id="<?= $fetchOrder['detail_code'] ?>" href="receiving">
                  <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                      <p class="text-justify"><?= $rowNotifsAdmin['notification_text'] ?></p>
                      <p><?php echo date('m-d-Y h:i A', strtotime($rowNotifsAdmin['date'])); ?></p>
                    </div>
                  </li>
                </a>
                  <?php
                }
              }
              ?>

              <!-- <li>
                <hr class="dropdown-divider">
              </li> -->
            <?php
            }
            ?>




            <!-- <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li> -->

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="../ecommerce/my_cart">
            <i class='bx bx-cart-alt'></i>
            <?php
            $cartSelect = $conn->query("SELECT COUNT(cart_id) AS 'count' FROM tbl_cart_items WHERE user_id = '$getID' AND status = 1 ");
            $cartItem = $cartSelect->fetch_assoc();
            ?>
            <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span>
          </a>

        </li> -->

        <!-- ==== -->

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul>

        </li> -->


        <!-- ====== -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="https://th.bing.com/th/id/OIP.LG6UqvINZmEBMrUzrhADJAHaHa?pid=ImgDet&rs=1" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $user['first_name'] ?> <?php echo $user['last_name'] ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $user['first_name'] ?> <?php echo $user['last_name'] ?></h6>
              <span>
                <?php
                $group = "";
                if ($user['group_code'] == 1) {
                  $group = "Admin";
                } else if ($user['group_code'] == 2) {
                  $group = "User";
                } else {
                  $group = "Rider";
                }
                echo $group;
                ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../ecommerce/profile?user_id=<?= $getID ?>">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> -->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../ecommerce/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


      <?php
      if ($_SESSION['group_code'] == 1) {
      ?>
        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "dashboard.php") {
                                echo 'collapsed';
                              } ?>" href="dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
      <?php
      }else if($_SESSION['group_code'] == 3){

      } else {
      ?>
        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "home.php") {
                                echo 'collapsed';
                              } ?>" href="home">
            <i class="bi bi-grid"></i><span>Home</span>
          </a>

        </li><!-- End Components Nav -->
      <?php
      }
      ?>



      <?php
      if ($_SESSION['group_code'] == 2) {
      ?>

        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "my_cart.php") {
                                echo 'collapsed';
                              } ?>" href="../ecommerce/my_cart">
            <i class="bx bx-cart-alt"></i><span>My Cart</span>
            <?php
            $cartSelect = $conn->query("SELECT COUNT(cart_id) AS 'count' FROM tbl_cart_items WHERE user_id = '$getID' AND status = 1 ");
            $cartItem = $cartSelect->fetch_assoc();
            ?>
            <div class="text-end" style="margin-left: 5px;">
              <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span>
            </div>

          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "my_purchase.php") {
                                echo 'collapsed';
                              } ?>" href="../ecommerce/my_purchase?history=to_pay">
            <i class="bi bi-menu-button-wide"></i><span>My Purchase</span>
            <!-- <?php
                  $cartSelect = $conn->query("SELECT COUNT(order_id) AS 'count' FROM tbl_order_detail_items WHERE user_id = '$getID' AND status = 1 ");
                  $cartItem = $cartSelect->fetch_assoc();
                  ?>
             <div class="text-end" style="margin-left: 5px;">
            <span class="badge bg-success badge-number"><?= $cartItem['count'] ?></span>
            </div> -->
          </a>
        </li>
<!-- 
        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "cancelled_transactions.php") {
                                echo 'collapsed';
                              } ?>" href="cancelled_transactions">
            <i class="bi bi-menu-button-wide"></i><span>Completed Transactions</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "cancelled_transactions.php") {
                                echo 'collapsed';
                              } ?>" href="cancelled_transactions">
            <i class="bi bi-menu-button-wide"></i><span>Cancelled Transactions</span>
          </a>
        </li> -->

      <?php
      } else if ($_SESSION['group_code'] == 1) {
      ?>

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content collapsed collapse 
        <?php
        if ($curPageName == "approval.php" || 
        $curPageName == "ship.php" || $curPageName == "transit.php" 
        || $curPageName == "completed.php" || $curPageName == "refund.php") {
          echo 'show';
        }
        ?>" data-bs-parent="#sidebar-nav">
            <li>
              <a href="approval">
                <i class="bi bi-circle" style="<?php if ($curPageName == "approval.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>For Approval</span>
              </a>
            </li>
            <li>
              <a href="ship">
                <i class="bi bi-circle" style="<?php if ($curPageName == "ship.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>To Ship</span>
              </a>
            </li>
            <li>
              <a href="transit">
                <i class="bi bi-circle" style="<?php if ($curPageName == "transit.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>In Transit</span>
              </a>
            </li>
            <li>
              <a href="completed">
                <i class="bi bi-circle" style="<?php if ($curPageName == "completed.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>Completed</span>
              </a>
            </li>
            <li>
              <a href="refund">
                <i class="bi bi-circle" style="<?php if ($curPageName == "refund.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>For Refund</span>
              </a>
            </li>
          </ul>
        </li>
      <?php

      } else if ($_SESSION['group_code'] == 3) {
      ?>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav" class="nav-content collapsed collapse 
        <?php
        if ($curPageName == "receiving.php" || $curPageName == "delivery.php" || $curPageName == "for_refund.php") {
          echo 'show';
        }
        ?>" data-bs-parent="#sidebar-nav">
            <li>
              <a href="receiving">
                <i class="bi bi-circle" style="<?php if ($curPageName == "receiving.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>My Receiving</span>
              </a>
            </li>
            <li>
              <a href="delivery">
                <i class="bi bi-circle" style="<?php if ($curPageName == "delivery.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>To Deliver</span>
              </a>
            </li>
            <li>
              <a href="for_refund">
                <i class="bi bi-circle" style="<?php if ($curPageName == "for_refund.php") {
                                                  echo 'background: darkblue;';
                                                } ?>"></i><span>For Refund</span>
              </a>
            </li>
          </ul>
        </li>

      <?php
      }

      ?>


      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li> -->


      <?php

      if ($getID == 1) {
      ?>
        <li class="nav-heading">Admin</li>

        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "users.php") {
                                echo 'collapsed';
                              } ?>" href="users">
            <i class="bi bi-person"></i>
            <span>Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($curPageName != "products.php") {
                                echo 'collapsed';
                              } ?>" href="products">
            <i class="bi bi-person"></i>
            <span>Products</span>
          </a>
        </li>
      <?php
      }

      ?>




      <!-- End Profile Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">


    <script>
      $(document).on("click", "#updateStatus", function() {
        const update_id = $(this).data("id");
        const updateStatus = $("#updateStatus").val();
        $.ajax({
          type: 'POST',
          url: '../server/function_notifications.php',
          data: {
            updateStatus: updateStatus,
            update_id: update_id
          },
          success: function(response) {
            // $("#display_search").html(response);
            // $("#search").val("");
            // $(".display_hide").hide();
          }
        });
      });

      $(document).on("click", ".markRead", function() {
        const markRead = $(".markRead").val();
        $.ajax({
          type: 'POST',
          url: '../server/function_notifications.php',
          data: {
            markRead: markRead,
          },
          success: function(response) {
            location.reload();
          }
        });
      })

      $(document).on("click", ".notifViewAll", function() {
        const notifViewAll = $(".notifViewAll").val();
        $.ajax({
          type: 'POST',
          url: '../server/function_notifications.php',
          data: {
            notifViewAll: notifViewAll,
          },
          success: function(response) {

          }
        });
      })



      $("#search").on('keypress', function(e) {
        if (e.which === 13) {
          // The Enter key (key code 13) was pressed
          var search = $(this).val();
          $.ajax({
            type: 'POST',
            url: '../server/function_search.php',
            data: {
              search: search,
            },
            success: function(response) {
              $("#display_search").html(response);
              $("#search").val("");
              $(".display_hide").hide();
            }
          });
        }
      });
      // $(document).on("click", "#submit", function(){
      //   const search = $("#search").val();
      //   const submit = $("#submit").val();
      //   $.ajax({
      //       type: 'POST',
      //       url: '../server/function_search.php',
      //       data: {
      //         search: search,
      //         submit: submit
      //       },
      //       success: function (response) {
      //         $("#display_search").html(response)
      //       }
      //     });
      // })
    </script>