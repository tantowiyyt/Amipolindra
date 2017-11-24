@extends('user')

@section('title', ' Isi Borang')

@section('content')

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <h1>Borang Akreditasi</h1>
                        <div class="row col-lg-7">
                            @include('partials._message')
                            <br>
                            <ul class="nav nav-pills">
                              <li class="active"><a href="#">Borang</a></li>
                              <li><a href="{{ route('user.borangfullform') }}">Form Upload Full Isian Borang</a></li>
                            </ul>
                        </div>
                        <br><br>
                        <div class="col-lg-12">    
                        @foreach($standards as $standard)
                            <h4 style="margin-top:20px">Standard {{ $standard->id }}. {{ $standard->nama_standard }}</h4>
                            <table class="table table-striped">
                                <tr>
                                    <th>Id Borang</th>
                                    <th>Standard</th>
                                    <th>Nomor Butir</th>
                                    <th>Borang</th>
                                    <th>Bobot</th>
                                    <th>Jenis Inputan</th>
                                    <th>Aksi</th>
                                </tr>
                            @foreach($standard->borangs as $borang)
                                <tr>
                                    <th>{{ $borang->id }}</th>
                                    <th>{{ $borang->standards->nama_standard }}</th>
                                    <td>{{ $borang->butir->no_butir }}</td>
                                    <td>{{ $borang->borang }}</td>
                                    <td>{{ $borang->bobot }}</td>
                                    <td>{{ $borang->jenis_inputan }}</td>
                                    <td>
                                    @if($borang->status == null && $borang->golongan == null)
                                    <a href="{{ route('userborang.show', $borang->id) }}" class="btn btn-success">Detail</a>
                                    @elseif($borang->status == 'parent')
                                    <a href="{{ route('user.multipleborang', $borang->golongan) }}" class="btn btn-success">Detail</a>
                                    @else

                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection