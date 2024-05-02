    <?php $__env->startSection('css'); ?>

        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('js/filer/css/jquery.filer.css')); ?>" />

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>


        /*
        $('.summernote').summernote({
            height: 150,
            focus: false,
            oninit: function() {},
            onChange: function(contents, $editable) {},
        });
        */

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
                            <li class="breadcrumb-item active">Nuevo</li>
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

                            <button type="button" class="btn btn-soft-success btn-send">
                                <i class="ri-mail-send-fill"></i> Enviar
                            </button>
                            
                            <button type="button" class="btn btn-soft-info btn-save" target="_blank">
                                <i class="ri-save-2-line"></i> Guardar
                            </button>

                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-preview" onclick="open_pdf()" target="_blank">
                                <i class="ri-search-2-line"></i> Vista Preliminar
                            </a>

                            <a href="<?php echo e(route($current_route.'.index')); ?>" class="btn btn-soft-dark">
                                <i class="ri-arrow-go-back-line"></i> Atras
                            </a>

                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <?php echo Form::open(['route' => $current_route.'.store', 'method' => 'POST' , 'files' => true,  'name'=>'myform', 'id' => 'frm-draft', 'class' => 'form-horizontal myform', 'enctype'=>'multipart/form-data'], ['role' => 'form']); ?>


            <?php echo Form::hidden('id', null, ['id'=> 'id', 'class'=> 'id']); ?>

            <?php echo Form::hidden('sended_at', null, ['id' => 'sended_at']); ?>

            <?php echo Form::hidden('txtsignature', null, ['id' => 'txtsignature', 'name'=>'txtsignature']); ?>

            <?php echo Form::hidden('txtsecuencie', null, ['id' => 'txtsecuencie', 'name'=>'txtsecuencie']); ?>

            <?php echo Form::hidden('txtserie', null, ['id' => 'txtserie', 'name'=>'txtserie']); ?>

            <?php echo Form::hidden('txtsignedDate', null, ['id' => 'txtsignedDate', 'name'=>'txtsignedDate']); ?>


            <?php echo $__env->make('modulos.titulares.borradores.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo Form::close(); ?>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
        
        <script src="<?php echo e(asset('velzon/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>
        <script src="<?php echo e(asset('js/filer/js/jquery.filer.js')); ?>"></script>
        <script src="<?php echo e(asset('js/modulos/titulares/borradores.create.js')); ?>"></script>
        
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>