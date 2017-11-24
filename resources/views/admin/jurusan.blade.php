@extends('admin')

@section('title', 'Users')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Jurusan</h1>
      </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.tambahjurusan') }}" class="btn btn-info">Tambah Jurusan</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="margin-top:5px">
            @include('partials._message')
        </div>
    </div>
    <div class="row" style="margin-top:5px">
    	<div class="col-md-10">
    	<table class="table">
    		<tr>
    			<th>#</th>
    			<th>Nama</th>
                <th>Aksi</th>
    		</tr>
    		@foreach($jurusans as $jurusan)
			<tr>
				<th>{{ $jurusan->id }}</th>
				<td>{{ $jurusan->nama_jurusan }}</td>
                <td>
                    <a href="{{ route('admin.editjurusan', $jurusan->id) }}" class="btn btn-success">Edit</a>
                    {!! Form::open(['route' => ['admin.destroy-jurusan', $jurusan->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Anda yakin akan menghapus?')"]) !!}    
                    {!! Form::close() !!}    
                </td>
			</tr>
    		@endforeach
    	</table>
    	</div>
    </div>

@endsection