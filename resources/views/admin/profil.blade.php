@extends('admin')
@section('title', 'Profil')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Profil Admin</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        <table class="table" style="margin-top:5px;">
            <tr>
                <th>Nama</th>
                <td>&nbsp:&nbsp</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>&nbsp:&nbsp</td>
                <td>{{ Auth::user()->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>&nbsp:&nbsp</td>
                <td><span class="label label-danger">{{ Auth::user()->roles->nama }}</span></td>
            </tr>        
        </table>
        <a href="{{ route('admin.editprofil', Auth::User()->id) }}" class="btn btn-info">Edit Profil</a>&nbsp<a href="{{ route('admin.editpassword', Auth::User()->id) }}" class="btn btn-success">Edit Password</a>
        </div>
	</div>
@endsection