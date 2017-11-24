@extends('admin')

@section('title', 'Tambah Auditor')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Tambah Auditor</h1>
      </div>
    </div><!--/.row-->

	<div class="row">
		<div class="col-md-6">
		{!! Form::open(['route' => 'admin.store-auditor', 'method' => 'POST']) !!}
		
			{{ Form::label('Nama', "Nama : ") }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}
			
			{{ Form::label('id_jurusan', "Jurusan : ", ['style' => 'margin-top:10px']) }}
			{{ Form::select('id_jurusan', $jurusan, null, ['class' => 'form-control']) }}
			
			{{ Form::label('email', "Email : ", ['style' => 'margin-top:10px']) }}
			{{ Form::email('email', null, ['class' => 'form-control']) }}
			
			{{ Form::label('password', "Password : ", ['style' => 'margin-top:10px']) }}
			{{ Form::password('password',  ['class' => 'form-control']) }}

			{{ Form::submit('Tambah', ['class' => 'btn btn-success', 'style' => 'margin-top:10px', 'onclick' => "return confirm('Yakin ingin menambah auditor ?'')"]) }}

		{!! Form::close() !!}
		</div>
	</div>

	
	
@endsection