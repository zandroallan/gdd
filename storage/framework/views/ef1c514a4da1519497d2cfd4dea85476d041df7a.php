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
            <main id="main-container">
                <div class="hero-static d-flex align-items-center">
                    <div class="content">
                        <div class="row justify-content-center push">
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                <div class="block block-rounded mb-0">
                                    <div class="block-content">
                                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                            <h1 class="h1 mb-1">Gdd</h1>
                                            <p class="fw-medium text-muted">Gestión Documental Digital</p>
                                            <h5>INGRESE SUS DATOS PARA ACCESAR</h5>

                                            <?php echo Form::open(['url' => 'login', 'method' => 'POST', 'id' => 'contact']); ?>

                                                <div class="py-3">
                                                    <div class="mb-4">
                                                        <?php echo Form::text('nickname', old('nickname'), ['id'=>'nickname', 'placeholder'=>'Nombre de Usuario', 'required'=>'true', 'class'=>'form-control form-control-alt form-control-lg']); ?>

                                                    </div>
                                                    <div class="mb-4">
                                                        <?php echo Form::password('password', ['placeholder'=>'Clave de acceso', 'required'=>'true', 'class'=>'form-control form-control-alt form-control-lg']); ?>

                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6 col-xl-5">
                                                        <?php echo Form::button('Iniciar Sesión', ['class' => 'btn w-100 btn-alt-primary', 'type' => 'submit']); ?>

                                                    </div>
                                                </div>
                                            <?php echo Form::close(); ?>

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
