<?php
require_once("check-login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Book List</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/logo.png" />

    <!-- <script src="../assets/js/pdf.js"></script> -->


    <style>
        #printer-icon {
            font-size: 25px;
            padding: 10px 10px 10px 10px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <?php

    $category = trim($_GET["id"]);

    require_once("../../login/common-functions.php");


    ?>
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
                        <h3 class="page-title"> Book List </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Book List</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body" id="bookListContent">
                                    <?php
                                    databaseConnect();

                                    if ($category == 1) {
                                        echo '<h4 class="card-title">Total Books</h4>';

                                        echo '<div class="table-responsive">
										<table class="table" id="bookListTable">
											<thead>
												<tr>
													<th> S.No </th>
													<th> Book Name </th>
													<th> Entry Date </th>
													<th> ISBN No </th>
                                                    <th> Call No </th>
                                                    <th> Book No </th>
                                                    <th> Enrollment No </th>
												</tr>
											</thead>
											<tbody>';

                                        $sql = "SELECT book_name,entry_date,isbn_no,call_no,book_no,enrollment_no AS enroll FROM bookentry";
                                        $result = $con->query($sql);

                                        $counter = 1;
                                        while ($data = $result->fetch_assoc()) {
                                            if ($data["enroll"] == 0) {
                                                $enroll = '-';
                                            } else {
                                                $enroll = $data["enroll"];
                                            }

                                            // formatting date
                                            $dateTime = new DateTime($data["entry_date"], new DateTimeZone('UTC'));
                                            $formattedDate = $dateTime->format('M j, Y');

                                            echo '<tr>
                                            <td> ' . $counter . ' </td>
                                            <td> ' . $data["book_name"] . ' </td>
                                            <td> ' . $formattedDate . ' </td>
                                            <td> ' . $data["isbn_no"] . ' </td>
                                            <td> ' . $data["call_no"] . ' </td>
                                            <td> ' . $data["book_no"] . ' </td>
                                            <td> ' . $enroll . ' </td>
                                        </tr>';
                                            $counter++;
                                        }

                                        $result->free();
                                    } elseif ($category == 2) {
                                        echo '<h4 class="card-title">Total Books Released</h4>';

                                        echo '<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th> S.No </th>
													<th> Book Name </th>
													<th> Entry Date </th>
                                                    <th> Release Date </th>
													<th> ISBN No </th>
                                                    <th> Enrollment No </th>
												</tr>
											</thead>
											<tbody>';

                                        $sql = "SELECT book_name,isbn_no,entry_date,release_date,bookrelease.enrollment_no AS enroll FROM bookrelease,bookentry WHERE bookentry.book_id = bookrelease.book_id";

                                        $result = $con->query($sql);

                                        $counter = 1;
                                        while ($data = $result->fetch_assoc()) {

                                            // formatting date
                                            $dateTime = new DateTime($data["entry_date"], new DateTimeZone('UTC'));
                                            $formattedDate = $dateTime->format('M j, Y');

                                            // formatting date
                                            $dateTime2 = new DateTime($data["release_date"], new DateTimeZone('UTC'));
                                            $formattedDate2 = $dateTime2->format('M j, Y');

                                            echo '<tr>
                                            <td> ' . $counter . ' </td>
                                            <td> ' . $data["book_name"] . ' </td>
                                            <td> ' . $formattedDate . ' </td>
                                            <td> ' . $formattedDate2 . ' </td>
                                            <td> ' . $data["isbn_no"] . ' </td>
                                            <td> ' . $data["enroll"] . ' </td>
                                        </tr>';
                                            $counter++;
                                        }

                                        $result->free();
                                    } elseif ($category == 3) {
                                        echo '<h4 class="card-title">Total Books Pending</h4>';

                                        echo '<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th> S.No </th>
													<th> Book Name </th>
													<th> Entry Date </th>
													<th> ISBN No </th>
													<th> Call No </th>
													<th> Book No </th>
                                                    <th> Enrollment No </th>
												</tr>
											</thead>
											<tbody>';

                                        $sql = "SELECT book_name,entry_date,isbn_no,call_no,book_no,enrollment_no AS enroll FROM bookentry WHERE release_status = 0";
                                        $result = $con->query($sql);

                                        $counter = 1;
                                        while ($data = $result->fetch_assoc()) {
                                            if ($data["enroll"] == 0) {
                                                $enroll = '-';
                                            } else {
                                                $enroll = $data["enroll"];
                                            }

                                            // formatting date
                                            $dateTime = new DateTime($data["entry_date"], new DateTimeZone('UTC'));
                                            $formattedDate = $dateTime->format('M j, Y');

                                            echo '<tr>
                                            <td> ' . $counter . ' </td>
                                            <td> ' . $data["book_name"] . ' </td>
                                            <td> ' . $formattedDate . ' </td>
                                            <td> ' . $data["isbn_no"] . ' </td>
                                            <td> ' . $data["call_no"] . ' </td>
                                            <td> ' . $data["book_no"] . ' </td>
                                            <td> ' . $enroll . ' </td>
                                        </tr>';
                                            $counter++;
                                        }

                                        $result->free();
                                    } else {
                                        echo '<h4 class="card-title">Book Entry in Current Month</h4>';

                                        echo '<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th> S.No </th>
													<th> Book Name </th>
													<th> Entry Date </th>
													<th> ISBN No </th>
													<th> Call No </th>
													<th> Book No </th>
                                                    <th> Enrollment No </th>
												</tr>
											</thead>
											<tbody>';

                                        $sql = "SELECT book_name,entry_date,isbn_no,call_no,book_no,enrollment_no AS enroll FROM bookentry WHERE MONTH(entry_date) = MONTH(CURRENT_DATE()) AND YEAR(entry_date) = YEAR(CURRENT_DATE());";
                                        $result = $con->query($sql);

                                        $counter = 1;
                                        while ($data = $result->fetch_assoc()) {
                                            if ($data["enroll"] == 0) {
                                                $enroll = '-';
                                            } else {
                                                $enroll = $data["enroll"];
                                            }

                                            // formatting date
                                            $dateTime = new DateTime($data["entry_date"], new DateTimeZone('UTC'));
                                            $formattedDate = $dateTime->format('M j, Y');

                                            echo '<tr>
                                            <td> ' . $counter . ' </td>
                                            <td> ' . $data["book_name"] . ' </td>
                                            <td> ' . $formattedDate . ' </td>
                                            <td> ' . $data["isbn_no"] . ' </td>
                                            <td> ' . $data["call_no"] . ' </td>
                                            <td> ' . $data["book_no"] . ' </td>
                                            <td> ' . $enroll . ' </td>
                                        </tr>';
                                            $counter++;
                                        }

                                        $result->free();
                                    }




                                    databaseClose();
                                    ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex justify-content-end" id="dowload-btn">
                                    <i class="mdi mdi-file-pdf text-danger" id="printer-icon" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Dowload PDF"></i>
                                </div>

                                <div class="d-flex justify-content-end" id="btnExport">
                                    <i class="mdi mdi-file-excel text-success" id="printer-icon" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Dowload Excel"></i>
                                </div>
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
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
    <script>
        $(document).ready(function () {
            $('#dowload-btn').click(function () {
                // Get the table HTML data
                window.location.href = "generate-pdf.php?ctgy=<?php echo $category; ?>";

            });

            $("#btnExport").click(function () {
                let table = document.getElementsByTagName("table");
                console.log(table);
                debugger;
                TableToExcel.convert(table[0], {
                    name: `book-list.xlsx`,
                    sheet: {
                        name: 'Books List'
                    }
                });
            });
        });
    </script>

</body>

</html>