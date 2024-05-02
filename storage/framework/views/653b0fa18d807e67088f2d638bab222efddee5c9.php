    <?php $__env->startSection('meta'); ?>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <?php $__env->stopSection(); ?>
   
   <?php $__env->startSection('css'); ?>

        <?php echo Html::style('template/vendor/select2-3.5.2/select2.css');; ?> 
        <?php echo Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css');; ?>

        <?php echo Html::style('template/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css');; ?>

        <?php echo Html::style('template/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');; ?>

        
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
        
        <?php echo Html::script('template/vendor/select2-3.5.2/select2.min.js');; ?>

        <?php echo Html::script('template/vendor/moment/moment.js');; ?>

        <?php echo Html::script('template/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js');; ?>

        <?php echo Html::script('template/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');; ?> 
        <?php echo Html::script('js/sweetalert2-7.33.1/sweetalert2.js');; ?>

        <?php echo Html::script('js/modulos/titulares/bitacoras.create.js');; ?>  
        
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('breadcrumb'); ?>

        <li class=""><?php echo html_entity_decode(link_to_route($current_route.'.index', 'Inicio',  [],['class'=>''])); ?></li>
        <li class="active"><span>Nueva bitacora</span></li>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('buttons'); ?>       
        
        <?php echo Form::button('<i class="fa fa-save"></i> Guardar', ['id'=>'btn-guardar','class' => 'btn btn-info btn-sm btn-guardar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar']); ?>


        <?php echo html_entity_decode(link_to_route($current_route.'.index', '<i class="fa fa-arrow-left"></i> Atrás',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Atrás', 'class'=>'btn btn-default btn-sm'])); ?> 

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

	   <?php echo Form::open(['route' => $current_route.'.store', 'method' => 'POST' , 'files' => true,  'name'=>'myform', 'class' => 'form-horizontal myform'], ['role' => 'form']); ?>

            
            <?php echo Form::hidden('id', null, ['id' => 'id']); ?>


            <?php echo $__env->make('modulos.titulares.bitacoras.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        <?php echo Form::close(); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>