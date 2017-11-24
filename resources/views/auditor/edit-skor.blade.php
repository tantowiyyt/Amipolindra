@extends('auditor')
@section('title', ' Edit Penilaian Borang User')
@section('stylesheet')
    <style type="text/css">
        .well{
            background-color: #2980b9;
            color: white;
        }
    </style>
@endsection
@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1>Edit Penilaian Borang User</h1>
                    <div class="col-md-7">
                        <p class="lead">{{ $jawaban->pertanyaan }}</p>
                        <br>
                        <h4><b>Isi :</b></h4>
                        @if($jawaban->jenis_inputan == 'Deskriptif')
                        {!! $jawaban->isi !!}
                        @elseif($jawaban->jenis_inputan == 'File')
                        <a href="{{ asset('isianfile/'.$jawaban->isi) }}">{{ $jawaban->isi }}</a>
                        @endif
                        {!! Form::model($jawaban, ['route' => ['auditor.updateskor', $jawaban->id], 'method' => 'PUT']) !!}
                            {{ Form::label('skor', 'Skor : ') }}
                            {{ Form::select('skor', $skor,null,  ['class' => 'form-control']) }}

                            {{ Form::submit('Validasi', ['class' => 'btn btn-danger', 'style' => 'margin-top:20px']) }}

                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-4" style="margin-top:50px">
                    <!-- well kanan -->
                    <div class="well">


                        <dl class="dl-horizontal">
                            <label>Nomor Borang :</label>
                            <p>{{ $jawaban->id_borang }}</p>
                        </dl>

                        <dl class="dl-horizontal">
                            <label>Jurusan :</label>
                            <p>{{ $jawaban->jurusans->nama_jurusan }}</a></p>
                        </dl>

                        <dl class="dl-horizontal">
                            <label>Tahun :</label>
                            <p>{{ $jawaban->tahun }}</a></p>
                        </dl>
                        
                        <hr>
                        
                    </div>
                    <!-- end of well kanan -->
                </div>
                </div>
            </div>
        </div>

@endsection