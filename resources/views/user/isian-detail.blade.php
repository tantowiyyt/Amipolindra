@extends('user')

@section('title',' Detail Borang')
@section('stylesheet')
	<style>
		.well{
			background-color: #e74c3c;
			color : white;
		}
	</style>
    
@endsection
@section('content')
	<div class="col-md-7">
		<h1>Detail Isian</h1>
		<p class="lead">{{ $jawabans->pertanyaan }}</p>
		<b>Isian Borang :</b><br>
		{!! $jawabans->isi !!}
	</div>	
	<div class="col-md-4" style="margin-top:50px">
		<div class="well">
			<dl class="dl-horizontal">
				<label>Jurusan:</label>
				<p>{{ $jawabans->jurusans->nama_jurusan }}</p>
			</dl>

			<dl class="dl-horizontal">
				<label>Tahun Isian:</label>
				<p>{{ $jawabans->tahun }}</p>
			</dl>
			<dl class="dl-horizontal">
				<label>Komentar:</label>
				<p>
					@if($jawabans->komentar == null)
					Tidak ada Komentar
					@else
					{{ $jawabans->komentar }}
					@endif	
				</p>
			</dl>
			<hr>
			<?php
			$date = date('Y');
			?>
			@if($jawabans->tahun == $date)
			<a href="{{ route('isian.edit', $jawabans->id) }}" class="btn btn-info">Edit</a>&nbsp&nbsp
			@endif
			<a href="{{ route('isian.tahun', $jawabans->tahun) }}" class="btn btn-success">Kembali</a> 
				
		</div>
	</div>


@endsection