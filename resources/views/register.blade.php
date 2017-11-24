
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Selamat Datang di Halaman Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form col-md-6 col-md-offset-3" method="post" action="{{ route('register.store') }}">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <h2 style="margin-top:100px;">Halaman Register</h2>
        <label for="name" style="margin-top:20px;">Nama</label>
        <input type="text" id="name" class="form-control" placeholder="Email address" required name="name">

        <div class="form-group">
          <label for="sel1" style="margin-top:10px;">Pilih Role:</label>
          <select class="form-control" id="sel1" name="role">
            <option selected disabled>-- Piih Role --</option>
            @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->nama }}</option>
            @endforeach
          </select>
        </div>

        <label for="inputEmail" style="margin-top:10px;">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required name="email">

        <label for="inputPassword" style="margin-top:10px;">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>

        <button class="btn btn-lg btn-danger btn-block" type="submit">Register</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>