@extends('admin')
@section('title', 'Dokumen AMI')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dokumen AMI</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        <a href="{{ route('dokumen.create') }}" class="btn btn-warning">Tambah Dokumen</a>
        <table class="table" style="margin-top:5px;">
            <tr>
                <th>#</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
            @foreach($dokumens as $dokumen)
            <tr>    
                <th>{{ $dokumen->id }}</th>
                <td><a href="{{ asset('dokumen/'.$dokumen->file) }}">{{ $dokumen->nama }}</td>
                <td><a href="{{ route('dokumen.edit', $dokumen->id) }}" class="btn btn-primary">Edit</a>
                {!! Form::open(['route' => ['dokumen.delete', $dokumen->id], 'method' => 'DELETE']) !!}
                {{ Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Anda yakin ingin menghapus ? ')"]) }}
                {!! Form::close() !!}
                </td>
            </tr>  
            @endforeach
        </table>
	</div>
@endsection