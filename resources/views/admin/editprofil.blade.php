@extends('admin')
@section('title', 'Edit Profil')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Profil Admin</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        {!! Form::model($user, ['route' => ['admin.updateprofil', $user->id], 'method' => 'PUT']) !!}
            {{ Form::label('name', 'Nama : ') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            {{ Form::label('email', 'Email : ') }}
            {{ Form::text('email', null, ['class' => 'form-control', 'disabled']) }}
            {{ Form::submit('Edit Profil', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}
        {!! Form::close() !!}
        </div>
	</div>
@endsection