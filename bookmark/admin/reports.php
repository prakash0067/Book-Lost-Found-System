<?php 
	require_once("check-login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Reports</title>
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
						<h3 class="page-title"> Reports </h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Reports</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="row">
						<div class="col-md-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<p class="card-description"> Monthly book count </p>
									<form class="forms-sample">
                                        <div class="row">
                                            <div class="col-md-6">
                                     
                                                <div class="form-group">
                                                    <label>Select Month and Year</label>
                                                    <input type="date" class="form-control" id="monthAndYear">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Category</label>
                                                    <select class="form-control" id="BookCategory" style="height: 45px;">
                                                        <option value="default">---Select---</option>
                                                        <option value="bookentry">Book Entry</option>
                                                        <option value="bookreleased">Book Release</option>
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

                    <div id="book-count-result" class="row">
                   
          
                    </div>
				</div>
				<!-- partial:partials/_footer.php -->
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
    <!-- endinject -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#monthAndYear, #BookCategory').on('change', function() {
                var data = $("#monthAndYear").val();
                var data2 = $("#BookCategory").val();

                if (data == "" || data2 == "default") {
                    $("#book-count-result").html('');
                    return;
                }

                $.ajax({
                    url: 'get-book-data.php',
                    method: 'POST',
                    data: {
                        monthANDyear: data,
                        searchCategory: data2
                    },

                    beforeSend: function() {
						$('#loader').css('display', 'flex');
					},

                    success: function(response) {
                        $("#book-count-result").html(response);
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