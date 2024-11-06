<html>
    <head>
            <meta charset="utf-8">
            <title>ログイン画面</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
            <div class="container" style="padding:20px 0">
                    @foreach ($errors->all() as $error)
                    <p>{{{ $error }}}</p>
                    @endforeach
                    <form class="form-horizontal" style="margin-bottom:15px" action="{{ action('LoginController@login') }}" method="post">
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">Email</label>
                                    <div class="col-sm-4">
                                            <input type="text" id="email" name="email" class="form-control" value="{{{ Input::old('email') }}}" placeholder="email">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-2 control-label" for="password">Password</label>
                                    <div class="col-sm-4">
                                            <input type="password" name="password" id="password" value="{{{ Input::old('password') }}}" class="form-control" placeholder="password">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-4">
                                    <input type="submit" value="submit" class="btn btn-primary">
                            </div>
                    </form>
            </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>
