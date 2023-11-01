<?php include '../includes/header_ecommerce.php'; ?>

<style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            margin: 5px;
            background-color: #f0f0f0;
        }

        .pagination a:hover {
            background-color: #ddd;
        }

        .pagination strong {
            padding: 10px;
            border: 1px solid #ccc;
            margin: 5px;
            background-color: #007BFF;
            color: #fff;
        }
    </style>
<!-- Recent Sales -->
<div class="col-10 mx-auto">
  <div class="card recent-sales overflow-auto">

    <div class="card-body">
      <h5 class="card-title">All Nofications</h5>
      <?php

include '../database/connection.php';

// Step 1: Retrieve the total number of items from your database
$totalItemsQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM tbl_notifications");
$totalItemsData = mysqli_fetch_assoc($totalItemsQuery);
$totalItems = $totalItemsData['total'];

// Step 2: Calculate Pagination Parameters
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$totalPages = ceil($totalItems / $itemsPerPage);
$startIndex = ($currentPage - 1) * $itemsPerPage;

// Step 3: Retrieve Data for the Current Page
$sql = mysqli_query($conn, "SELECT notification_text, date FROM tbl_notifications WHERE receiver_id = '".$_SESSION['user_id']."' ORDER BY notification_id DESC LIMIT $startIndex, $itemsPerPage");

$items = array();
while ($row = mysqli_fetch_assoc($sql)) {

  $dateString = $row['date']; // Replace this with your date string
              $dateTime = new DateTime($dateString);
              $formattedDate = $dateTime->format('F j, Y g:i A');
    $items[] = $row['notification_text'] .' on '. $formattedDate;

    
}

// Step 4: Display Data for the Current Page
echo "<div>";
foreach ($items as $item) {
    echo "<div class='border p-3'>" . $item . "</div>";
}
echo "</div>";

if ($currentPage == $totalPages && count($items) == 0) {
  echo "<div class='text-center'><h3>No more notifications</h3></div>";
}

// Step 5: Create Pagination Links (with a limit of 5 buttons per page)
echo "<div class='pagination'>";
if ($currentPage > 1) {
    echo "<a href='?page=" . ($currentPage - 1) . "'><i class='bx bx-chevrons-left'></i></a> ";
}
$paginationLimit = 1;
$startButton = max(1, $currentPage - floor($paginationLimit / 2));
$endButton = min($totalPages, $startButton + $paginationLimit - 1);
for ($i = $startButton; $i <= $endButton; $i++) {
    if ($i == $currentPage) {
        echo "<strong>$i</strong> ";
    } else {
        echo "<a href='?page=$i'>$i</a> ";
    }
}
if ($currentPage < $totalPages) {
    echo "<a href='?page=" . ($currentPage + 1) . "'><i class='bx bx-chevrons-right'></i></a>";
}
echo "</div>";
?>


    </div>

  </div>
</div><!-- End Recent Sales -->






<?php include '../includes/footer_ecommerce.php'; ?>

