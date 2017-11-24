@extends('user')

@section('title',' Detail Borang')
@section('stylesheet')
	<style>
		.well{
			background-color: #e74c3c;
			color : white;
		}
	</style>
    <script type="text/javascript" src="{{ asset('js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.dev.js') }}"></script>
    <script>
	  var editor_config = {
	    path_absolute : "/",
	    selector: "textarea.my-editor",
	    plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	    relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'Filemanager',
	        width : x * 0.8,
	        height : y * 0.8,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
	  };
  	tinymce.init(editor_config);
</script>
@endsection
@section('content')
	<div class="col-md-7">
			<h1>Detail Borang</h1>
			<table>
				@foreach($borangs as $borang)
				<tr>
					<td style="padding:5px;">{{ $borang->butir->no_butir }}</td>
					<td style="padding:5px;">{{ $borang->borang }}</td>
				</tr>
				@endforeach
			</table>
			<!-- Message-->
			<div>
				@include('partials._message')
			</div>
			<!-- end of message-->
		@if($golongan == 1)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 2)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 3)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 4)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 5)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir5', $borangs[4]->id_no_butir) }}
			{{ Form::hidden('id_borang5', $borangs[4]->id) }}
			{{ Form::hidden('pertanyaan5', $borangs[4]->borang) }}
			{{ Form::hidden('bobot5', $borangs[4]->bobot) }}
			{{ Form::hidden('jenis_inputan5', $borangs[4]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir6', $borangs[5]->id_no_butir) }}
			{{ Form::hidden('id_borang6', $borangs[5]->id) }}
			{{ Form::hidden('pertanyaan6', $borangs[5]->borang) }}
			{{ Form::hidden('bobot6', $borangs[5]->bobot) }}
			{{ Form::hidden('jenis_inputan6', $borangs[5]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir7', $borangs[6]->id_no_butir) }}
			{{ Form::hidden('id_borang7', $borangs[6]->id) }}
			{{ Form::hidden('pertanyaan7', $borangs[6]->borang) }}
			{{ Form::hidden('bobot7', $borangs[6]->bobot) }}
			{{ Form::hidden('jenis_inputan7', $borangs[6]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 6)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 7)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir5', $borangs[4]->id_no_butir) }}
			{{ Form::hidden('id_borang5', $borangs[4]->id) }}
			{{ Form::hidden('pertanyaan5', $borangs[4]->borang) }}
			{{ Form::hidden('bobot5', $borangs[4]->bobot) }}
			{{ Form::hidden('jenis_inputan5', $borangs[4]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir6', $borangs[5]->id_no_butir) }}
			{{ Form::hidden('id_borang6', $borangs[5]->id) }}
			{{ Form::hidden('pertanyaan6', $borangs[5]->borang) }}
			{{ Form::hidden('bobot6', $borangs[5]->bobot) }}
			{{ Form::hidden('jenis_inputan6', $borangs[5]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir7', $borangs[6]->id_no_butir) }}
			{{ Form::hidden('id_borang7', $borangs[6]->id) }}
			{{ Form::hidden('pertanyaan7', $borangs[6]->borang) }}
			{{ Form::hidden('bobot7', $borangs[6]->bobot) }}
			{{ Form::hidden('jenis_inputan7', $borangs[6]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir8', $borangs[7]->id_no_butir) }}
			{{ Form::hidden('id_borang8', $borangs[7]->id) }}
			{{ Form::hidden('pertanyaan8', $borangs[7]->borang) }}
			{{ Form::hidden('bobot8', $borangs[7]->bobot) }}
			{{ Form::hidden('jenis_inputan8', $borangs[7]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 8)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 9)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir5', $borangs[4]->id_no_butir) }}
			{{ Form::hidden('id_borang5', $borangs[4]->id) }}
			{{ Form::hidden('pertanyaan5', $borangs[4]->borang) }}
			{{ Form::hidden('bobot5', $borangs[4]->bobot) }}
			{{ Form::hidden('jenis_inputan5', $borangs[4]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 10)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 11)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir5', $borangs[4]->id_no_butir) }}
			{{ Form::hidden('id_borang5', $borangs[4]->id) }}
			{{ Form::hidden('pertanyaan5', $borangs[4]->borang) }}
			{{ Form::hidden('bobot5', $borangs[4]->bobot) }}
			{{ Form::hidden('jenis_inputan5', $borangs[4]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir6', $borangs[5]->id_no_butir) }}
			{{ Form::hidden('id_borang6', $borangs[5]->id) }}
			{{ Form::hidden('pertanyaan6', $borangs[5]->borang) }}
			{{ Form::hidden('bobot6', $borangs[5]->bobot) }}
			{{ Form::hidden('jenis_inputan6', $borangs[5]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir7', $borangs[6]->id_no_butir) }}
			{{ Form::hidden('id_borang7', $borangs[6]->id) }}
			{{ Form::hidden('pertanyaan7', $borangs[6]->borang) }}
			{{ Form::hidden('bobot7', $borangs[6]->bobot) }}
			{{ Form::hidden('jenis_inputan7', $borangs[6]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 12)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 13)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 14)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 15)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir5', $borangs[4]->id_no_butir) }}
			{{ Form::hidden('id_borang5', $borangs[4]->id) }}
			{{ Form::hidden('pertanyaan5', $borangs[4]->borang) }}
			{{ Form::hidden('bobot5', $borangs[4]->bobot) }}
			{{ Form::hidden('jenis_inputan5', $borangs[4]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 16)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 17)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 18)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 19)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir5', $borangs[4]->id_no_butir) }}
			{{ Form::hidden('id_borang5', $borangs[4]->id) }}
			{{ Form::hidden('pertanyaan5', $borangs[4]->borang) }}
			{{ Form::hidden('bobot5', $borangs[4]->bobot) }}
			{{ Form::hidden('jenis_inputan5', $borangs[4]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir6', $borangs[5]->id_no_butir) }}
			{{ Form::hidden('id_borang6', $borangs[5]->id) }}
			{{ Form::hidden('pertanyaan6', $borangs[5]->borang) }}
			{{ Form::hidden('bobot6', $borangs[5]->bobot) }}
			{{ Form::hidden('jenis_inputan6', $borangs[5]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir7', $borangs[6]->id_no_butir) }}
			{{ Form::hidden('id_borang7', $borangs[6]->id) }}
			{{ Form::hidden('pertanyaan7', $borangs[6]->borang) }}
			{{ Form::hidden('bobot7', $borangs[6]->bobot) }}
			{{ Form::hidden('jenis_inputan7', $borangs[6]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir8', $borangs[7]->id_no_butir) }}
			{{ Form::hidden('id_borang8', $borangs[7]->id) }}
			{{ Form::hidden('pertanyaan8', $borangs[7]->borang) }}
			{{ Form::hidden('bobot8', $borangs[7]->bobot) }}
			{{ Form::hidden('jenis_inputan8', $borangs[7]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 20)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px']) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 21)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($golongan == 22)
		{!! Form::open(['route' => ['user.multipleborangpost', $golongan], 'method' => 'POST', 'style' => 'margin-top:10px', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borangs[0]->id_no_butir) }}
			{{ Form::hidden('id_borang', $borangs[0]->id) }}
			{{ Form::hidden('pertanyaan', $borangs[0]->borang) }}
			{{ Form::hidden('bobot', $borangs[0]->bobot) }}
			{{ Form::hidden('jenis_inputan', $borangs[0]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir2', $borangs[1]->id_no_butir) }}
			{{ Form::hidden('id_borang2', $borangs[1]->id) }}
			{{ Form::hidden('pertanyaan2', $borangs[1]->borang) }}
			{{ Form::hidden('bobot2', $borangs[1]->bobot) }}
			{{ Form::hidden('jenis_inputan2', $borangs[1]->jenis_inputan) }}
			
			{{ Form::hidden('id_no_butir3', $borangs[2]->id_no_butir) }}
			{{ Form::hidden('id_borang3', $borangs[2]->id) }}
			{{ Form::hidden('pertanyaan3', $borangs[2]->borang) }}
			{{ Form::hidden('bobot3', $borangs[2]->bobot) }}
			{{ Form::hidden('jenis_inputan3', $borangs[2]->jenis_inputan) }}

			{{ Form::hidden('id_no_butir4', $borangs[3]->id_no_butir) }}
			{{ Form::hidden('id_borang4', $borangs[3]->id) }}
			{{ Form::hidden('pertanyaan4', $borangs[3]->borang) }}
			{{ Form::hidden('bobot4', $borangs[3]->bobot) }}
			{{ Form::hidden('jenis_inputan4', $borangs[3]->jenis_inputan) }}
			
			{{ Form::label('isi', 'Isi Borang : ') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@endif	

		</div>	
	
		<div class="col-md-4" style="margin-top:50px">
			
		</div>
@endsection