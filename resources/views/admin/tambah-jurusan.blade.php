@extends('admin')

@section('title', 'Tambah Jurusan')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Tambah Jurusan</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-6">
		@include('partials._message')
		</div>
	</div>
	<div class="col-md-6">
		{!! Form::open(['route' => 'admin.simpanjurusan', 'method' => 'POST']) !!}
		
			{{ Form::label('nama_jurusan', "Nama Jurusan : ") }}
			{{ Form::text('nama_jurusan', null, ['class' => 'form-control']) }}

			{{ Form::submit('Tambah', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) }}

		{!! Form::close() !!}
	</div>

	
	
@endsection