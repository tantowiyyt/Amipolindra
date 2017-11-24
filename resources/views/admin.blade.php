<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Panel - @yield('title')</title>
<link rel="shorcut icon" href="{{ asset('img/POLINDRA.png') }}">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datepicker3.css')}}" rel="stylesheet">
<link href="{{ asset('css/styles.css')}}" rel="stylesheet">

<!--Icons-->
<script src="{{ asset('js/lumino.glyphs.js')}}"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><span>Audit Mutu Internal</span>&nbspAdmin</a>
        <ul class="user-menu">
          <li class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Howdy, {{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('admin.profil') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
              <li><a href="/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
              
    </div><!-- /.container-fluid -->
  </nav>
    
  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    
    <ul class="nav menu" style="margin-top:40px">
      <li class="{{ Request::is('admin') ? "active" : "" }}"><a href="/admin"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
      <li class="{{ Request::is('borang') ? "active" : "" }}"><a href="/borang"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>Borang</a></li>
      <li class="{{ Request::is('admin/profil') ? "active" : "" }}"><a href="/admin/profil"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profil</a></li>
      <li class="{{ Request::is('admin/users') ? "active" : "" }}"><a href="/admin/users"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User</a></li>
      <li class="{{ Request::is('admin/jurusan') ? "active" : "" }}"><a href="/admin/jurusan"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Jurusan</a></li>
      <li class="{{ Request::is('admin/standard-borang') ? "active" : "" }}"><a href="/admin/standard-borang"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Standard Borang</a></li>
      <li class="{{ Request::is('hak-akses-auditor') ? "active" : "" }}"><a href="{{ route('admin.haksesauditor') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Hak Akses Auditor</a></li>
      <li class="{{ Request::is('dokumen') ? "active" : "" }}"><a href="{{ route('dokumen.index') }}"><svg class="glyph stroked blank dokumen"><use xlink:href="#stroked-blank-document"></use></svg> Dokumen</a></li>
      <li role="presentation" class="divider"></li>
      <li><a href="/logout"><svg class="glyph stroked arrow right"><use xlink:href="#stroked-arrow-right"/></svg> Logout</a></li>
    </ul>
    <div class="attribution">Tugas Akhir 2017<br> Tantowi Yahya Yogas T</div>
  </div><!--/.sidebar-->
    
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  @yield('content')
  </div>     
  <script src="{{ asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/chart.min.js')}}"></script>
  <script src="{{ asset('js/chart-data.js')}}"></script>
  <script src="{{ asset('js/easypiechart.js')}}"></script>
  <script src="{{ asset('js/easypiechart-data.js')}}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
</body>
</html>
