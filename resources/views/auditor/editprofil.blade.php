@extends('auditor')
@section('title',' Edit Profil')
@section('content')
		<div class="col-md-7">
			<h1>Edit Profil</h1>
			@include('partials._message')
		{!! Form::model($user, ['route' => ['auditor.updateprofil', $user->id], 'method' => 'PUT']) !!}
			{{ Form::label('name', 'Nama : ') }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}
			{{ Form::label('email', 'Email : ') }}
			{{ Form::text('email', null, ['class' => 'form-control', 'disabled']) }}
			{{ Form::submit('Edit Profil', ['class' => 'btn btn-danger', 'style' => 'margin-top:15px']) }}
		{!! Form::close() !!}
		</div>	
@endsection