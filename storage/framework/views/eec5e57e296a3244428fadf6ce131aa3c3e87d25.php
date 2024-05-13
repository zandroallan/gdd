    <?php $__env->startSection('css'); ?>

        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/buttons.dataTables.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/responsive.bootstrap.min.css')); ?>" />

    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('content'); ?>
        
       

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