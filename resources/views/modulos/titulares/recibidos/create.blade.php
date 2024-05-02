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
        <li class="active"><span>Respuesta {!! $documento_interno->folio !!}</span></li>

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
        
        <div class="hpanel email-compose">
            <div class="panel-heading hbuilt">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="font-light m-b-xs"> {!! $documento_interno->folio !!} </h3>
                        <small> {!! $documento_interno->asunto !!} </small><br />
                        <small>
                            <strong>{!! $documento_interno->responsable_area !!}.- </strong> 
                            {!! $documento_interno->responsable_area !!} 
                        </small>    
                    </div>
                </div>
            </div>
        </div>
        

        {!! Form::open(['route' => $current_route.'.store', 'method' => 'POST' , 'files' => true,  'name'=>'myform', 'class' => 'form-horizontal myform', 'enctype'=>'multipart/form-data'], ['role' => 'form']) !!}
            {!! Form::hidden('id', null, ['id' => 'id']) !!}
            {!! Form::hidden('id_documento_interno', $documento_interno->id, ['id' => 'id_documento_interno']) !!}
            {!! Form::hidden('id_documento_aux', $documento_interno->id_documento_aux, ['id' => 'id_documento_aux']) !!}

            {!! Form::hidden('sended_at', null, ['id' => 'sended_at']) !!}
            {!! Form::hidden('txtsignature', null, ['id' => 'txtsignature', 'name'=>'txtsignature']) !!}
            {!! Form::hidden('txtsecuencie', null, ['id' => 'txtsecuencie', 'name'=>'txtsecuencie']) !!}
            {!! Form::hidden('txtserie', null, ['id' => 'txtserie', 'name'=>'txtserie']) !!}
            {!! Form::hidden('txtsignedDate', null, ['id' => 'txtsignedDate', 'name'=>'txtsignedDate']) !!}
            

            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                    RESPUESTA A {!! $documento_interno->folio !!}
                </div>
                <div class="panel-body">      
         
                    <div class="form-group row" id="vid_tipo_documento">
                        <label class="col-sm-2 control-label" for="id_tipo_documento">Tipo de documento *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                                {!! Form::select('id_tipo_documento', $tipos_documentos, null, ['id' => 'id_tipo_documento', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}
                            </div>
                            <label id="el-numero" class="error hidden" for="numero"></label>
                        </div>
                    </div>
                    <div class="form-group row" id="vid_destinatario">
                        <label class="col-sm-2 control-label" for="id_destinatario">Destinatario *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                                {!! Form::select('id_destinatario[]', $destinatarios, null, ['id' => 'id_destinatario[]', 'style'=>'width: 100%;', 'class' =>  'form-control select2-multiple', 'multiple'=>'multiple']) !!}
                            </div>
                            <label id="el-numero" class="error hidden" for="numero"></label>
                        </div>
                    </div>
                    <div class="form-group row" id="vccp">
                        <label class="col-sm-2 control-label" for="ccp">Copias </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-users"></i></span>
                                {!! Form::select('ccp[]', $destinatarios, null, ['id' => 'ccp[]', 'style'=>'width: 100%;', 'class' =>  'form-control select2-multiple', 'multiple'=>'multiple']) !!}
                            </div>
                            <label id="el-numero" class="error hidden" for="numero"></label>
                        </div>
                    </div>           
                    <div class="form-group row" id="vasunto">
                        <label class="col-sm-2 control-label" for="asunto">Asunto *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                                {!! Form::text('asunto', null, ['id' => 'asunto', 'placeholder'=>'Asunto del documento', 'class' =>  'form-control']) !!}
                            </div>
                            <label id="el-numero" class="error hidden" for="numero"></label>
                        </div>
                    </div>
                    <div class="form-group row" id="vcuerpo">
                        <label class="col-sm-2 control-label" for="cuerpo">Contenido *</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::textarea('cuerpo', null, ['id'=>'cuerpo', 'class'=>'form-control summernote']) !!}
                            </div>
                            <label id="el-numero" class="error hidden" for="numero"></label>
                        </div>
                    </div>


                    <div class="form-group row" id="vadjunto">
                        <label class="col-sm-2 control-label" for="adjunto">Adjuntar archivos</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                 {!! Form::file('files[]', ['id'=>'filer_input', 'placeholder'=>'', 'multiple'=>'multiple',  'class'=>'form-control']); !!}

                                <?php $i=1; ?>            
                                @foreach($documentos as $d)
                                    @if($d->id != "")

                                    <div class="jFiler-items jFiler-row">
                                        <ul class="jFiler-items-list jFiler-items-default">
                                            <li class="jFiler-item" data-jfiler-index="0" style="">
                                                <div class="jFiler-item-container">
                                                    <div class="jFiler-item-inner">
                                                        <div class="jFiler-item-icon pull-left">
                                                            <i class="icon-jfi-file-o jfi-file-type-application jfi-file-ext-pdf"></i>
                                                        </div>
                                                        <div class="jFiler-item-info pull-left">
                                                            <div class="jFiler-item-title" title="PDF de prueba 2.pdf">
                                                                {!! html_entity_decode(link_to_route('anexos.descarga', $d->nombre , $d->id, [])) !!}
                                                            </div>
                                                            <div class="jFiler-item-others">
                                                                <span>Tamaño: {{ $d->id }}</span>
                                                                <span>Tipo: {{ $d->extension }}</span>
                                                                <span class="jFiler-item-status"></span>
                                                            </div>
                                                            <div class="jFiler-item-assets">
                                                                <ul class="list-inline">
                                                                    <li>
                                                                        <a href='#' title='Eliminar' onclick='destroy_anexo({{ $d->id }})' class="icon-jfi-trash jFiler-item-trash-action"></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>                        
                                    </div>
                                    @endif
                                <?php $i++; ?>
                                @endforeach
                            </div>
                            <label id="el-numero" class="error hidden" for="numero"></label>
                        </div>
                    </div>
                                    
                </div>
            </div>


        {!! Form::close() !!}

    @endsection
