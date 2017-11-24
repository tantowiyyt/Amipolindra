@extends('user')

@section('title',' Edit Isian Borang')
@section('stylesheet')
	<style>
		.well{
			background-color: #2980b9;
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
			<h1>Edit Isian Borang</h1>
			
			<p class="lead">{{ $jawaban->pertanyaan }}</p>
			@include('partials._message')
		@if($jawaban->jenis_inputan == 'Deskriptif')
		{!! Form::model($jawaban, ['route' => ['isian.update', $jawaban->id], 'method' => 'PUT']) !!}
			
			{{ Form::label('isi', 'Isi Borang') }}
			{{ Form::textarea('isi', $jawaban->isi, ['class' => 'form-control my-editor']) }}

			{{ Form::submit('Edit Isian', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@elseif($jawaban->jenis_inputan == 'File')
		{!! Form::model($jawaban, ['route' => ['isian.fileupdate', $jawaban->id], 'method' => 'PUT', 'files' => TRUE]) !!}
			
			{{ Form::label('isi', 'Isi Borang') }}
			{{ Form::file('isi', null, ['class' => 'form-control']) }}

			{{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top:15px']) }}

		{!! Form::close() !!}
		@endif	

		</div>	
	
		<div class="col-md-4" style="margin-top:50px">
			<div class="well">

				<dl class="dl-horizontal">
					<label>Borang Nomor:</label>
					<p>{{ $jawaban->id_borang }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Isian Tahun:</label>
					<p>{{ $jawaban->tahun }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Bobot Isian:</label>
					<p>{{ $jawaban->bobot }}</a></p>
				</dl>

				<dl class="dl-horizontal">
					<label>Jenis Inputan:</label>
					<p>{{ $jawaban->jenis_inputan }}</a></p>
				</dl>
				
				<hr>
				
			</div>
		</div>


@endsection