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
                          <li class="active"><a href="#">Isian Borang</a></li>
                          <li><a href="/isian/@foreach($jurusan as $id){{ $id->id }}@endforeach/{{ $tahun }}/full">Isian Borang Full</a></li>
                          <li><a href="/isian/@foreach($jurusan as $id){{ $id->id }}@endforeach/{{ $tahun }}/chart">Chart</a></li>
                        </ul>
                        @include('partials._message')
                        </div>
                        <div class="col-md-8">    
                        <table class="table" style="margin-top:20px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Butir</th>
                                    <th>Borang</th>
                                    <th>Isi</th>
                                    <th>Skor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;
                                ?>
                                @foreach($jawabans as $isi)
                                <tr>
                                    <th>{{ $isi->id_borang }}</th>
                                    <th>{{ $isi->butir->no_butir }}</th>
                                    <td>{{ $isi->pertanyaan }}</td>
                                    <td>
                                        @if($isi->jenis_inputan == 'Deskriptif')    
                                        <a href="{{ route('auditor.isianusersinglepage', $isi->id) }}">{!! substr($isi->isi, 0, 25) !!}...</a>
                                        @elseif($isi->jenis_inputan == 'File')
                                        <a href="{{ asset('isianfile/'. $isi->isi) }}">{{ $isi->isi }}</a>
                                        @endif
                                    </td>
                                    <th>
                                        @if($isi->nilai == NULL)
                                            0
                                        @else
                                            {{ $isi->nilai }}
                                        @endif        
                                    </th>
                                    <?php
                                        $perkalian = ($isi->nilai * $isi->bobot);
                                        $total = $total + $perkalian;
                                    ?>
                                    <th>
                                        @if($isi->nilai == NULL)
                                            <a href="{{ route('auditor.inputskor', $isi->id) }}" class="btn btn-info">Beri Skor</a>
                                        @else
                                            <a href="{{ route('auditor.editskor', $isi->id) }}" class="btn btn-danger">Edit</a>
                                        @endif    
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-4">
                            <div class="well">
                                <h5>Nilai Borang Akreditasi : </h5>
                                <h1>{{ $total }}</h1>
                                <h5>Grade : </h5>
                                <h1>
                                    @if($total >=361 && $total <= 400)
                                    {{'A'}}
                                    @elseif($total >= 301 && $total <= 360)
                                    {{'B'}}
                                    @elseif($total >= 200 && $total <=300)
                                    {{'C'}}
                                    @elseif($total < 200)
                                    {{ 'Tidak Terakreditasi' }}
                                    @endif<br>
                                    <a href="{{ route('auditor.isianuserdetailpdf', ['id_jurusan' => $nama->id, 'tahun' => $tahun]) }}" class="btn btn-warning" target="_blank">Ekspor PDF</a>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection