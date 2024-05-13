    <?php $__env->startSection('css'); ?>

        <?php echo Html::style('template/vendor/footable/css/footable.standalone.min.css');; ?>


    <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('js'); ?>

        <?php echo Html::script('template/vendor/moment/moment.js');; ?>  
        <?php echo Html::script('template/vendor/footable/js/footable.js');; ?>

        <?php echo Html::script('js/modulos/titulares/recibidos.js');; ?>    
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb'); ?>
        <li class="active"><span>Inicio</span></li>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('buttons'); ?>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>  
        
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Documentación recibida</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Recibido</a>
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
                    <div class="card-header border-0 align-items-center d-flex">
                        <!-- <h4 class="card-title mb-0 flex-grow-1">Documentación por enviar</h4> -->
                    </div>
                    <div class="card-body border border-dashed border-end-0 border-start-0">
                        <div class="table-responsive table-card _response"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg mdl-show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title"></h5>
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

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>