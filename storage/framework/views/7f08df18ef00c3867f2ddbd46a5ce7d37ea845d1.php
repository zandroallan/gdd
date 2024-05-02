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
        <?php echo Html::style('template/vendor/fontawesome/css/font-awesome.css');; ?>

        <?php echo Html::style('template/vendor/metisMenu/dist/metisMenu.css');; ?>

        <?php echo Html::style('template/vendor/animate.css/animate.css');; ?>

        <?php echo Html::style('template/vendor/bootstrap/dist/css/bootstrap.css');; ?>


        <!-- App styles -->
        <?php echo Html::style('template/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css');; ?>

        <?php echo Html::style('template/fonts/pe-icon-7-stroke/css/helper.css');; ?>

        <?php echo Html::style('template/styles/style.css');; ?>

    </head>
    <body class="blank">
        <div class="login-container">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $__env->yieldContent('content'); ?>

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
        <?php echo Html::script('template/vendor/jquery/dist/jquery.min.js');; ?> 
        <?php echo Html::script('template/vendor/jquery-ui/jquery-ui.min.js');; ?>

        <?php echo Html::script('template/vendor/slimScroll/jquery.slimscroll.min.js');; ?>

        <?php echo Html::script('template/vendor/bootstrap/dist/js/bootstrap.min.js');; ?>   
        <?php echo Html::script('template/vendor/metisMenu/dist/metisMenu.min.js');; ?>  
        <?php echo Html::script('template/vendor/iCheck/icheck.min.js');; ?>   
        <?php echo Html::script('template/vendor/sparkline/index.js');; ?>


        <!-- App scripts -->
        <?php echo Html::script('template/scripts/homer.js');; ?>


    </body>
</html>