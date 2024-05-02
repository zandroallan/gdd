    
    <?php $__env->startSection('css'); ?>

        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/buttons.dataTables.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/responsive.bootstrap.min.css')); ?>" />

    <?php $__env->stopSection(); ?>
    

    <?php $__env->startSection('content'); ?>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Documentación enviada</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Enviada</a>
                            </li>
                            <li class="breadcrumb-item active">listado</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <!-- <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Documentación enviada</h4>
                    </div> -->
                    <div class="card-body">
                        <div class="table-responsive _response"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bs-example-modal-lg mdl-show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Large modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Begin-modal -->
                        <div class="_destinatarios"></div>
                            
                        <div class="_anexos"></div>
                        <!-- End - modal -->
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1 align-middle"></i> Cerrar
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header text-center">
                        <h4 class="modal-title"></h4>
                        <small class="font-bold"></small>
                    </div>
                    <div class="modal-body">
                        <div id="vdestinos"></div>                            
                        <div id="vanexos"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    </div>
                </div>
            </div>
        </div> -->

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>

        <script src="<?php echo e(asset('velzon/libs/datatables/js/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.responsive.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js')); ?>"></script>
        <!-- Js Personales -->
        <script src="<?php echo e(asset('js/modulos/titulares/enviados.js')); ?>"></script> 

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>