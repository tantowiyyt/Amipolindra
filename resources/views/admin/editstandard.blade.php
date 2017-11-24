@extends('admin')

@section('title', 'Edit Standard Borang')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Standard Borang</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-6">
		@include('partials._message')
		</div>
	</div>
	<div class="col-md-6">
		{!! Form::model($standard, ['route' => ['admin.updatestandardborang', $standard->id], 'method' => 'PUT']) !!}
		
			{{ Form::label('nama_standard', "Nama Standard Borang : ") }}
			{{ Form::text('nama_standard', null, ['class' => 'form-control']) }}

			{{ Form::submit('Edit', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) }}

		{!! Form::close() !!}
	</div>

	
	
@endsection