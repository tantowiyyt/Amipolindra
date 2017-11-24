@extends('admin')

@section('title', 'Home')

@section('content')

	<div class="row">
      
    </div><!--/.row-->
    
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>
    </div><!--/.row-->
    
    <div class="row">
      <div class="col-md-12">
        <marquee>Selamat datang dihalaman Home Admin</marquee>  
      </div>
    </div>
    <div class="row" class="margin-top:15px;">
      
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-teal panel-widget">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">{{ $users->count() }}</div>
              <div class="text-muted"><a href="{{ route('admin.users') }}">Users</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-red panel-widget">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">{{ $borangs->count() }}</div>
              <div class="text-muted"><a href="/borang"> Borang</a></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-blue panel-widget ">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">{{ $jurusans->count() }}</div>
              <div class="text-muted"><a href="admin/jurusan">Jurusan</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-orange panel-widget">
          <div class="row no-padding">
            <div class="col-sm-3 col-lg-5 widget-left">
              <svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="large">{{ $standards->count() }}</div>
              <div class="text-muted"><a href="/admin/standard-borang">Standard Borang</a></div>
            </div>
          </div>
        </div>
      </div>
      
    </div><!--/.row-->
    
    
    
    
                
    
@endsection