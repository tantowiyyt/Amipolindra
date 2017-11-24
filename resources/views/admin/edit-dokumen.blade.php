@extends('admin')
@section('title', 'Dokumen AMI')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Edit Dokumen AMI</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        {{ Form::model($dokumen, ['route' => ['dokumen.update', $dokumen->id], 'method' => 'PUT', 'files' => TRUE]) }}
        
        {{ Form::label('nama', "Nama Dokumen : ") }}
        {{ Form::text('nama', null, ['class' => 'form-control', 'style' => 'margin-bottom:10px']) }}

        {{ Form::label('file', "File : ") }}
        {{ Form::file('file', null, ['class' => 'form-control', 'style' => 'margin-bottom:10px']) }}

        {{ Form::submit('Submit', ['class' => 'btn btn-info', 'style' => 'margin-top:10px']) }}

        {{ Form::close() }}
	</div>
@endsection