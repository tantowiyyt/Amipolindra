@extends('auditor')
@section('title', ' Profil Auditor')
@section('content')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        <h1>Profil Auditor</h1>
                        <div class="col-md-7">
                            @include('partials._message')
                        </div>
                        <table class="table" style="margin-top:5px;">
                            <tr>
                                <th>Nama</th>
                                <td>&nbsp:&nbsp</td>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>&nbsp:&nbsp</td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>&nbsp:&nbsp</td>
                                <td><span class="label label-success">{{ Auth::user()->roles->nama }}</span></td>
                            </tr>
                        </table>
                        <a href="{{ route('auditor.editprofil', Auth::user()->id) }}" class="btn btn-info">Edit Profil</a>&nbsp<a href="{{ route('auditor.editpassword', Auth::user()->id) }}" class="btn btn-success">Edit Password</a>
                    </div>
                </div>
            </div>
        </div>
@endsection