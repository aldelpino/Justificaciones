<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JUSTIFICACIONES - AVARAS</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="../build/css/mi_css.css" rel="stylesheet">
  </head>

  <body class="login">
    <div class="row">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="container col-md-offset-1">
        <img src="..\build\images\LOGO_iVARAS.png" class="img-responsive" alt="Cinque Terre" width="304" height="236">
      </div>
        <div class="login_wrapper">
          <div class="animate form login_form">
            <section class="login_content">
              <form method="post" action="{{ route('login') }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <h1>Sistema de Justificaciones</h1>
                <div>
                  <input type="email" class="form-control" placeholder="Correo Institucional" required="" name="email" value="{{ old('email') }}" />
                  {{ $errors->first('email', ':message') }}
                </div>
                <div>
                  <input type="password" class="form-control" placeholder="Contraseña (primeros 6 digitos del RUT)" required="" name="password" />
                  {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                </div>
                <div>
                  <button class="btn btn-primary btn-block">Acceder</button>
                  <a class="reset_pass" href="#signup">Perdiste tu contraseña?</a>
                </div>

                <div class="clearfix"></div>

              </form>
            </section>
          </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
                {{-- forgot/password --}}
            {{-- <form method="post" action="{{ route('recuperar') }}"> --}}
            <form method="post" action="{{ route('recuperar') }}">
              <h1>Olvido de contraseña</h1>

              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required="" />
              </div>
              <div>
                <button class="btn btn-primary btn-block">Recuperar</button>

                {{-- <a class="btn btn-default submit">Recuperar</a> --}}
              </div>

              <div class="clearfix"></div>

            </form>
          </section>
        </div>
      </div>
    </div>






  </body>
</html>
