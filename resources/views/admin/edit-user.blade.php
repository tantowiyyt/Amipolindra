@extends('admin')

@section('title', 'Edit User')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit User</h1>
      </div>
    </div><!--/.row-->

	<div class="row">
		<div class="col-md-6">
		{!! Form::model($user, ['route' => ['admin.update-user', $user->id], 'method' => 'PUT']) !!}
			
			{{ Form::label('id_jurusan', "Jurusan : ") }}
			{{ Form::select('id_jurusan', $jurusan, null, ['class' => 'form-control']) }}

			{{ Form::label('Nama', "Nama : ") }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}
			

			{{ Form::submit('Edit', ['class' => 'btn btn-success', 'style' => 'margin-top:10px', 'onclick' => "return confirm('Yakin ingin menambah user ?')"]) }}

		{!! Form::close() !!}
		</div>
	</div>

	
	
@endsection