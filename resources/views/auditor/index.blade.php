@extends('auditor')

@section('title', ' Halaman Utama Auditor')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Selamat datang!</h1>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <b>Selamat datang di halaman Auditor </b>
                            </div>
                            <div class="panel-body">
                                <p>anda login sebagai <b>{{ Auth::User()->name }}</b> Role : <b>Auditor</b></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

@endsection