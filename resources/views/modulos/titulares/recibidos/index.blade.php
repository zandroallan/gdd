@extends('layouts.app')

    @section('css')

        {!! Html::style('template/vendor/footable/css/footable.standalone.min.css'); !!}

    @endsection
    
    @section('js')

        {!! Html::script('template/vendor/moment/moment.js'); !!}  
        {!! Html::script('template/vendor/footable/js/footable.js'); !!}
        {!! Html::script('js/modulos/titulares/recibidos.js'); !!}    
    @endsection

    @section('breadcrumb')
        <li class="active"><span>Inicio</span></li>
    @endsection

    @section('buttons')


    @endsection

    @section('scripts')  
        
    @endsection

    @section('content')


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

<!--         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
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

    @endsection