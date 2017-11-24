@extends('admin')
@section('title', 'Hak Akses Auditor')
@section('content')
	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Hak Akses Auditor</h1>
      </div>
    </div><!--/.row-->
	<div class="row">
		<div class="col-md-7">
            @include('partials._message')
        </div>
        <div class="col-md-7">
        <a href="{{ route('admin.haksesauditortambah', $id) }}" class="btn btn-warning">Tambah Hak Akses</a>
        <table class="table" style="margin-top:5px;">
            <tr>
                <th>Auditor Jurusan </th>
                <th> : </th>
                <th>@foreach($jurusans as $jurusan){{ $jurusan->nama_jurusan }}@endforeach</th>
                <th></th>
            </tr>
            <?php
            $no = 1;
            ?>
            <tr>
                <th>Hak Akses Isian Borang </th>
                <th> : </th>
                <th></th>
                <th></th>
            </tr>
            @foreach($akses as $data)
            <tr>    
                <td></td>
                <td></td>
                <td>{{ $data->jurusans->nama_jurusan }}</td>
                <td>
                    {!! Form::open(['route' => ['admin.haksesauditorhapus', $data->id], 'method' => 'DELETE' ]) !!}
                        {{ Form::hidden('id', $id) }}
                        {{ Form::submit('Hapus', ['class' => 'btn btn-primary', 'onclick' => "return confirm('yakin ingin menghapus')"]) }}
                        
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach        
        </table>
	</div>
@endsection