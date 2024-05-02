
    <div class="hpanel hred">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
            NUEVO BORRADOR PARA REVISION
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
            <div class="form-group row" id="vid_area_envia">
                <label class="col-sm-2 control-label" for="id_area_envia">Remitente *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                        {!! Form::select('id_area_envia', $remitente, null, ['id' => 'id_area_envia', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}
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
                        {!! Form::select('ccp[]', $copias, null, ['id' => 'ccp[]', 'style'=>'width: 100%;', 'class' =>  'form-control select2-multiple', 'multiple'=>'multiple']) !!}
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
