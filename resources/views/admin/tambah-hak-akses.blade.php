@extends('admin')
@section('title', 'Tambah Hak Akses Auditor')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Tambah Hak Akses Auditor</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        <p>Auditor Jurusan : </p><span class="label label-danger">
        @foreach($jurusans as $data)
            {{ $data->nama_jurusan }}
        @endforeach
        </span>
        {!! Form::open(['route' => 'admin.haksesauditorsimpan', 'method' => 'POST']) !!}
            {{ Form::hidden('akses_jurusan', $id) }}
            {{ Form::label('id_jurusan', "Hak Akses Jurusan : ", ['style' => 'margin-top:10px']) }}
            {{ Form::select('id_jurusan', $dataakses, null, ['class' => 'form-control', ]) }}
            {{ Form::submit('Tambah', ['class' => 'btn btn-primary', 'style' => 'margin-top:10px']) }}
        {!! Form::close() !!}
        </div>
	</div>
@endsection