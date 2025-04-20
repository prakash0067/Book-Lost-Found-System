<?php 
	require_once("check-login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Release</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

	<!-- Layout styles -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<!-- End layout styles -->
	<link rel="shortcut icon" href="../assets/images/logo.png" />
</head>

<body>
    <?php 

        $book_id = trim($_GET["bid"]);

        require_once("../../login/common-functions.php");

        $sql = "SELECT * FROM bookentry WHERE book_id = ? AND release_status = 0 LIMIT 1";

        databaseConnect();
    
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("i",$bookId);
            $bookId = $book_id;
            $stmt->execute();
            $result = $stmt->get_result();
            $book_details = $result->fetch_assoc();
        }

        $stmt->close();
        $result->free();
    
        databaseClose();
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
						<h3 class="page-title"> Release Book </h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Release Book</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="row">
						<div class="col-md-10 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="card-title">Book Details</h4>
                                            <p class="card-text"><b> Title:</b> <span class="book-search-result-font"><?php echo $book_details["book_name"]; ?></span></p>

                                            <p class="card-text">
                                            <b>Author Name:</b> <span class="book-search-result-font"><?php 
                                            if ($book_details["author_name"] == "NULL") {
                                                echo '-';
                                            }
                                            else {
                                                echo $book_details["author_name"]; 
                                            }
                                                
                                                ?></span></p>

                                            <p class="card-text">
                                            <b>ISBN Number:</b> <span class="book-search-result-font"><?php echo $book_details["isbn_no"]; ?></span></p>

                                            <p class="card-text">
                                            <b>Enrollment Number:</b> <span class="book-search-result-font"><?php 
                                            if ($book_details["enrollment_no"] == 0) {
                                                echo '-';
                                            }
                                            else {
                                                echo $book_details["enrollment_no"]; 
                                            }
                                            ?></span>
                                            </p>

                                            <p class="card-text">
                                            <b>Call Number:</b> <span class="book-search-result-font"><?php echo $book_details["call_no"]; ?></span></p>

                                            <p class="card-text">
                                            <b>Book Number:</b> <span class="book-search-result-font"><?php echo $book_details["book_no"]; ?></span></p>

                                            <!-- release book related -->

                                            <form action="file-calculation.php" method="POST" enctype="multipart/form-data" onsubmit="return validateBookRelease();">
                                                <button type="button" class="btn btn-gradient-info btn-icon-text mt-3" id="releaseBtn"> Release Book <i class="mdi mdi-lock-open btn-icon-append"></i></button>

                                                <button type="button" class="btn btn-outline-secondary btn-icon-text mt-3 mx-2" id="editBtn"> Edit Book <i class="mdi mdi-file-check btn-icon-append"></i></button>

                                                <div class="form-group mt-5" id="releaseForm">
                                                    <label>Enter student's enrollment number</label>
                                                    <input type="text" class="form-control" id="enrollmentNo" placeholder="Enrollment number" name="enrollmentNo" onkeypress="return /[0-9]/i.test(event.key)"/>
                                                    <span class="error-mssg-book-entry" id="mssg1"></span>

                                                    <!-- bookId -->
                                                    <input type="hidden" name="bid" value="<?php echo $book_id; ?>">
                                                    
                                                    <div class="mt-3">
                                                        <div id="books-form-input">
                                                            <!-- ajax -->
                                                        </div>
                                                        <button type="button" class="btn btn-gradient-primary me-2" id="saveEnrollBtn">Submit</button>
                                                        <button type="button" class="btn btn-light" id="cancelButton">Cancel</button>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                        <div class="col-lg-4">
                                            <img src="../assets/images/books-cover/<?php echo $book_details["cover_pic"]; ?>" alt="Book cover" style="width: 210px; height: 240px;">
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
                    </div>
				</div>
				<!-- partial:partials/_footer.html -->
				<?php require_once("footer.php"); ?>
			</div>
		</div>
	</div>
	<!-- container-scroller -->
	<!-- plugins:js -->
	<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
	<script src="../assets/js/hoverable-collapse.js"></script>
	<script src="../assets/js/misc.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
	<!-- endinject -->
	<!-- Custom js for this page -->
	<script src="../assets/js/dashboard.js"></script>
	<script src="../assets/js/book-release.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $("input").focus(function() {
            $(".error-mssg-book-entry").html('');
        });

        $("#cancelButton").click(function() {
            location.reload();
        });

        $("#editBtn").click(function() {
            window.location = "edit-book.php?id=<?php echo $book_id; ?>";
        });

        $(document).ready(function() {
            $("#releaseBtn").click(function() {
                $(this).hide();
                $("#releaseForm").show();
                $("#editBtn").hide();
            });


            $("#saveEnrollBtn").click(function() {
                $(this).hide();

                var data = $("#enrollmentNo").val();

                if (data == "") {
                    $("#books-form-input").html('');
                    return;
                }

                $.ajax({
                    url: 'book-fine.php',
                    method: 'POST',
                    data: {
                        enrollmentNo: data
                    },

                    success: function(response) {
                        $("#books-form-input").html(response);
                    }
                });
            }); 
        });
    </script>
</body>

</html>