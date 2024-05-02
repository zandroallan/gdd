@extends('layouts.app')

@section('css')
    {!! Html::style('template/vendor/select2-3.5.2/select2.css'); !!} 
    {!! Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css'); !!}
    {!! Html::style('template/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css'); !!}
    {!! Html::style('template/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'); !!}
    {!! Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css'); !!}  
    {!! Html::style('js/filer/css/jquery.filer.css'); !!}       
@endsection

@section('js')
    {!! Html::script('template/vendor/select2-3.5.2/select2.min.js'); !!}
    {!! Html::script('template/vendor/moment/moment.js'); !!}
    {!! Html::script('template/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js'); !!}
    {!! Html::script('template/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); !!} 
    {!! Html::script('js/sweetalert2-7.33.1/sweetalert2.js'); !!}   
    {!! Html::script('js/general-file.js'); !!}
    {!! Html::script('js/modulos/oficialia_partes/asignacion_directa.js'); !!} 
    {!! Html::script('js/filer/js/jquery.filer.js'); !!} 
    {!! Html::script('js/anexos.js'); !!}  
@endsection

@section('breadcrumb')
    <li class="">{!! html_entity_decode(link_to_route($current_route.'.index', 'Inicio',  [],['class'=>''])) !!}</li>
    <li class="active"><span>Ver documento</span></li>
@endsection

@section('buttons') 

    {!! Form::button('<i class="fa fa-eraser"></i> Modificar', ['id'=>'btn-actualizar', 'name' => 'btn-actualizar', 'class' => 'btn btn-primary btn-sm btn-actualizar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Modificar']) !!}




    {!! html_entity_decode(link_to_route($current_route.'.index', '<i class="fa fa-arrow-left"></i> Atrás',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Atrás', 'class'=>'btn btn-default btn-sm'])) !!}      
@endsection

@section('scripts')  
    $(".select2-single").select2();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
    });
    $('#filer_input').filer({
        allowDuplicates: false,
        limit: 6,
        maxSize: 15,
        extensions: ["ods", "odt","jpg", "jpge", "png", "xls", "xlsx", "ppt", "odt", "pptx", "docx", "doc", "pdf", "zip", "rar"],
        showThumbs: true,
        addMore: true  
    });     
@endsection

@section('content')

<h3>Datos del documento</h3>
    <div class="hpanel email-compose ">
        <div class="border-top border-left border-right bg-light">
            <div class="p-m">
                <div>
                    <span class="font-extra-bold">Dependencia / Organismo*: </span>
                    {{ $datos->dependencia }}
                </div>
                <div>
                    <span class="font-extra-bold">Tipo de documento*: </span>
                    <a href="#">example.@email.com</a>
                </div>
                <div>
                    <span class="font-extra-bold">Núm. del documento*: </span>
                    14.10.2016
                </div>
            </div>                      
        </div>
        <div class="panel-body">
           
            <div>
                <h4>Turnar </h4>

                {!! Form::open(['route' => 'oop.borradores.store', 'method' => 'POST' , 'files' => true, 'id' => 'myform', 'name'=>'myform', 'class' => 'form-horizontal myform', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}        
                    @include('modulos.coordinacion.recibidos.principal.oficialia.form-turnar')
                {!! Form::close() !!}

            </div>
        </div>

                    <div class="border-bottom border-left border-right bg-white p-m">
                        <p class="m-b-md">
                            <span><i class="fa fa-paperclip"></i> 3 attachments - </span>
                            <a href="#" class="btn btn-default btn-xs">Download all in zip format <i class="fa fa-file-zip-o"></i> </a>
                        </p>

                        <div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="hpanel">
                                        <div class="panel-body file-body">
                                            <i class="fa fa-file-pdf-o text-info"></i>
                                        </div>
                                        <div class="panel-footer">
                                            <a href="#">Document_2016.doc</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="hpanel">
                                        <div class="panel-body file-body">
                                            <i class="fa fa-file-audio-o text-warning"></i>
                                        </div>
                                        <div class="panel-footer">
                                            <a href="#">Audio_2016.doc</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="hpanel">
                                        <div class="panel-body file-body">
                                            <i class="fa fa-file-excel-o text-success"></i>
                                        </div>
                                        <div class="panel-footer">
                                            <a href="#">Sheets_2016.doc</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="panel-footer text-right">
                        <div class="btn-group">
                            <button class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                            <button class="btn btn-default"><i class="fa fa-arrow-right"></i> Forward</button>
                            <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                            <button class="btn btn-default"><i class="fa fa-trash-o"></i> Remove</button>
                        </div>
                    </div>
                </div>
@endsection
