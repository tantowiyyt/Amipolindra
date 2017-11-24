@extends('admin')

@section('title', 'Borang Akreditasi')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Borang Akreditasi</h1>
      </div>
    </div><!--/.row-->

	<!-- message -->
	<div class="col-md-10">
		@include('partials._message')
	</div>
	<!-- end of message -->

	<div class="row">
		<div class="col-md-10">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Standard Borang</th>
					<th>No. Butir</th>
					<th>Borang</th>
					<th>Bobot</th>
					<th>Jenis Inputan</th>
					<th>Aksi</th>
				</tr>
				{{ csrf_field() }}

				@foreach($borangs as $borang)
				<tr>
					<th>{{ $borang->id }}</th>
					<th>{{ $borang->standards->nama_standard }}</th>
					<th>{{ $borang->butir->no_butir }}</th>
					<td>{{ $borang->borang }}</td>
					<td>{{ $borang->bobot }}</td>
					<td>{{ $borang->jenis_inputan }}</td>
					<td><a href="{{ route('borang.edit', $borang->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</a></td>
				</tr>	
				@endforeach
			</table>
		</div>
	</div>

	
	
@endsection