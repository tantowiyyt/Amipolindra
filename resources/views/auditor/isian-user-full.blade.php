@extends('auditor')

@section('title', ' Isian Borang User')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Isian Borang</h1>
                        <table>
                            <tr>
                                <th>Jurusan</th>
                                <th>&nbsp:&nbsp</th>
                                <th> 
                                    @foreach($jurusan as $nama)
                                        {{ $nama->nama_jurusan }}
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>Tahun</th>
                                <th>&nbsp:&nbsp</th>
                                <th>{{ $tahun }}</th>
                            </tr>
                        </table> 
                        <div class="col-md-7" style="margin-top:5px;">
                        <ul class="nav nav-pills">
                          <li><a href="/isian/@foreach($jurusan as $id){{ $id->id }}@endforeach/{{ $tahun }}">Isian Borang</a></li>
                          <li  class="active"><a href="#">Isian Borang Full</a></li>
                          <li><a href="/isian/@foreach($jurusan as $id){{ $id->id }}@endforeach/{{ $tahun }}/chart">Chart</a></li>
                        </ul>
                        @include('partials._message')
                        </div>
                        <div class="col-md-8">    
                        <table class="table" style="margin-top:20px">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($isian as $isi)
                                <tr>
                                    <th>{{ $isi->id }}</th>
                                    <th><a href="{{ asset('isianfull/'.$isi->file) }}">{{ $isi->file }}</a></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

@endsection