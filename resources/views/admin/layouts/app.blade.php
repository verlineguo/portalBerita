<!doctype html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	<link href="{{ asset("backend") }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset(path: "backend") }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset("backend") }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{ asset("backend") }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset("backend") }}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset("backend") }}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset("backend") }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset("backend") }}/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset("backend") }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset("backend") }}/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	@yield('styles')

	<link rel="stylesheet" href="assets/css/semi-dark.css" />

	<title>@yield('admin_page_title')</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
        @include('admin.layouts.sidebar')
		
		<!--end sidebar wrapper -->
		
        <!--start header -->
		@include('admin.layouts.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
            @yield(section: 'content')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('admin.layouts.footer')
	</div>
	
	
	<!--end wrapper-->
	@yield('scripts')


	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="{{ asset("backend") }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset("backend") }}/assets/js/jquery.min.js"></script>
	<script src="{{ asset("backend") }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset("backend") }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset("backend") }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset("backend") }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset("backend") }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{ asset("backend") }}/assets/plugins/chartjs/js/Chart.min.js"></script>
	<!--app JS-->
	<script src="{{ asset("backend") }}/assets/js/app.js"></script>
	@stack('scripts-add')

</body>

</html>