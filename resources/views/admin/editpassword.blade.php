@extends('admin')
@section('title', 'Edit Password')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Password Admin</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        {!! Form::model($user, ['route' => ['admin.updatepassword', $user->id], 'method' => 'PUT']) !!}
            {{ Form::label('password', 'Password Lama : ') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            {{ Form::label('newpassword', 'Password Baru: ') }}
            {{ Form::password('newpassword', ['class' => 'form-control']) }}
            {{ Form::submit('Edit Password', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}
        {!! Form::close() !!}
        </div>
	</div>
@endsection