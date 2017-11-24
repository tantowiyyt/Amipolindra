@extends('user')

@section('title',' Edit Profil')

@section('content')
	

		<div class="col-md-7">
			<h1>Edit Profil</h1>
			
			@include('partials._message')
		{!! Form::model($users, ['route' => ['user.profilupdate', $users->id], 'method' => 'PUT']) !!}
			
			{{ Form::label('name', 'Nama : ') }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}

			{{ Form::label('email', 'Email : ') }}
			{{ Form::text('email', null, ['class' => 'form-control', 'disabled']) }}

			{{ Form::submit('Edit Profil', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
			
		</div>	

@endsection