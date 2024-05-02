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

        <div class="hpanel">
            <div class="panel-heading" style="text-align: left;">                       
                <!-- <h4>Documentos recibidos</h4> -->
                <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
            </div>                    
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="hpanel hred">
                    <div class="panel-body">
                        <ul class="mailbox-list">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-1" id="btn_1">
                                    <i class="fa fa-file-text text-success"></i> Memorandums
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" id="btn_2">
                                    <i class="fa fa-group text-info"></i> Circulares
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3" id="btn_3">
                                    <i class="fa fa-book text-warning"></i> Folios
                                </a>
                            </li> 
                            <li>
                                <a data-toggle="tab" href="#tab-4" id="btn_4">
                                    <i class="fa fa-institution text-danger"></i> Oficialia
                                </a>
                            </li>
                            <?php if(Auth::User()->id_area != 4): ?>
                            <li>
                                <a data-toggle="tab" href="#tab-5" id="btn_5">
                                    <i class="fa fa-random text-danger"></i> Returnados
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div> 

            <div class="col-sm-10">
                <div class="hpanel hred">
                    <div class="tab-content ">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <h3><i class="fa fa-file-text text-success"></i> Memorandums</h3>
                                <div class="table-responsive">                                    
                                    <table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">
                                        <thead>
                                            <tr class="csstr">
                                                <th class="text-center">No</th>
                                                <th class="text-center">NUMERO</th>                                                    
                                                <th class="text-center">REMITENTE</th>
                                                <th class="text-center">ASUNTO</th>
                                                <th class="text-center">RECIBIDO</th>
                                                <th class="text-center">ACUSE</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vrespuesta1"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <h3><i class="fa fa-group text-info"></i> Circulares</h3>
                                <div class="table-responsive project-list">                                    
                                    <table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">
                                        <thead>
                                            <tr class="csstr">
                                                <th class="text-center">No</th>
                                                <th class="text-center">NUMERO</th>                                                    
                                                <th class="text-center">REMITENTE</th>
                                                <th class="text-center">ASUNTO</th>
                                                <th class="text-center">RECIBIDO</th>
                                                <th class="text-center">ACUSE</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vrespuesta2"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <h3><i class="fa fa-book text-warning"></i> Folios</h3>
                                <div class="table-responsive project-list">
                                    <table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">
                                        <thead>
                                            <tr class="csstr">
                                                <th class="text-center">No</th>
                                                <th class="text-center">NUMERO</th>                                                    
                                                <th class="text-center">REMITENTE</th>
                                                <th class="text-center">OBSERVACIONES</th>
                                                <th class="text-center">RECIBIDO</th>
                                                <th class="text-center">ACUSE</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vrespuesta3"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                <h3><i class="fa fa-institution text-danger"></i> Oficialia</h3>
                                <div class="table-responsive project-list">
                                    <table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">
                                        <thead>
                                            <tr class="csstr">
                                                <th class="text-center">No</th>
                                                <th class="text-center">NUMERO</th>                                                    
                                                <th class="text-center">REMITENTE</th>
                                                <th class="text-center">OBSERVACIONES</th>
                                                <th class="text-center">RECIBIDO</th>
                                                <th class="text-center">ACUSE</th>
                                                <?php if(Auth::User()->id_area == 4): ?>
                                                <th class="text-center">TURNADO</th>
                                                <?php endif; ?>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vrespuesta4"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php if(Auth::User()->id_area != 4): ?>
                        <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                <h3><i class="fa fa-random text-danger"></i> Returnados</h3>
                                <div class="table-responsive project-list">                                       
                                   <table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">
                                        <thead>
                                            <tr class="csstr">
                                                <th class="text-center">No</th>                                        
                                                <th class="text-center">NUMERO</th>                                        
                                                <th class="text-center">REMITENTE</th>
                                                <th class="text-center">INDICACIONES</th>
                                                <th class="text-center">RECIBIDO</th>
                                                <th class="text-center">ACUSE</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="vrespuesta5"></tbody>
                                    </table>
                               </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
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