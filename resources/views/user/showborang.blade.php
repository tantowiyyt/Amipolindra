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
			<p class="lead">{{ $borang->borang }}</p>
			<!-- Message-->
			<div>
				@include('partials._message')
			</div>
			<!-- end of message-->
		@if($borang->jenis_inputan == 'Deskriptif')
		{!! Form::open(['route' => 'borang.submit', 'method' => 'POST']) !!}
			
			{{ Form::hidden('id_no_butir', $borang->id_no_butir) }}
			{{ Form::hidden('id_borang', $borang->id) }}
			{{ Form::hidden('pertanyaan', $borang->borang) }}
			{{ Form::hidden('bobot', $borang->bobot) }}
			{{ Form::hidden('jenis_inputan', $borang->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang') }}
			{{ Form::textarea('isi', null, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($borang->jenis_inputan == 'File')
		{!! Form::open(['route'=>'borang.filesubmit','method' => 'POST', 'files' => TRUE]) !!}
			
			{{ Form::hidden('id_no_butir', $borang->id_no_butir) }}
			{{ Form::hidden('id_borang', $borang->id) }}
			{{ Form::hidden('pertanyaan', $borang->borang) }}
			{{ Form::hidden('bobot', $borang->bobot) }}
			{{ Form::hidden('jenis_inputan', $borang->jenis_inputan) }}

			{{ Form::label('isi', 'Isi Borang') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@endif	

		</div>	
	
		<div class="col-md-4" style="margin-top:50px">
			<div class="well">


				<dl class="dl-horizontal">
					<label>Nama Standard:</label>
					<p>{{ $borang->standards->nama_standard }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Bobot Borang:</label>
					<p>{{ $borang->bobot }}</a></p>
				</dl>

				<dl class="dl-horizontal">
					<label>Komentar:</label>
					<p>{{ $borang->Komentar }}</a></p>
				</dl>
				
				<hr>
				
			</div>
		</div>


@endsection