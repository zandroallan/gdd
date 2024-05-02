    <?php $__env->startSection('css'); ?>

        <?php echo Html::style('template/vendor/footable/css/footable.standalone.min.css');; ?>  

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>

        <?php echo Html::script('template/vendor/moment/moment.js');; ?>  
        <?php echo Html::script('template/vendor/footable/js/footable.js');; ?>  
        <?php echo Html::script('js/modulos/titulares/borradores.js');; ?>   

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb'); ?>
        <li class="active"><span>Inicio</span></li>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('buttons'); ?>
        <?php echo html_entity_decode(link_to_route($current_route.'.create', '<i class="fa fa-plus-square"></i> Nuevo',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Nuevo registro', 'class'=>'btn btn-primary btn-sm'])); ?>    
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>  
        
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
    
        <div class="row">
            <div class="col-md-12">

                <div class="hpanel hred">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                        LISTADO DE BORRADORES
                    </div>
                    <div class="panel-body">  
                        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
                        <h3><i class="fa fa-eraser text-warning"></i> Borradores</h3>
                        <div class="table-responsive">                
                            <table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="15" cellspacing="0">
                                <thead>
                                    <tr class="csstr">
                                        <th class="text-center">No</th>
                                        <th class="text-center">DOCUMENTO</th>
                                        <th class="text-center">DESTINATARIO</th>
                                        <th class="text-center">ASUNTO</th>
                                        <th class="text-center">CREACION</th>
                                        <th class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody class="vrespuesta"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>