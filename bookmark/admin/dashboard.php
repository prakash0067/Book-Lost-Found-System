<?php 
	require_once("check-login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard</title>
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
	
	$sql = "SELECT COUNT(*) AS total FROM bookentry";
	$sql1 = "SELECT COUNT(*) AS total FROM bookrelease";
	$sql2 = "SELECT COUNT(*) AS total FROM bookentry WHERE release_status = 0";

	require_once("../../login/common-functions.php");
	
	databaseConnect();

	$result = $con->query($sql);
	$data = $result->fetch_assoc();
	$total_book_count = $data["total"];
	$result->free();

	$result = $con->query($sql1);
	$data = $result->fetch_assoc();
	$total_book_released = $data["total"];
	$result->free();

	$result = $con->query($sql2);
	$data = $result->fetch_assoc();
	$total_book_left = $data["total"];
	$result->free();

	// current month book entry count
	$sql3 = "SELECT COUNT(*) AS count FROM bookentry WHERE MONTH(entry_date) = MONTH(CURRENT_DATE()) AND YEAR(entry_date) = YEAR(CURRENT_DATE());";

	$result = $con->query($sql3);
	$data = $result->fetch_assoc();
	$total_book_in_current_month = $data["count"];
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
						<h3 class="page-title">
							<span class="page-title-icon bg-gradient-primary text-white me-2">
								<i class="mdi mdi-home"></i>
							</span> Dashboard
						</h3>
						<nav aria-label="breadcrumb">
							<ul class="breadcrumb">
								<li class="breadcrumb-item active" aria-current="page">
									<span></span>Overview <i
										class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
								</li>
							</ul>
						</nav>
					</div>
					<div class="row">
						<div class="col-md-4 stretch-card grid-margin dashboard-card-height">
							<div class="card bg-gradient-danger card-img-holder text-white dashboard-card-cursor" id="card1">
								<div class="card-body">
									<img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
										alt="circle-image" />
									<h4 class="font-weight-normal mb-3">Total Book Count
									</h4>
									<h2 class="mb-5"><i
											class="mdi mdi-book mdi-100px float-right"></i> <?php echo $total_book_count; ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-4 stretch-card grid-margin dashboard-card-height">
							<div class="card bg-gradient-info card-img-holder text-white dashboard-card-cursor" id="card2">
								<div class="card-body">
									<img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
										alt="circle-image" />
									<h4 class="font-weight-normal mb-3"> Total Books Released 
									</h4>
									<h2 class="mb-5"><i
											class="mdi mdi-book-plus mdi-100px float-right"></i> <?php echo $total_book_released; ?> </h2>
								</div>
							</div>
						</div>
						<div class="col-md-4 stretch-card grid-margin dashboard-card-height">
							<div class="card bg-gradient-success card-img-holder text-white dashboard-card-cursor" id="card3">
								<div class="card-body">
									<img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
										alt="circle-image" />
									<h4 class="font-weight-normal mb-3">Total Book Left
									</h4>
									<h2 class="mb-5"><i
											class="mdi mdi-book-open-variant mdi-100px float-right"></i> <?php echo $total_book_left; ?> </h2>
								</div>
							</div>
						</div>

						<div class="col-md-4 stretch-card grid-margin dashboard-card-height">
							<div class="card bg-gradient-info card-img-holder text-white dashboard-card-cursor" id="card4">
								<div class="card-body">
									<img src="../assets/images/dashboard/circle.svg" class="card-img-absolute"
										alt="circle-image" />
									<h4 class="font-weight-normal mb-3"> Books Entry in Current Month
									</h4>
									<h2 class="mb-5"><i
											class="mdi mdi-book-open-page-variant mdi-100px float-right"></i> <?php echo $total_book_in_current_month; ?> </h2>
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
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#card1").click(function() {
				window.location = "book-list.php?id=1";
			});

			$("#card2").click(function() {
				window.location = "book-list.php?id=2";
			});

			$("#card3").click(function() {
				window.location = "book-list.php?id=3";
			});

			$("#card4").click(function() {
				window.location = "book-list.php?id=4";
			});
        });
    </script>
	
</body>

</html>