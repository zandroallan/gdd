@extends('layouts.app')
    
    @section('css')

        {!! Html::style('template/vendor/footable/css/footable.standalone.min.css'); !!}  

    @endsection
    

    @section('js')

        {!! Html::script('template/vendor/moment/moment.js'); !!}  
        {!! Html::script('template/vendor/footable/js/footable.js'); !!}
        {!! Html::script('js/modulos/titulares/enviados.acusados.js'); !!}

    @endsection


    @section('breadcrumb')
        <li class="active"><span>Inicio</span></li>
    @endsection


    @section('content')

            <div class="hpanel">
                <div class="panel-heading" style="text-align: left;">                       
                    <!-- <h4>Documentos enviados</h4> -->
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                </div>                    
            </div>

            <div class="hpanel hred">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1" id="btn_1"> 
                            <i class="fa fa-laptop"></i> Memorandums
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-2" id="btn_2">
                            <i class="fa fa-desktop"></i> Circulares
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-3" id="btn_3">
                            <i class="fa fa-database"></i> Todas
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="table-responsive vrespuesta1"></div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="table-responsive project-list vrespuesta2"></div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                           <div class="table-responsive project-list vrespuesta3"></div>
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


    @endsection