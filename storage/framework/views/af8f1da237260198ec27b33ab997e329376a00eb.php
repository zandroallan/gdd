    
    <?php $__env->startSection('css'); ?>
        
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/buttons.dataTables.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('velzon/libs/datatables/css/responsive.bootstrap.min.css')); ?>" />

        <?php echo Html::style('template/vendor/select2-3.5.2/select2.css');; ?> 
        <?php echo Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css');; ?>

        <?php echo Html::style('template/vendor/footable/css/footable.standalone.min.css');; ?>

        <?php echo Html::style('template/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css');; ?>

        <?php echo Html::style('template/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');; ?>


    <?php $__env->stopSection(); ?>

   
    <?php $__env->startSection('buttons'); ?>

        

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        $('#urgente').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            })

        $(".select2-multiple").select2({ allowClear: true });
        <?php if( $acuse == 1 ): ?>
            $('#btnacusar').hide();
            $('#btnresponder').show();
            $('#btnreturnar').show();
            $('#btnconcluir').show();
        <?php else: ?>
            $('#btnresponder').hide();
            $('#btnreturnar').hide();
            $('#btnconcluir').hide();
        <?php endif; ?>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
           
        <?php

            $vid_=0;
            if ( $tipo == 0) $vid_=$respuesta->id;
            if (($tipo == 2) || ($tipo == 3))   $vid_=$respuesta->id_documento_interno;
            if ( $tipo == 7) $vid_=$respuesta->id;
            if ( $tipo == 100) $vid_=$respuesta->id;

        ?>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Documentación recibida</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Recibida</a>
                            </li>
                            <li class="breadcrumb-item active">detalles</li>
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

                            <button class="btn btn-soft-info" id="btnacusar" onclick="acusar('<?php echo e($respuesta->id); ?>')">
                                <span class="fa fa-thumbs-up"></span> Acusar
                            </button>
                            <?php if(($tipo != 0) && ($tipo != 7)): ?>
                            <button class="btn btn-soft-primary" id="btnresponder" onclick="responder('<?php echo e($respuesta->id); ?>')">
                                <span class="fa fa-commenting"></span> Responder
                            </button>
                            <?php endif; ?>
                            <button class="btn btn-soft-warning" id="btnreenviar" data-toggle="modal" data-target="#mdlreturnar">
                                <span class="fa fa-random"></span> 
                                <?php if(Auth::User()->id_area != 4): ?>
                                    Returnar
                                <?php else: ?>
                                    Turnar
                                <?php endif; ?>
                            </button>       
                            <?php if($tipo == 7): ?>
                            <button class="btn btn-soft-success" id="btnconcluir" data-toggle="modal" data-target="#mdlconcluir">
                                <span class="fa fa-gavel"></span> Concluir
                            </button>
                            <?php endif; ?>

                            <a href="<?php echo e(route($current_route.'.index')); ?>" class="btn btn-soft-dark">
                                <i class="ri-arrow-go-back-line"></i> Atras
                            </a>

                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <input type="hidden" name="id" id="id" value="<?php echo $vid_; ?>">

                        <!-- Begin encabezado -->
                        <div class="text-center">
                            <h3>
                                <?php if($tipo==7): ?>
                                    <?php echo $respuesta->folio; ?>

                                <?php else: ?>
                                    <?php echo $respuesta->numero; ?>

                                <?php endif; ?>
                            </h3>
                            <p class="mb-0 text-muted">
                                Fecha enviado: 
                                <?php if(isset($respuesta->sended_at)): ?>
                                    <?php echo $respuesta->sended_at; ?>

                                <?php else: ?>
                                    <?php echo $respuesta->created_at; ?>

                                <?php endif; ?>
                            </p>
                        </div>
                        <!-- end encabezado -->

                        <!-- Begin destinatarios -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            Destinatario (s):
                            <ul class="list-group list-group-flush">
                            <?php if($respuesta->id_tipo_documento==3): ?>
                                <?php $vi=1; ?>
                                <?php $__currentLoopData = json_decode($respuesta->destinatario); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vcargo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $vcoma=', ';
                                        $vflCargos=\App\Http\Models\Catalogos\C_Cargo::findOrFail($vcargo); 
                                        if($vi >= count(json_decode($respuesta->destinatario))) $vcoma=' ';
                                    ?>
                                    <li class="list-group-item">
                                        <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> <?php echo $vflCargos->nombre; ?> <?php echo $vcoma; ?>

                                    </li">
                                   <?php ++$vi; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php if(count($destinatarios) > 0): ?>
                                    <?php $__currentLoopData = $destinatarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destinatario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($destinatario->id_tipo_envio == 1): ?>
                                        <li class="list-group-item">
                                            <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                            <?php echo $destinatario->responsable_area; ?> <small class="text-muted">.- <?php echo $destinatario->area_responsable; ?> </small>
                                        </li">
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            </ul>
                        </div>
                        <!-- End destinatarios -->

                        <!-- Begin contenido -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            <h5 class="fs-14"> <?php echo $respuesta->asunto; ?> </h5>
                            <?php if($tipo==0): ?>
                                <?php echo $respuesta->observacion; ?>

                            <?php endif; ?>
                            <?php if($tipo==7): ?>
                                <?php echo $respuesta->indicaciones; ?>

                            <?php else: ?>
                                <h4> <?php echo $respuesta->asunto; ?> </h4>
                                <?php echo $respuesta->cuerpo; ?>

                            <?php endif; ?>
                        </div>
                        <!-- End Contenido -->

                        <!-- Begin atentamente -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            Atentamente:                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                    <?php echo $respuesta->responsable_area; ?> <small class="text-muted">.- <?php echo $respuesta->area_responsable; ?></small>
                                </li> 
                            </ul>
                        </div>
                        <!-- End atentamente -->

                        <!-- Begin anexos -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            <h6 class="fs-14">
                                <span class="badge badge-label bg-warning"><?php echo e(count($anexos)); ?></span> Anexos Existentes
                            </h6>
                            <?php if( count($anexos) > 0 ): ?>                       
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $anexos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anexo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <i class="bx bx-paperclip"></i> <?php echo $anexo->nombre; ?>

                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>                        
                            <?php endif; ?>
                        </div>
                        <!-- End anexos -->

                        <!-- Begin acuses -->
                        <div class="pt-3 border-top border-top-dashed mt-4" id="vdestinos"></div>
                        <!-- End acuses -->

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>



        

        <!-- Modal Returnado -->
        <div class="modal fade" id="mdlreturnar" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $respuesta->numero; ?></h5>
                        <small class="font-bold"><?php echo $respuesta->asunto; ?></small>
                    </div>
                    <div class="modal-body">
                        <?php echo Form::open(['route' => $current_route.'.returnar', 'method' => 'POST' , 'files' => true,  'name'=>'myform', 'class' => 'form-horizontal myform', 'enctype'=>'multipart/form-data'], ['role' => 'form']); ?>

                        
                        <input type="hidden" name="id_tipo_documento" id="id_tipo_documento" value="<?php echo e($tipo); ?>">
                        <!-- Es documentacion interna Memorandum, Circular -->
                        

                        <?php if(($tipo==2) || ($tipo==3)): ?>           
                            <input type="hidden" name="id_documento" id="id_documento" value="<?php echo e($respuesta->id_documento_interno); ?>">
                        <?php endif; ?>
                        <?php if($tipo==0): ?>
                            <input type="hidden" name="id_documento" id="id_documento" value="<?php echo e($respuesta->id); ?>">
                        <?php endif; ?>


                        <?php if(isset( $folio->id )): ?>
                            <input type="hidden" name="id_folio" value="<?php echo e($folio->id); ?>">
                        <?php endif; ?>

                        <div class="form-group row" id="vid_destinatario">
                            <label class="col-sm-2 control-label" for="id_destinatario">Destinatario</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                                    <?php echo Form::select('id_destinatario[]', $turnado, null, ['id' => 'id_destinatario[]', 'style'=>'width: 100%;', 'class' =>  'form-control select2-multiple', 'multiple'=>'multiple']); ?>

                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>                            
                        <div class="form-group row" id="vasunto">
                            <label class="col-sm-2 control-label" for="asunto">Asunto</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                                    <?php echo Form::text('indicaciones', null, ['id' => 'indicaciones', 'placeholder'=>'Indicaciones turnado', 'class' =>  'form-control']); ?>

                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        <!-- Codigo cuando sea coordinación -->
                        <?php if(Auth::User()->id_area == 4): ?>
                        <div class="form-group row" id="vfecha_vencimiento">
                            <label class="col-sm-2 control-label" for="fecha_vencimiento">Vencimiento</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('fecha_vencimiento', null, ['id' => 'fecha_vencimiento', 'placeholder'=>'dd/mm/yyyy', 'class' =>  'form-control datepicker']); ?>

                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="vurgente">
                            <label class="col-sm-2 control-label" for="urgente">Urgente</label>
                            <div class="col-sm-10">
                                <div class="input-group">                                    
                                    <input type="checkbox" id="urgente" name="urgente" value="1">
                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>                        

                        <?php endif; ?>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary" id="btnreturnar">
                            <span class="fa fa-random"></span> 
                            <?php if(Auth::User()->id_area != 4): ?>
                                Returnar
                            <?php else: ?>
                                Turnar
                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Conclucion -->
        <div class="modal fade" id="mdlconcluir" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $respuesta->folio; ?></h5>
                        <small class="font-bold"><?php echo $respuesta->asunto; ?></small>
                    </div>
                    <div class="modal-body">
                        <?php echo Form::open(['route' => $current_route.'.concluir', 'method' => 'POST' , 'files' => true,  'name'=>'myform_concluir', 'class' => 'form-horizontal myform_concluir', 'enctype'=>'multipart/form-data'], ['role' => 'form']); ?>

                       
                        <?php if(isset( $folio->id )): ?>
                            <input type="hidden" name="id_folio" value="<?php echo e($folio->id); ?>">
                        <?php endif; ?>
                                                  
                        <div class="form-group row" id="vinforme">
                            <label class="col-sm-2 control-label" for="informe">Informe</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                                    <?php echo Form::text('informe', null, ['id' => 'informe', 'placeholder'=>'Informe conclusion', 'class' =>  'form-control']); ?>

                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary" id="btnconcluir_folio">
                            <span class="fa fa-random"></span> Concluir
                        </button>
                    </div>
                </div>
            </div>
        </div>


    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
        
        <script src="<?php echo e(asset('velzon/libs/datatables/js/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.responsive.min.js')); ?>"></script>
        <script src="<?php echo e(asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js')); ?>"></script>

        <?php echo Html::script('template/vendor/select2-3.5.2/select2.min.js');; ?>

        <?php echo Html::script('template/vendor/moment/moment.js');; ?>  
        <?php echo Html::script('template/vendor/footable/js/footable.js');; ?>

        <?php echo Html::script('template/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js');; ?>

        <?php echo Html::script('template/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');; ?>

        <?php echo Html::script('template/vendor/iCheck/icheck.min.js');; ?>

        <?php echo Html::script('js/general.js');; ?>

        <?php echo Html::script('js/modulos/titulares/recibidos.show.js');; ?>

        
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>