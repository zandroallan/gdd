<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light">
    <head>
        <meta charset="utf-8" />
        <title>Gdd | Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('velzon/images/favicon.ico')); ?>">
        <!-- jsvectormap css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/jsvectormap/css/jsvectormap.min.css')); ?>" />
        <!--Swiper slider css-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/swiper/swiper-bundle.min.css')); ?>" />
        <!-- Layout config Js -->
        <script src="<?php echo e(asset('velzon/js/layout.js')); ?>"></script>
        <!-- Bootstrap Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/css/bootstrap.min.css')); ?>" />
        <!-- Icons Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/css/icons.min.css')); ?>" />
        <!-- App Css-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/css/app.min.css')); ?>" />
        <!-- custom Css-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/css/custom.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/sweetalert2/sweetalert2.min.css')); ?>">

        <?php echo $__env->yieldContent('css'); ?>

        <style>
            .select2-selection__rendered {
                line-height: 60px !important;
            }
            .select2-container .select2-selection--single {
                height: 65px !important;
            }
            .select2-selection__arrow {
                height: 65px !important;
            }
            .bg-thead {
                background-color: #eff3f6  !important;
            }
        </style>

    </head>
    <body>
        <div id="layout-wrapper">

            <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        
                        <?php echo $__env->yieldContent('page-title'); ?>
                        
                        <?php echo $__env->yieldContent('content'); ?>

                    </div>                    
                </div>
            </div>

            <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
        <!-- jquery -->     
        <script src="<?php echo e(asset('velzon/js/jquery.min.js')); ?>"></script>

        <script src="<?php echo e(asset('velzon/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/simplebar/simplebar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/node-waves/waves.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/feather-icons/feather.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/js/plugins.js')); ?>"></script>
        <!-- App js -->
        <script src="<?php echo e(asset('velzon/js/app.js')); ?>"></script>
        <!-- Personal Js-Script -->
        <script src="<?php echo e(asset('js/tools.js')); ?>"></script>
        <script>var vuri=window.location.origin;</script>

        <?php echo $__env->yieldContent('js'); ?>

        <script type="text/javascript">
            <?php echo $__env->yieldContent('script'); ?>
        </script>

    </body>
</html>