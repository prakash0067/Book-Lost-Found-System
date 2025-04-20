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
						<h3 class="page-title"> Book Release </h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Book Release</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>

                    <div class="row">						
						<div class="col-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<?php 
										if (isset($_COOKIE["success-mssg"])) {
											echo "<script> alert('Book released successfully'); </script>";
										}
									?>
									<h4 class="card-title">Search Book</h4>
                                    <form class="forms-sample">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group d-flex">
                                                    <i class="mdi mdi-magnify p-2" style="font-size: 25px;"></i>
                                                    <input type="text" class="form-control" id="searchname"
                                                        placeholder="Search book">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <select class="form-control" id="searchCategory" style="height: 45px;">
                                                        <option value="bookName">Book name</option>
                                                        <option value="authorName">Author name</option>
                                                        <option value="enrollNo">Enrollment number</option>
                                                        <option value="isbnNumber">ISBN number</option>
														<option value="callNumber">Call number</option>
														<option value="bookNumber">Book number</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
                    </div>

					<div id="loader" class="loader">
						<img src="../assets/images/loading-gif.webp" class="loader-img" alt="loader">
					</div>

                    <div class="row" id="book-search-results">						
					<!-- search result here -->
					
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
	<script>
		function goToBookRelease(bid) {
			window.location = "release.php?bid="+bid;
		}
	</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchname").keyup(function() {
                var data = $(this).val();
                var category = $("#searchCategory").val();

                if (data == "") {
                    $("#book-search-results").html('');
                    return;
                }

                $.ajax({
                    url: 'get-book-search.php',
                    method: 'POST',
                    data: {
                        bookData: data,
                        searchCategory: category
                    },

					beforeSend: function() {
						$('#loader').css('display', 'flex');
					},

                    success: function(response) {
                        $("#book-search-results").html(response);
                    },

					complete: function() {
						$('#loader').css('display', 'none');
					}
                });
            }); 
        });
    </script>
</body>

</html>