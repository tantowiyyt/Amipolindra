@extends('user')

@section('title', ' Isian Borang User')

@section('stylesheet')
    <style type="text/css">
        .well{
            background-color: #3498db;
            color: white;
        }
    </style>
    
@endsection

@section('content')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Isian Borang</h1>
                        <div class="col-md-8">
                        <ul class="nav nav-pills">
                          <li class="active"><a href="#">Isian Borang</a></li>
                          <li><a href="{{ route('isian.tahunfull',$tahun) }}">Isian Borang Full</a></li>
                          <li><a href="{{ route('isian.tahunchart',$tahun) }}">Chart</a></li>
                        </ul>
                           @include('partials._message')         
                        </div>
                        <div class="col-md-8">
                        <table class="table">
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
                                @foreach($isian as $isi)
                                <tr>
                                    <th>{{ $isi->id_borang }}</th>
                                    <th>{{ $isi->butir->no_butir }}</th>
                                    <td>{{ $isi->pertanyaan }}</td>
                                    <td>
                                        @if($isi->jenis_inputan == 'Deskriptif')
                                        <a href="{{ route('isian.single-page', $isi->id) }}">{!! substr($isi->isi, 0, 20) !!}...</a>
                                        @elseif($isi->jenis_inputan == 'File')
                                        <a href="{{ asset('isianfile/'.$isi->isi) }}">{{ $isi->isi }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $isi->nilai }}</td>
                                        
                                        <?php
                                            #PERKALIAN
                                            $perkalian = ($isi->bobot * $isi->nilai);
                                            $total = $total+$perkalian;    
                                        ?>
                                    <td>
                                        <?php
                                            $year = date('Y');
                                        ?>
                                        @if($isi->tahun == $year)
                                            @if($isi->jenis_inputan == 'Deskriptif')
                                            <a href="{{ route('isian.edit', $isi->id) }}" class="btn btn-info">Edit Isian</a>
                                            @elseif($isi->jenis_inputan == 'File')
                                            <a href="{{ route('isian.fileedit', $isi->id) }}" class="btn btn-info">Edit Isian</a>
                                            @endif    
                                        @else
                                        {{ 'No Action' }}
                                        @endif
                                    </td>
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
                                    <a class="btn btn-warning" target="_blank" href="{{ route('user.ekspor-pdf', $tahun) }}">Ekspor PDF</a>
                                </h1>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection