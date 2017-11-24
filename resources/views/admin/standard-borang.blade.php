@extends('admin')

@section('title', 'Borang Akreditasi')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Standard Borang Akreditasi</h1>
      </div>
    </div><!--/.row-->
	<div class="col-md-7" style="margin-bottom:15px">
		<a href="{{ route('admin.tambahstandardborang') }}" class="btn btn-info">Tambah Standard</a>
	</div>
	<div class="col-md-6" style="margin-bottom:15px">
		@include('partials._message')
	</div>
	<div class="row" style="margin-top:15px">
		<div class="col-md-10">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Nama Standard</th>
					<th>Aksi</th>
				</tr>
				@foreach($standards as $standard)
				<tr>
					<th>{{ $standard->id }}</th>
					<td>{{ $standard->nama_standard }}</td>
					<td><a href="{{ route('admin.editstandardborang', $standard->id) }}" class="btn btn-warning">Edit</a>
					{!! Form::open(['route' => ['admin.destroy-standard', $standard->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Anda yakin akan menghapus?')"]) !!}    
                    {!! Form::close() !!}
                    </td>
				</tr>	
				@endforeach
			</table>
		</div>
	</div>
    
	
@endsection