<?php include '../includes/header_ecommerce.php'; ?>



<div class="pagetitle">
  <h1>Dashboard</h1>
  <!-- <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav> -->
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">


        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Total <span>| Sales</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6>₱<?php
                        $sql = mysqli_query($conn, "SELECT SUM(price) as price, SUM(quantity) as 'quantity', COUNT(order_id) as 'count' FROM `tbl_order_detail_items` WHERE to_complete = 2 AND refund_status IN (0,1)");
                        $row = mysqli_fetch_assoc($sql);
                        echo $row['price'] * $row['quantity'];

                        ?></h6>
                </div>
              </div>
            </div>


          </div>
        </div>



        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <!-- <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div> -->

            <div class="card-body">
              <h5 class="card-title">Total Sold <span>| Products</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?php
                      $sqlProductCount = mysqli_query($conn, "SELECT COUNT(order_id) as 'count' FROM tbl_order_detail_items WHERE to_complete = 2 AND refund_status IN (0,1)");
                      $fetchCount = mysqli_fetch_assoc($sqlProductCount);
                      echo $fetchCount['count'];

                      ?></h6>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Generate <span>| Sales Report</span></h5>
              <?php
                if(@$_GET['export']){
                  echo 'Selected date report not found!';
                }
              ?>

                <form action="report" method="POST">
                  <div class="mb-2">
                    <label for="">Date From</label>
                  <input type="date" id="from_date" name="from_date" class="form-control" placeholder="Start Date">
                  </div>
                  <div class="mb-2">
                  <label for="">Date To</label>
                  <input type="date" id="to_date" name="to_date" class="form-control" placeholder="End Date">
                  </div>
                  <div>
                  <input type="submit" id="report" class="btn btn-primary w-100" value="Generate Report">
                  </div>

                </form>
      
            </div>


          </div>
        </div>

        <div class="col-xxl-4 col-md-6">

          <div class="card info-card customers-card">



            <div class="card-body">
              <h5 class="card-title">Customers <span></span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>
                      <?php
                        $sqlCust = mysqli_query($conn, "SELECT COUNT(user_id) as 'count' FROM tbl_users WHERE group_code = '2' AND status = '1' ");
                        $fetchCust = mysqli_fetch_assoc($sqlCust);
                        echo $fetchCust['count'];
                      ?>

                  </h6>
                  <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

                </div>
              </div>

            </div>
          </div>

        </div>



        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h5 class="card-title">Recent <span>| Sales</span></h5>

              <table class="table table-borderless table-responsive">
                <thead>
                  <tr>
                    <th scope="col">Order No.</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM tbl_order_detail_items WHERE to_complete = 2 ORDER BY order_id ASC LIMIT 5");

                  if (mysqli_num_rows($sql) > 0) {
                    while ($row = mysqli_fetch_assoc($sql)) {

                      $sqlName = mysqli_query($conn, "SELECT first_name, last_name FROM tbl_users WHERE user_id = '" . $row['user_id'] . "' ");
                      $fetchName = mysqli_fetch_assoc($sqlName);

                      $fullname = $fetchName['first_name'] . ' ' . $fetchName['last_name'];

                      $total = $row['price'] * $row['quantity'];
                  ?>
                      <tr>
                        <th scope="row"><?= $row['order_id'] ?></th>
                        <td><?= $fullname ?></td>
                        <td><?= $row['product_name'] ?></td>
                        <td>₱<?= $total ?></td>
                        <td>
                          <?php
                          if ($row['refund_status'] == "7") {
                          ?>
                            <span class="badge bg-danger">Refunded</span>
                          <?php
                          } else {
                          ?>
                            <span class="badge bg-success">Completed</span>
                          <?php
                          }
                          ?>

                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td class="">No data available!</td>
                    </tr>
                  <?php
                  }


                  ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->



      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      <!-- Recent Activity -->
      <!-- <div class="card">


        <div class="card-body">
          <h5 class="card-title">Recent Activity <span>| Today</span></h5>

          <div class="activity">

            <div class="activity-item d-flex">
              <div class="activite-label">32 min</div>
              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
              <div class="activity-content">
                Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
              </div>
            </div>
            <div class="activity-item d-flex">
              <div class="activite-label">56 min</div>
              <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
              <div class="activity-content">
                Voluptatem blanditiis blanditiis eveniet
              </div>
            </div>

            <div class="activity-item d-flex">
              <div class="activite-label">2 hrs</div>
              <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
              <div class="activity-content">
                Voluptates corrupti molestias voluptatem
              </div>
            </div>

            <div class="activity-item d-flex">
              <div class="activite-label">1 day</div>
              <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
              <div class="activity-content">
                Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
              </div>
            </div>

            <div class="activity-item d-flex">
              <div class="activite-label">2 days</div>
              <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
              <div class="activity-content">
                Est sit eum reiciendis exercitationem
              </div>
            </div>

            <div class="activity-item d-flex">
              <div class="activite-label">4 weeks</div>
              <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
              <div class="activity-content">
                Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
              </div>
            </div>

          </div>

        </div>
      </div> -->






    </div><!-- End Right side columns -->

  </div>
</section>


<?php include '../includes/footer_ecommerce.php'; ?>