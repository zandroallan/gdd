@extends('layouts.app')

    @section('css')

    	{!! Html::style('template/vendor/summernote/dist/summernote.css'); !!} 
        {!! Html::style('template/vendor/summernote/dist/summernote-bs3.css'); !!} 
        {!! Html::style('template/vendor/select2-3.5.2/select2.css'); !!} 
    	{!! Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css'); !!}
    	{!! Html::style('template/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css'); !!}
    	{!! Html::style('template/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'); !!}
        {!! Html::style('js/filer/css/jquery.filer.css'); !!}

    @endsection

    @section('js')
        
        @include('tools.sign_js');
        {!! Html::script('template/vendor/summernote/dist/summernote.min.js'); !!}
        {!! Html::script('template/vendor/select2-3.5.2/select2.min.js'); !!}
    	{!! Html::script('template/vendor/moment/moment.js'); !!}
    	{!! Html::script('template/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js'); !!}
    	{!! Html::script('template/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); !!} 
        {!! Html::script('js/sweetalert2-7.33.1/sweetalert2.js'); !!}
        {!! Html::script('js/filer/js/jquery.filer.js'); !!}
        {!! Html::script('js/modulos/titulares/borradores.create.js'); !!}
        
    @endsection

    @section('breadcrumb')

        <li class="">{!! html_entity_decode(link_to_route($current_route.'.index', 'Inicio',  [],['class'=>''])) !!}</li>
        <li class="active"><span>Nuevo documento</span></li>

    @endsection


    @section('buttons') 
        
        {!! Form::button('<i class="fa fa-send"></i> Enviar', ['id'=>'btnmodal','class' => 'btn btn-primary btn-sm',  'type' => 'button']) !!}
        
        {!! Form::button('<i class="fa fa-save"></i> Guardar', ['id'=>'btn-guardar','class' => 'btn btn-primary btn-sm btn-guardar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar']) !!}

        <a id="btnvista" class="btn btn-primary btn-sm" onclick="open_pdf()" target="_blank">
            <i class="pe-7s-search"></i> Vista Preliminar
        </a>
        
        {!! html_entity_decode(link_to_route($current_route.'.index', '<i class="fa fa-arrow-left"></i> Atrás',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Atrás', 'class'=>'btn btn-default btn-sm'])) !!}

    @endsection


    @section('scripts')

        $('.summernote').summernote({
            height: 150,
            focus: false,
            oninit: function() {},
            onChange: function(contents, $editable) {},
        });

        $(".select2-single").select2();
        $(".select2-multiple").select2({ allowClear: true });
        $('.datepicker').datepicker({
        	format: 'dd/mm/yyyy',
        	todayHighlight: true,
        	autoclose: true,
    	});

    @endsection


    @section('content')

        {!! Form::model($respuesta, array('route'=>$current_route.'.store', 'method'=>'POST', 'files'=>true,  'name'=>'myform', 'class'=>'form-horizontal myform'), array('role'=>'form')) !!}
            {!! Form::hidden('id', null, ['id' => 'id']) !!}
            {!! Form::hidden('sended_at', null, ['id' => 'sended_at']) !!}
            {!! Form::hidden('txtsignature', null, ['id' => 'txtsignature', 'name'=>'txtsignature']) !!}
            {!! Form::hidden('txtsecuencie', null, ['id' => 'txtsecuencie', 'name'=>'txtsecuencie']) !!}
            {!! Form::hidden('txtserie', null, ['id' => 'txtserie', 'name'=>'txtserie']) !!}
            {!! Form::hidden('txtsignedDate', null, ['id' => 'txtsignedDate', 'name'=>'txtsignedDate']) !!}
            @include('modulos.titulares.revisiones.form')
        {!! Form::close() !!}

    @endsection
