@extends('user')

@section('title', ' Isian Borang User')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Edit Isian Borang</h1>
                        <div class="row col-lg-7">
                            @include('partials._message')
                            <br>
                        </div>
                        <div class="col-lg-10">
                        <p>Silahkan upload isian borang dibawah ini.</p>
                        {{ Form::model($full, ['route' => ['user.borangfullupdate', $full->id], 'method' => 'PUT', 'files' => TRUE]) }}
                        {{ Form::label('file', "Isian Full Borang : ") }}
                        {{ Form::file('file', null, ['class' => 'form-control']) }}
                        {{ Form::submit('Upload', ['class' => 'btn btn-success', 'style' => 'margin-top:10px']) }}
                        {{ Form::close() }}
                        </div>    
                    </div>
                </div>
            </div>
        </div>

@endsection