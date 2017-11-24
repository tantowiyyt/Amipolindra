@extends('admin')

@section('title', 'Edit Borang Akreditasi')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Borang Akreditasi</h1>
      </div>
    </div><!--/.row-->

	<div class="row">
		<div class="col-md-10">
		{!! Form::model($borang, ['route' => ['borang.update', $borang->id], 'method' => 'PATCH']) !!}
		
			{{ Form::label('borang', "Borang : ") }}
			{{ Form::textarea('borang', null, ['class' => 'form-control']) }}
			
			{{ Form::label('id_no_butir', "Nomor Butir : ", ['style' => 'margin-top:10px']) }}
			{{ Form::select('id_no_butir', $butir, null, ['class' => 'form-control']) }}

			{{ Form::label('id_standard', "Standard : ", ['style' => 'margin-top:10px']) }}
			{{ Form::select('id_standard', $standards, null, ['class' => 'form-control']) }}

			{{ Form::label('bobot', "Bobot : ", ['style' => 'margin-top:10px']) }}
			{{ Form::text('bobot', null, ['class' => 'form-control']) }}

			{{ Form::label('jenis_inputan', "Jenis Inputan", ['style' => 'margin-top:10px']) }}
			{{ Form::select('jenis_inputan', $jenisinput, null, ['class' => 'form-control']) }}

			{{ Form::submit('Edit Data', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) }}

		{!! Form::close() !!}
		</div>
	</div>

	
	
@endsection