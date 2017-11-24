<!DOCTYPE html>
<html>
<head>
	<title>Auditor - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/sidebar.css') }}">
    <link rel="shorcut icon" href="{{ asset('img/POLINDRA.png') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('stylesheet')
</head>
<body>
	
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        {{ Auth::User()->name }}
                    </a>
                </li>
                <li>
                    <a href="/auditor"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp&nbspDashboard</a>
                </li>
                <li>
                    <a href="{{ route('auditor.profil') }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp&nbspProfil</a>
                </li>
                <li>
                    <a href="/isian"><i class="fa fa-wpforms" aria-hidden="true"></i>&nbsp&nbspIsian Borang</a>
                </li>
                <li>
                    <a href="{{ route('auditor.dokumen') }}"><i class="fa fa-wpforms" aria-hidden="true"></i>&nbsp&nbspDokumen AMI</a>
                </li>
                <li>
                    <a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp&nbspLogout</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	@yield('scripts')
    <!-- menu toggle script -->
	<!-- Menu Toggle Script -->
    <script>
        $("#wrapper").toggleClass("toggled");
	    /*$("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        
	    });*/
    </script>
</body>
</html>