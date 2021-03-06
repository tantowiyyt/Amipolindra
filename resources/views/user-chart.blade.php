<!DOCTYPE html>
<html>
<head>
	<title>User - @yield('title')</title>
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
                    <a href="/user" class="active"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp&nbspDashboard</a>
                </li>
                <li>
                    <a href="/user/profil"><i class="fa fa-user" aria-hidden="true"></i>&nbsp&nbspProfil</a>
                </li>
                <li>
                    <a href="/user/borang"><i class="fa fa-wpforms" aria-hidden="true"></i>&nbsp&nbspBorang</a>
                </li>
                <li>
                    <a href="/user/isian"><i class="fa fa-book" aria-hidden="true"></i>&nbsp&nbspIsian Borang</a>
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

	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('scripts')
	<!-- menu toggle script -->
	<!-- Menu Toggle Script -->
    
</body>
</html>