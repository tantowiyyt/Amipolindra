@extends('auditor')
@section('title', ' Dokumen AMI')
@section('content')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <h1>Dokumen AMI</h1>
                        <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            @foreach($dokumens as $dokumen)
                                <tr>
                                    <th>{{ $dokumen->id }}</th>
                                    <th>{{ $dokumen->nama }}</th>
                                    <td><a href="{{ asset('dokumen/'.$dokumen->file) }}"><span class="label label-info">Download</span></a></td>
                                    
                                </tr>
                            @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
@endsection











