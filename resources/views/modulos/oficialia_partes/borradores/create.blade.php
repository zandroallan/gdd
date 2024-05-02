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
@endsection

@section('breadcrumb')
    <li class="">{!! html_entity_decode(link_to_route($current_route.'.index', 'Inicio',  [],['class'=>''])) !!}</li>
    <li class="active"><span>Nuevo documento</span></li>
@endsection

@section('buttons') 
    {!! Form::button('<i class="fa fa-send"></i> Enviar', ['id'=>'btn-enviar', 'name' => 'btn-enviar','class' => 'btn btn-primary btn-sm btn-enviar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Enviar']) !!}

    {!! Form::button('<i class="fa fa-eraser"></i> Guardar en borradores', ['id'=>'btn-borradores', 'name' => 'btn-borradores', 'class' => 'btn btn-primary btn-sm btn-borradores', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar en borradores']) !!} 

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
    {!! Form::open(['route' => 'oop.borradores.store', 'method' => 'POST' , 'files' => true, 'id' => 'myform', 'name'=>'myform', 'class' => 'form-horizontal myform', 'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8'], ['role' => 'form']) !!}        
        @include('modulos.oficialia_partes.borradores.form')
    {!! Form::close() !!}
@endsection
