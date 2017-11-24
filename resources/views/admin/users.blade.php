@extends('admin')

@section('title', 'Users')

@section('content')

	<div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
      </div>
    </div><!--/.row-->
    <!-- Message -->
    <div class="col-md-8">
        @include('partials._message')
    </div>
    <!-- end message -->
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.tambah-auditor') }}" class="btn btn-success">Tambah Auditor</a>
            <a href="{{ route('admin.tambah-user') }}" class="btn btn-info">Tambah User</a>
        </div>
    </div>
    <div class="row" style="margin-top:15px">
    	<div class="col-md-12">
    	<table class="table table-striped">
    		<tr>
    			<th>#</th>
    			<th>Nama</th>
    			<th>Email</th>
    			<th>Role</th>
                <th>Jurusan</th>
                <th width="150px;">Aksi</th>
    		</tr>
    		@foreach($users as $user)
			<tr>
				<th>{{ $user->id }}</th>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td><span class="label label-danger">{{ $user->roles->nama }}</span></td>
                <td>
                    @if($user->id_jurusan == NULL)
                    @else
                    {{ $user->jurusans->nama_jurusan }}</td>
                    @endif
                <td>
                    @if($user->roles->nama == 'Auditor')
                    <a href="{{ route('admin.edit-auditor', $user->id) }}" class="btn btn-warning">Edit</a>
                    {!! Form::open(['route' => ['admin.destroy-user', $user->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Anda yakin akan menghapus?')"]) !!}    
                    {!! Form::close() !!}

                    @elseif($user->roles->nama == 'Admin')
                    {{ 'No Action' }}

                    @elseif($user->roles->nama == 'User')
                    <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-warning">Edit</a>
                    {!! Form::open(['route' => ['admin.destroy-user', $user->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Anda yakin akan menghapus?')"]) !!}    
                    {!! Form::close() !!}
                    @endif
                </td>
			</tr>
    		@endforeach
    	</table>
    	</div>
    </div>

@endsection