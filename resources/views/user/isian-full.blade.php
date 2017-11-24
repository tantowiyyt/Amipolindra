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
                          <li><a href="{{ route('isian.tahun',$tahun) }}">Isian Borang</a></li>
                          <li class="active"><a href="#">Isian Borang Full</a></li>
                          <li><a href="{{ route('isian.tahunchart',$tahun) }}">Chart</a></li>
                        </ul>
                           @include('partials._message')         
                        </div>
                        <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($isian as $data)	
                                <tr>
                                    <th>{{ $data->id }}</th>
                                    <td><a href="{{ asset('isianfull/'.$data->file) }}">{{ $data->file }}</a></td>
                                    <td>
                                        <?php
                                            $year = date('Y');
                                        ?>
                                        @if($data->tahun == $year)
                                            <a href="{{ route('user.borangfulledit', $data->id) }}" class="btn btn-info">Edit Isian</a>
                                        @else
                                        {{ 'No Action' }}
                                        @endif
                                    </td>
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

@section('scripts')
@endsection