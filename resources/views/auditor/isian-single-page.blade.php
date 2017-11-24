@extends('auditor')

@section('title', ' Isian Borang User')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1>Detail Isian Borang</h1>
                    <div class="col-md-7">
                        <p class="lead">{{ $jawaban->pertanyaan }}</p>
                        <b>Isian Borang :</b><br>
                        @include('partials._message')
                        {!! $jawaban->isi !!}
                    </div>  
                    <div class="col-md-4" style="margin-top:50px">
                        <div class="well">
                            <dl class="dl-horizontal">
                                <label>Jurusan:</label>
                                <p>{{ $jawaban->jurusans->nama_jurusan }}</p>
                            </dl>

                            <dl class="dl-horizontal">
                                <label>Tahun Isian:</label>
                                <p>{{ $jawaban->tahun }}</p>
                            </dl>
                            <dl class="dl-horizontal">
                                <label>Komentar:</label>
                                <p>
                                    @if($jawaban->komentar == null)
                                    Tidak ada Komentar
                                    @else
                                    {{ $jawaban->komentar }}
                                    @endif
                                </p>
                            </dl>
                            <hr>
                            <a href="{{ route('auditor.isiankomentar', $jawaban->id) }}" class="btn btn-info">Tulis Komentar</a>
                            <a href="{{ route('auditor.isianuserdetail', [$jawaban->id_jurusan, $jawaban->tahun]) }}" class="btn btn-success">Kembali</a> 
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection