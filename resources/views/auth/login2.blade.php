<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body>
<style type="text/css">
    @font-face {
        font-family: tahoma;
        src: url({{asset("fonts/tahoma.ttf")}});
    }
    body{
        font-family: "tahoma";
        font-size: 2em;
        background-color: #3b5998;
        color: white;
    }
    a{
        color: white !important;
    }
    div {
        max-width: 100%;
    } 
</style>
<center>
<p></p>
    <p>
        <img src="{{asset('img/logo1.png')}}">
    </p>
    <p><h1>Clínica Ramis</h1></p>
    <p><h4>Iniciar sesión</h4></p>
</center>
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    <fieldset>
        {{ csrf_field() }}
        <div>
            @if($errors->has('email'))
                <center>
                <p class="alert alert-danger">
                    <strong>{{$errors->first('email')}}</strong>
                </p>
                </center>
            @endif
            <div class="form-group">
                <div class="col-md-4 col-md-push-4">
                    <input type="text" name="nickname" class="form-control" required autofocus placeholder="Alias">
                </div>
            </div>
            <div class="form-group">
                @if($errors->has('password'))
                <center>
                <p class="alert alert-danger">
                    <strong>{{$errors->first('password')}}</strong>
                </p>
                </center>
            @endif
                <div class="col-md-4 col-md-push-4">
                    <input type="password" name="password" class="form-control" required autofocus placeholder="contraseña">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-push-5">
                <button type="submit" class="btn btn-primary col-md-2 col-md-push-5">
                    Ingresar
                </button>
            </div>
            <div class="row">
            </div>
                <center>
                    <a class="btn btn-link" href="{{ route('password.request') }}">He olvidado mi contraseña</a>
                </center>
            
        </div>
    </fieldset>
</form>
</body>
</html>