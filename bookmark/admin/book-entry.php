<?php 
	require_once("check-login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Entry</title>
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

if (isset($_POST["book-entry-btn"])) {

    require_once("../../login/common-functions.php");

    //setting defualt book cover
    $book_cover = "books.jpg";

    // checking if book cover is uploaded or not
    $book_cover_result = true;

    if ($_FILES["bookCoverPic"]["name"] != "") {

        $book_cover_error_mssg = "";
        
        $file_name = $_FILES["bookCoverPic"]["name"];
        $file_size = $_FILES["bookCoverPic"]["size"];
        $file_tmp = $_FILES["bookCoverPic"]["tmp_name"];
        $file_type = strtolower($_FILES["bookCoverPic"]["type"]);

        if ($file_size > 2097152) {
            $book_cover_result = false;
            $book_cover_error_mssg = "Book size must be less than 2MB";
        }
        else {
            // check file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (!in_array($file_type,$allowedTypes)) {
                $book_cover_result = false;
                $book_cover_error_mssg = "Book type can be png, jpg or jpeg only";
            }
        }

        if ($book_cover_result === true) {
            $path = "C:/xampp/htdocs/bms/bookmark/assets/images/books-cover/";
            $new_book_cover_name = checkFileExist($file_name,$path);
            move_uploaded_file($file_tmp,$path.$new_book_cover_name);

            $book_cover = $new_book_cover_name;
        }
    }
    

    // echo $book_cover_result;
    // echo "<br><br>";
    // echo $book_cover_error_mssg;


    if ($book_cover_result === true) {

        $sql = "INSERT INTO bookentry(book_name,author_name,isbn_no,enrollment_no,entry_date,cover_pic,call_no,book_no) VALUES(?,?,?,?,?,?,?,?)";

        // for optional things
        if (trim($_POST["authorName"]) != "") {
            $book_author_name = trim($_POST["authorName"]);
        }
        else {
            $book_author_name = "NULL";
        }

        if (trim($_POST["enrollmentNo"]) != "") {
            $book_enroll_no = trim($_POST["enrollmentNo"]);
        }
        else {
            $book_enroll_no = 0;
        }


        // database connections

        databaseConnect();

        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("ssiisssi",$bookName,$authorName,$isbnNo,$enrollNo,$entryDate,$coverPic,$callNo,$bookNo);
            $bookName = trim($_POST["bookName"]);
            $authorName = $book_author_name;
            $isbnNo = trim($_POST["isbnNumber"]);
            $enrollNo = $book_enroll_no;

            date_default_timezone_set('Asia/Kolkata');
            $entryDate = date("Y-m-d H:i:s");
            $coverPic = $book_cover;

            $callNo = trim($_POST["callNumber"]);
            $bookNo = trim($_POST["bookNumber"]);

            $stmt->execute();

            $book_success_mssg = "Book details saved";
        }

        $stmt->close();
        databaseClose();
    }
}


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
						<h3 class="page-title"> Book Entry </h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Book Entry</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="row">
						<div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
                                    <p class="card-description d-flex justify-content-center text-success" id="entry-success-mssg"> 
                                        <?php 
                                            if (isset($book_success_mssg) && $book_success_mssg != "") {
                                                echo $book_success_mssg;
                                                $book_success_mssg = "";
                                            } 
                                        ?>
                                    </p>
									<p class="card-description"> Book Details </p>
									<form class="forms-sample" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return validateBookEntry();">
										<div class="form-group">
											<label>Book Name <span class="span-compl-msgs">*</span></label>
											<input type="text" class="form-control" id="BookName" placeholder="Book name" name="bookName">
                                            <span id="mssg1" class="error-mssg-book-entry"></span>
										</div>
										<div class="form-group">
											<label>Author Name</label>
											<input type="text" class="form-control" id="authorName" placeholder="Author name" name="authorName">
										</div>
										<div class="form-group">
											<label>ISBN Number <span class="span-compl-msgs">*</span></label>
											<input type="text" name="isbnNumber" class="form-control" id="isbnNumber"
												placeholder="ISBN number" onkeypress="return /[0-9]/i.test(event.key)">
                                            <span id="mssg2" class="error-mssg-book-entry"></span>
										</div>

                                        <!-- new field -->
                                        <div class="form-group">
											<label>Call Number <span class="span-compl-msgs">*</span></label>
											<input type="text" name="callNumber" class="form-control" id="callNumber"
												placeholder="Call number">
                                            <span id="mssg10" class="error-mssg-book-entry"></span>
										</div>

                                        <!-- new field 2 -->
                                        <div class="form-group">
											<label>Book Number <span class="span-compl-msgs">*</span></label>
											<input type="text" name="bookNumber" class="form-control" id="bookNumber"
												placeholder="Book number" onkeypress="return /[0-9]/i.test(event.key)">
                                            <span id="mssg20" class="error-mssg-book-entry"></span>
										</div>

										<div class="form-group">
											<label>Enrollment Number</label>
											<input type="text" name="enrollmentNo" class="form-control"
												id="enrollmentNumber" placeholder="Enrollment number" onkeypress="return /[0-9]/i.test(event.key)">
										</div>
                                        <div class="form-group">
											<label>Book Cover Photo</label>
											<input type="file" class="form-control" id="bookCoverPic" name="bookCoverPic">
                                            <span class="book-cover-img">(2MB max size and png,jpg,jpeg)</span>
										</div>
										<button type="submit" class="btn btn-gradient-primary me-2" name="book-entry-btn" value="enterbook">Submit</button>
										<button class="btn btn-light" type="reset">Cancel</button>
									</form>
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
	<script src="../assets/js/hoverable-collapse.js"></script>
	<script src="../assets/js/misc.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    
	<!-- endinject -->
	<!-- Custom js for this page -->
	<script src="../assets/js/dashboard.js"></script>
	<script src="../assets/js/book-entry.js"></script>

	<!-- End custom js for this page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input, button").focus(function() {
                $("#entry-success-mssg").html("");
                $(".error-mssg-book-entry").html("");
            });
        });
    </script>
</body>

</html>