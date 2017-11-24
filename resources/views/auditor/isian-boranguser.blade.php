@extends('auditor')

@section('title', ' Isian Borang User')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1>Isian Borang</h1>
                    @foreach($jurusans as $jurusan)
                    <div class="col-lg-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <b>{{ $jurusan->nama_jurusan }}</b>
                            </div>
                            <div class="panel-body">
                            <?php
                                $tahunini = date('Y');
                                for($i=2016; $i <= $tahunini  ; $i++) { 

                            ?>
                                <p>Isian Borang tahun : <a href='/isian/{{ $jurusan->id }}/{{ $i }}'><?php echo $i; ?></a> </p>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

@endsection