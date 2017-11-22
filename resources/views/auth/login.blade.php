<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clinica Ramis | Iniciar sesión.</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <style type="text/css">
        body{
        font-family: "tahoma";
        font-size: 2em;
        background-color: #3b5998 !important;
        color: white;
        }
        a{
            color:white;
        }
        a:hover , a:visited{
            color: yellow;
        }
    </style>
    <div>

      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
              <h1>Iniciar Sesión.</h1>
              <div>
                @if($errors->has('email'))
                <center>
                <p class="alert alert-danger">
                    {{$errors->first('email')}}
                </p>
                </center>
                @endif
                <input type="text" class="form-control" placeholder="Alias" autofocus required name="email" />
              </div>
              <div>
                @if($errors->has('password'))
                <center>
                <p class="alert alert-danger">
                    <strong>{{$errors->first('password')}}</strong>
                </p>
                </center>
                @endif
                <input type="password" class="form-control" placeholder="contraseña" required name="password" />
              </div>
              <div>
                <button class="btn btn-default" type="submit">Iniciar Sesión</button>
                <a class="reset_pass" href="#">¿Olvidó su contraseña?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1 style="font-size: 2em;"><i class="fa fa-user-md"></i> Clínica Ramis</h1>
                  <p>©2017 Todos los derechos reservados MAD.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2017 All Rights Reserved MAD.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    
    </div>
  </body>
</html>
