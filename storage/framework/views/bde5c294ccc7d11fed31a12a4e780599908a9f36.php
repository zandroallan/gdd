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
                    <!-- <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Documentación por enviar</h4>
                    </div> -->
                    <div class="card-body _response"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header text-center">
                        <h4 class="modal-title"></h4>
                        <small class="font-bold"></small>
                    </div>
                    <div class="modal-body">
                        <!-- Begin-modal -->
                        <div id="vdestinos"></div>
                            
                        <div id="vanexos"></div>                        
                        <!-- End - modal -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    </div>
                </div>
            </div>
        </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>