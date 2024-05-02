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
    {!! Html::script('js/modulos/coordinacion/recibidos/principal.js'); !!}
    {!! Html::script('js/filer/js/jquery.filer.js'); !!} 
    {!! Html::script('js/anexos.js'); !!}  
@endsection

@section('breadcrumb')
    <li class="">{!! html_entity_decode(link_to_route($current_route.'.index', 'Inicio',  [],['class'=>''])) !!}</li>
    <li class="active"><span>Editar documento</span></li>
@endsection

@section('buttons') 

    @if($datos->acuse==null)
        {!! Form::button('<i class="fa fa-gavel"></i> Acusar de recibido', ['id'=>'btn-acusar', 'name' => 'btn-acusar', 'class' => 'btn btn-info btn-sm btn-acusar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Turnar', 'onclick'=>'acusar_oficialia("http://localhost/sgdv2/coordinacion/recibidos/principal/oficialia/'.$datos->id.'/acusar",2)']) !!}

    @endif

    {!! Form::button('<i class="fa fa-rotate-right"></i> Iniciar folio', ['id'=>'btn-turnar', 'name' => 'btn-turnar', 'class' => 'btn btn-primary2 btn-sm btn-turnar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Crear folio']) !!}

    {!! Form::button('<i class="fa fa-eraser"></i> Modificar', ['id'=>'btn-actualizar', 'name' => 'btn-actualizar', 'class' => 'btn btn-primary btn-sm btn-actualizar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Modificar']) !!}


    {!! html_entity_decode(link_to_route('coo.principal.index', '<i class="fa fa-arrow-left"></i> Atrás',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Atrás', 'class'=>'btn btn-default btn-sm'])) !!}      
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
    {!! Form::open(['route' => ['anexos.destroy', 0], 'id'=>'myformdeleteanexo', 'name'=>'myformdeleteanexo','method' => 'DELETE' , 'class' => 'myformdeleteanexo', 'style'=>'display : inline;'], ['role' => 'form']) !!}
    {!! Form::close() !!}

<div class="hpanel">
    <div class="panel-heading">
        <span class="pull-right">
            <i class="fa fa-clock-o"> </i> Recibido: {{ $datos->fecha_envio }}&nbsp;&nbsp;
            <?php $cll=""; ?>
            @if($datos->acuse==null)
                <?php $cll="hidden"; ?>
            @endif
            <span id="lbl_acuse" class="{{ $cll }}"><i class="fa fa-gavel"> </i> Acusado: <span id="lbl_vacuse" class="text-success"> {{ $datos->acuse }} </span></span>
          
        </span>
    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#tab-1" aria-expanded="true"> <i class="fa fa-archive"></i> Datos del documento 

            <span id="tb1error" class="badge badge-danger hidden">!</span></a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#tab-2" aria-expanded="false"><i class="fa fa-rotate-right"></i> Iniciar folio 
            <span id="tb2error" class="badge badge-danger hidden">!</span></a> 
        </li>
    </ul>
    {{ Form::model($datos, array('route' => $current_route.'.store', 'method' => 'POST' , 'files' => true, 'id' => 'myform', 'name'=>'myform', 'class' => 'form-horizontal myform',  'enctype'=>'multipart/form-data', 'accept-charset'=>'UTF-8' ), array('role' => 'form')) }}
    <div class="tab-content">
        
        <div id="tab-1" class="tab-pane active">
            <div class="panel-body">                
                {!! Form::hidden('id', null, ['id'=>'id']) !!}                  
                @include('modulos.coordinacion.recibidos.principal.oficialia.form')                
            </div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="panel-body">
                @include('modulos.coordinacion.recibidos.principal.oficialia.form-turnar')
            </div>
        </div>
        
    </div>
    {!! Form::close() !!}
</div>




@endsection
