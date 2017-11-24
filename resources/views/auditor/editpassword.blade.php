@extends('auditor')
@section('title',' Edit Password')
@section('content')
		<div class="col-md-7">
			<h1>Edit Password</h1>
			@include('partials._message')
		{!! Form::model($user, ['route' => ['auditor.updatepassword', $user->id], 'method' => 'PUT']) !!}
			{{ Form::label('password', 'Password Lama : ') }}
			{{ Form::password('password', ['class' => 'form-control']) }}
			{{ Form::label('newpassword', 'Password Baru: ') }}
			{{ Form::password('newpassword', ['class' => 'form-control']) }}
			{{ Form::submit('Edit Password', ['class' => 'btn btn-danger', 'style' => 'margin-top:15px']) }}
		{!! Form::close() !!}
		</div>	
@endsection