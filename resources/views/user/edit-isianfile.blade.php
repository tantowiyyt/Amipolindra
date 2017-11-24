@extends('user')

@section('title',' Edit Isian Borang')

@section('content')
	

		<div class="col-md-7">
			<h1>Edit Isian Borang</h1>
			
			<p class="lead">{{ $jawaban->pertanyaan }}</p>
			@include('partials._message')
		
		{!! Form::model($jawaban, ['route' => ['isian.fileupdate', $jawaban->id], 'method' => 'PATCH', 'files' => TRUE]) !!}
			
			{{ Form::label('isi', 'Isi Borang') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		
		</div>	
	
		<div class="col-md-4" style="margin-top:50px">
			<div class="well">

				<dl class="dl-horizontal">
					<label>Borang Nomor:</label>
					<p>{{ $jawaban->id_borang }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Isian Tahun:</label>
					<p>{{ $jawaban->tahun }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Bobot Isian:</label>
					<p>{{ $jawaban->bobot }}</a></p>
				</dl>

				<dl class="dl-horizontal">
					<label>Jenis Inputan:</label>
					<p>{{ $jawaban->jenis_inputan }}</a></p>
				</dl>
				
				<hr>
				
			</div>
		</div>


@endsection