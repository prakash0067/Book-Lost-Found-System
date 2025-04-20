<?php
require_once("check-login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Histroy</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/logo.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- header -->
        <?php require_once("header.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar -->
            <?php require_once("sidebar.php"); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> History </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">History</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <?php
                                    require_once("../../login/common-functions.php");

                                    // Query to get the books issued for all available months and years in reverse order
                                    $query = "SELECT bookrelease_id,bookrelease.book_id AS book_id,book_name,bookrelease.enrollment_no AS enroll,release_date,fine_amount,file_name, YEAR(release_date) AS release_year, MONTH(release_date) AS release_month,receipt_no FROM bookrelease,bookentry WHERE bookentry.book_id = bookrelease.book_id ORDER BY release_year DESC, MONTH(release_date) DESC";

                                    databaseConnect();

                                    $result = $con->query($query);

                                    // Display the results
                                    if ($result->num_rows > 0) {
                                        $currentMonth = "";
                                        $currentYear = "";

                                        $counter = 0;
                                        while ($row = $result->fetch_assoc()) {

                                            $month = $row["release_month"];
                                            $year = $row["release_year"];

                                            // Check if the month and year have changed
                                            if ($month != $currentMonth || $year != $currentYear) {
                                                //===================
                                                if ($counter != 0) {
                                                    echo '</table>';
                                                    echo '</div>';
                                                }

                                                $counter++;

                                                echo '<p class="card-description history-table mt-4"> '.date("M", mktime(0, 0, 0, $month, 1)).', '.$year.' </p>';

                                                // table format 
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table">';

                                                if ($counter == 1) {
                                                    echo '<tr class="change-table-header"><th>Book name</th><th>Enrollment no</th><th>Release date</th><th>Receipt Number</th><th>Fine amount</th><th>File</th><th></th></tr>';
                                                }

                                                $currentMonth = $month;
                                                $currentYear = $year;
                                            }

                                            // formatting date
                                            $dateTime = new DateTime($row["release_date"], new DateTimeZone('UTC'));
                                            $formattedDate = $dateTime->format('M j, Y');

                                            $fine_amount = $row["fine_amount"];

                                            if ($fine_amount == 0) {
                                                $appORreceipt = '<a href="file.php?file=applications/'.$row["file_name"].'"><label class="badge badge-info file-hover-label"> application </label></a>';
                                            }
                                            else {
                                                $appORreceipt = '<a href="file.php?file=receipts/'.$row["file_name"].'"><label class="badge badge-success file-hover-label"> receipt </label></a>';
                                            }

                                            if ($row["receipt_no"] == "") {
                                                $receipt_no = '-';
                                            }
                                            else {
                                                $receipt_no = $row["receipt_no"];
                                            }

                                            echo '<tr><td class="book-name-overflow">'.$row["book_name"].'</td><td class="book-name-overflow">'.$row["enroll"].'</td><td class="book-name-overflow">'.$formattedDate.'</td><td>'.$receipt_no.'</td><td class="book-name-overflow"> &#8377; '.$row["fine_amount"].'</td><td class="book-name-overflow">'.$appORreceipt.'</td><td>
                                            <button type="button" class="btn btn-inverse-danger btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Record" onclick="deleteBookRelease('.$row["bookrelease_id"].','.$row["book_id"].')">
                                            <i class="mdi mdi-delete"></i>
                                            </button>
                                            </td></tr>';
                                    
                                        }

                                        echo "</table>";
                                        echo "</div>";
                                    } else {
                                        echo "No records found.";
                                    }

                                    databaseClose();

                                    ?>

                                    <!-- <button type="button" class="btn btn-inverse-danger btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Record">
                                        <i class="mdi mdi-delete"></i>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- partial:partials/_footer.html -->
                <?php require_once("footer.php"); ?>
                <!-- partial -->
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script>
        function deleteBookRelease(releaseId,bookId) {
            var con = confirm("Do you want to delete this record?");
            if (!con) {
                return;
            }

            window.location.href = "delete-release.php?rid="+releaseId+"&bid="+bookId+"";
        }
    </script>
</body>

</html>