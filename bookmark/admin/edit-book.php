<?php 
	require_once("check-login.php");

    if (isset($_POST["book-entry-btn-2"])) {

        require_once("../../login/common-functions.php");

        $sql = "UPDATE bookentry SET book_name = ?, author_name = ?, isbn_no = ?, call_no = ?, book_no = ?, enrollment_no = ? WHERE book_id = ?";

        databaseConnect();

		if ($stmt = $con->prepare($sql)) {
			$stmt->bind_param("ssisiii",$bName,$aName,$ISBNno,$callNo,$bookNo,$enrollNo,$bid);
			$bName = trim($_POST["bookName"]);
			$aName = trim($_POST["authorName"]);
			$ISBNno = trim($_POST["isbnNumber"]);
			$callNo = trim($_POST["callNumber"]);
			$bookNo = trim($_POST["bookNumber"]);
			$enrollNo = trim($_POST["enrollmentNo"]);
			$bid = trim($_POST["book_id"]);
			$stmt->execute();
		}

		$stmt->close();
		databaseClose();
		header("Location: book-release.php");
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit</title>
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

        $book_id = trim($_GET["id"]);

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
						<h3 class="page-title"> Edit Book Details</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Edit Book</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					
                    <div class="row">
						<div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<p class="card-description"> Book Details </p>
									<form class="forms-sample" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return validateBookEntry();">
										<div class="form-group">
											<label>Book Name <span class="span-compl-msgs">*</span></label>
											<input type="text" class="form-control" id="BookName" placeholder="Book name" name="bookName" value="<?php echo $book_details["book_name"]; ?>" disabled>
                                            <span id="mssg1" class="error-mssg-book-entry"></span>
										</div>
										<div class="form-group">
											<label>Author Name</label>
											<input type="text" class="form-control" id="authorName" placeholder="Author name" name="authorName" value="<?php echo $book_details["author_name"]; ?>" disabled>
										</div>
										<div class="form-group">
											<label>ISBN Number <span class="span-compl-msgs">*</span></label>
											<input type="text" name="isbnNumber" class="form-control" id="isbnNumber"
												placeholder="ISBN number" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $book_details["isbn_no"]; ?>" disabled>
                                            <span id="mssg2" class="error-mssg-book-entry"></span>
										</div>

                                        <!-- new field -->
                                        <div class="form-group">
											<label>Call Number <span class="span-compl-msgs">*</span></label>
											<input type="text" name="callNumber" class="form-control" id="callNumber"
												placeholder="Call number" value="<?php echo $book_details["call_no"]; ?>" disabled>
                                            <span id="mssg10" class="error-mssg-book-entry"></span>
										</div>

                                        <!-- new field 2 -->
                                        <div class="form-group">
											<label>Book Number <span class="span-compl-msgs">*</span></label>
											<input type="text" name="bookNumber" class="form-control" id="bookNumber"
												placeholder="Book number" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $book_details["book_no"]; ?>" disabled>
                                            <span id="mssg20" class="error-mssg-book-entry"></span>
										</div>

										<div class="form-group">
											<label>Enrollment Number</label>
											<input type="text" name="enrollmentNo" class="form-control"
												id="enrollmentNumber" placeholder="Enrollment number" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $book_details["enrollment_no"]; ?>" disabled>
										</div>

                                        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

                                        <button type="button" class="btn btn-gradient-primary me-2" id="edit-btn" name="book-entry-btn" value="enterbook">Edit</button>
                                        
                                        <div id="submit-btn" style="display: none;">
                                            <button type="submit" class="btn btn-gradient-primary me-2" name="book-entry-btn-2" value="enterbook">Submit</button>
                                            <button class="btn btn-light" type="reset" id="cancel-btn">Cancel</button>
                                        </div>
									</form>
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
	<script src="../assets/js/book-entry.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#edit-btn").click(function() {
                $(this).hide();
                $("#submit-btn").show();
                $("input").removeAttr("disabled");
            });

            $("#cancel-btn").click(function() {
                location.reload();
            });

        });
    </script>
    
</body>

</html>