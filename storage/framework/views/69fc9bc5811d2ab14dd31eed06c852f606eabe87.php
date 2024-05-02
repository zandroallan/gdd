    <?php $__env->startSection('css'); ?>

        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/buttons.dataTables.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/responsive.bootstrap.min.css')); ?>" />

    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('content'); ?>
        
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Documentación por enviar</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Por enviar</a>
                            </li>
                            <li class="breadcrumb-item active">listado</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="flex-grow-1">
                            <a href="<?php echo e(route($current_route.'.create')); ?>" class="btn btn-soft-success">
                                <i class="ri-add-fill me-1 align-bottom"></i> Nuevo documento
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <!-- <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Documentación por enviar</h4>
                    </div> -->
                    <div class="card-body _response"></div>
                </div>
            </div>
        </div>

    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('js'); ?>

        <script src="<?php echo e(asset('velzon/libs/datatables/js/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.responsive.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js')); ?>"></script>
        <!-- Js Personales -->
        <script src="<?php echo e(asset('js/tools.js')); ?>"></script>
        <script src="<?php echo e(asset('js/modulos/titulares/borradores.js')); ?>"></script> 

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>