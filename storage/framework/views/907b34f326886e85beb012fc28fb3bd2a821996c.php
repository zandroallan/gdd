    <?php $__env->startSection('css'); ?>

        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/buttons.dataTables.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/responsive.bootstrap.min.css')); ?>" />
        <?php echo Html::style('js/filer/css/jquery.filer.css');; ?>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>

        <script src="<?php echo e(asset('velzon/libs/datatables/js/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.responsive.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js')); ?>"></script>
        <?php echo Html::script('js/filer/js/jquery.filer.js');; ?>

        <?php echo Html::script('js/modulos/titulares/bitacoras.js');; ?>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bitacora (Documentación enviada fisicamente)</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Bitacora</a>
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
                                <i class="ri-add-fill me-1 align-bottom"></i> Nuevo registro
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


    <div class="modal fade" id="mdlBitacora" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-line"></div>
                <div class="modal-header text-center">
                    <h4 class="modal-title">Agregar Anexo</h4>
                    <small class="font-bold">Subir documento escaneado como parte de la evidencia.</small>
                </div>
                <div class="modal-body">
                    <!-- Begin-modal -->
                    <form name="frmbitacoraAnexo" id="frmbitacoraAnexo">
                        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
                        <div class="form-group row" id="vadjunto">
                            <label class="col-sm-2 control-label" for="adjunto">Adjuntar archivos</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                    <?php echo Form::file('files', ['id'=>'filer', 'class'=>'form-control']);; ?>

                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        <div class="form-group row" id="vcodigo_clasificacion">
                            <label class="col-sm-2 control-label" for="codigo_clasificacion">Codigo Clasificaci&oacute;n </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                                    <?php echo Form::text('codigo_clasificacion', null, ['id' => 'codigo_clasificacion', 'placeholder'=>'Codigo de Clasificacion', 'class' =>  'form-control']); ?>

                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" id="btnaddFile">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>