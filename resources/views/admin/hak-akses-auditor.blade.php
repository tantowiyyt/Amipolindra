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
        <table class="table" style="margin-top:5px;">
            <tr>
                <th>#</th>
                <th>Auditor Jurusan</th>
                <th>Akses</th>
            </tr>
            <?php
            $no = 1;
            ?>
            @foreach($jurusans as $jurusan)
            <tr>
                <th><?php echo $no++; ?></th>
                <td>{{ $jurusan->nama_jurusan }}</td>
                <td><a href="{{ route('admin.haksesauditorid',$jurusan->id) }}" class="btn btn-danger">Lihat Akses</a></td>
            </tr>
            @endforeach        
        </table>
	</div>
@endsection