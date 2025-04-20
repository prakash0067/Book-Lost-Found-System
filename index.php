<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>BookMark</title>

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

	<!-- bootstrap  -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">


	<!-- Template Main CSS File -->
	<link href="home/assets/css/style.css" rel="stylesheet">

</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex align-items-center">

			<h1 class="logo me-auto"><a href="index.html">BookMark</a></h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo me-auto"><img src="home/assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav id="navbar" class="navbar">
				<ul>
					<li><a href="index.php" class="active"> Home </a></li>

					<li><a href="#about"> About </a></li>
					<li><a href="#"> Contact </a></li>

					<li><a href="login/index.php" class="getstarted">Login</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero">
		<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

			<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

			<div class="carousel-inner" role="listbox">

				<!-- Slide 1 -->
				<div class="carousel-item active" style="background-image: url(home/assets/img/homepage.jpg)">
					<div class="carousel-container">
						<div class="container">
							<h2 class="animate__animated animate__fadeInDown">Welcome to <span>BookMark</span></h2>
							<p class="animate__animated animate__fadeInUp">Come to a book as you would come to an unexplored land. Come without a map. Explore it, and draw your own map. <br>  – Stephen King</p>
							<a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read
								More</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section><!-- End Hero -->

	<main id="main">

		<!-- ======= About Section ======= -->
		<section id="about" class="about">
			<div class="container">
				<div class="row content">
					<div class="col-lg-6">
						<h2>Reading Resource</h2>
						<h3>Discover a wealth of reading resources to enhance your academic journey. With this array of reading resources, your reading experience will be enriched and more enjoyable.</h3>
					</div>
					<div class="col-lg-6 pt-4 pt-lg-0">
						<p>
						The BookMark is designed to streamline the process of lost & found and managing books. This system incorporates various features to create a seamless experience for users.
						</p>
						<ul>
						<li><i class='bx bx-check-double pt-1'></i> The system may have a feature to keep track of the found books, their details, and their status. It may also store records of past lost and found transactions for future reference or auditing purposes. </li>
							<li><i class='bx bx-check-double pt-1'></i> The system allows users to report a lost book by providing details such as the book title, author, isbn, and the date it was lost. </li>
							<li><i class='bx bx-check-double pt-1'></i> Track student's record and automatically calculate fines based on predefined rules. </li>
						</ul>
						<p class="fst-italic">
						"Reading is essential for those who seek to rise above the ordinary." - Jim Rohn
						</p>
					</div>
				</div>

			</div>
		</section><!-- End About Section -->

		<!-- ======= Name Section ======= -->
		<section id="clients" class="clients section-bg">
			<div class="container">
				<div class="horizontal-line"></div>
				<div class="d-flex align-items-center justify-content-center p-4">
					<h1 class=""><a href="index.html" class="second-logo">BookMark</a></h1>
				</div>
				<div class="horizontal-line"></div>
			</div>
		</section><!-- End Clients Section -->

		<!-- ======= Services Section ======= -->
		<section id="services" class="services">
			<div class="container">

				<div class="row">
					<div class="col-md-6 mt-4 mt-md-0">
						<div class="icon-box">
							<i class="bi bi-card-checklist"></i>
							<h4><a href="">Books Management</a></h4>
							<p>Maintain a comprehensive catalog of available books in the system.</p>
						</div>
					</div>
					<div class="col-md-6 mt-4 mt-md-0">
						<div class="icon-box">
							<i class='bx bx-rupee'></i>
							<h4><a href="">Fine Calculation</a></h4>
							<p>Track overdue books and automatically calculate fines based on predefined rules (e.g., per day, per week).</p>
						</div>
					</div>
					<div class="col-md-6 mt-4 mt-md-0">
						<div class="icon-box">
							<i class="bi bi-calendar4-week"></i>
							<h4><a href="">Check-Out and Check-In</a></h4>
							<p>Facilitate the process of borrowing and returning books. Users should be able to select the desired book and check it out for a specified period. </p>
						</div>
					</div>
					<div class="col-md-6 mt-4 mt-md-0">
						<div class="icon-box">
							<i class="bi bi-bar-chart"></i>
							<h4><a href="">Reporting and Analytics</a></h4>
							<p>Generate reports and analytics on book borrowing patterns, popular titles, user preferences, and other relevant data.</p>
						</div>
					</div>
				</div>

			</div>
		</section><!-- End Services Section -->

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-8 col-md-6">
						<div class="footer-info">
							<h3>BookMark</h3>
							<p>
								Uka Tarsadia University,<br>Bardoli, Gujarat, India<br>
								<strong>Phone:</strong> +91 xxxxx xxxxx<br>
								<strong>Email:</strong> info@example.com<br>
							</p>
							<div class="social-links mt-3">
								<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
								<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
								<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
								<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
								<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-md-6 footer-links">
						<h4>Useful Links</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
						</ul>
					</div>

					<div class="col-lg-2 col-md-6 footer-links">
						<h4>Our Services</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Books</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Issue books</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="#">Books management</a></li>
						</ul>
					</div>

				</div>
			</div>
		</div>

		<div class="container">
			<div class="copyright">
				&copy; Copyright <strong><span>BookMark</span></strong>. All Rights Reserved
			</div>
			<div class="credits">
				<!-- All the links in the footer should remain intact. -->
				<!-- You can delete the links only if you purchased the pro version. -->
				<!-- Licensing information: https://bootstrapmade.com/license/ -->
				<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/sailor-free-bootstrap-theme/ -->
				Designed by <a href="#">DeFrauders</a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<!-- Template Main JS File -->
	<script src="home/assets/js/main.js"></script>

</body>

</html>