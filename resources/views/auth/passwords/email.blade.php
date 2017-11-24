<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shorcut icon" href="{{ asset('img/POLINDRA.png') }}">

    <title>Lupa Password</title>
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">	
  	<style type="text/css">
  		body{
  			background-color: #e74c3c;
  		}
  	</style>	
  </head>
				
  <body>
    <!-- Login Halaman -->
	<div class="row" style="margin-top:120px">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-danger">
				<div class="panel-heading">
					<img src="{{asset('img/POLINDRA.png')}}" width="50" height="50"> AUDIT MUTU INTERNAL POLINDRA
				</div>
				<div class="panel-body">
					<div class="row">
						@if(session('status'))
						<div class="alert alert-success">
							<?php  echo "Kami telah mengirim email untuk reset password. Silahkan cek email anda"; ?>
						</div>
						@endif
					</div>	
					<div class="row">	
					{!! Form::open(['url' => 'password/email', 'method' => "POST"])  !!}
					<div class="form-group col-sm-11">
					{{ Form::label('email', 'Email : ') }}
					{{ Form::email('email', null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group col-sm-11">	
					{{ Form::submit('Kirim Reset Password', ['class' => 'btn btn-primary']) }}
					</div>	
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->		
	<!-- End of Login Halaman -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- Latest compiled and minified JavaScript -->
    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    </body>
</html>