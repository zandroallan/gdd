<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Gdd | Consejería</title>
    <meta name="description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <!-- Open Graph Meta -->
    <meta property="og:title" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <!-- <link rel="shortcut icon" href="assets/media/favicons/favicon.png"> -->
    <!-- <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png"> -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png"> -->
    <!-- END Icons -->
    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="velzon/css/oneui.css">
    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <!-- END Stylesheets -->
  </head>

  <body>
    <div id="page-container">

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
          <div class="content">
            <div class="row justify-content-center push">
              <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded mb-0">
                  <!-- <div class="block-header block-header-default"> -->
                    <!-- <h3 class="block-title">Sign In</h3> -->
<!--                     <div class="block-options">
                      <a class="btn-block-option fs-sm" href="op_auth_reminder.html">Forgot Password?</a>
                      <a class="btn-block-option" href="op_auth_signup.html" data-bs-toggle="tooltip" data-bs-placement="left" title="New Account">
                        <i class="fa fa-user-plus"></i>
                      </a>
                    </div> -->
                  <!-- </div> -->
                  <div class="block-content">
                    <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                      <h1 class="h2 mb-1">Gdd</h1>
                      <p class="fw-medium text-muted">
                        Gestión Documental Digital
                      </p>
                      <form class="js-validation-signin" action="be_pages_auth_all.html" method="POST">
                        <div class="py-3">
                          <div class="mb-4">
                            <input type="text" class="form-control form-control-alt form-control-lg" id="login-username" name="login-username" placeholder="Username">
                          </div>
                          <div class="mb-4">
                            <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="login-password" placeholder="Password">
                          </div>
                          <!-- <div class="mb-4">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="login-remember" name="login-remember">
                              <label class="form-check-label" for="login-remember">Remember Me</label>
                            </div>
                          </div> -->
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-primary">
                              <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Iniciar sesión
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="fs-sm text-muted text-center">
              <strong>CJG 1.0</strong> &copy; <span data-toggle="year-copy"></span>
            </div>
          </div>
        </div>
      </main>
    </div>

    <script src="velzon/js/oneui.app.min.js"></script>
    <!-- <script src="assets/js/lib/jquery.min.js"></script> -->
    <!-- <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script> -->
    <!-- <script src="assets/js/pages/op_auth_signin.min.js"></script> -->
  </body>
</html>


<?php
/*
<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Page title -->
        <title>SGD V2.0 | Gestión documental</title>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

        <!-- Vendor styles -->
        {!! Html::style('template/vendor/fontawesome/css/font-awesome.css'); !!}
        {!! Html::style('template/vendor/metisMenu/dist/metisMenu.css'); !!}
        {!! Html::style('template/vendor/animate.css/animate.css'); !!}
        {!! Html::style('template/vendor/bootstrap/dist/css/bootstrap.css'); !!}

        <!-- App styles -->
        {!! Html::style('template/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css'); !!}
        {!! Html::style('template/fonts/pe-icon-7-stroke/css/helper.css'); !!}
        {!! Html::style('template/styles/style.css'); !!}
    </head>
    <body class="blank">
        <div class="login-container">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <strong>Secretaría de la Honestidad y Función Pública</strong>
                    <strong>2020 - Unidad de Informática y Desarrollo Digital - SGD v2.0</strong> 
                    <br/> Blvd. los Castillos No. 410, Fracc. Montes Azules, C.P. 29056, 
                    <br>Tuxtla Gutiérrez Chiapas. 
                    <br>Conmutador: (961) 61 8 75 30 Teléfono Quejas y Denuncias 01-800-900-9000 
                    <br>www.shyfpchiapas.gob.mx 
                </div>
            </div>
        </div> 

        <!-- Vendor scripts -->
        {!! Html::script('template/vendor/jquery/dist/jquery.min.js'); !!} 
        {!! Html::script('template/vendor/jquery-ui/jquery-ui.min.js'); !!}
        {!! Html::script('template/vendor/slimScroll/jquery.slimscroll.min.js'); !!}
        {!! Html::script('template/vendor/bootstrap/dist/js/bootstrap.min.js'); !!}   
        {!! Html::script('template/vendor/metisMenu/dist/metisMenu.min.js'); !!}  
        {!! Html::script('template/vendor/iCheck/icheck.min.js'); !!}   
        {!! Html::script('template/vendor/sparkline/index.js'); !!}

        <!-- App scripts -->
        {!! Html::script('template/scripts/homer.js'); !!}

    </body>
</html>
*/
?>