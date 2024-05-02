
<div class="col-lg-8">
    <h3>Datos del documento</h3>
            {!! Form::hidden('turnar', null, ['id'=>'turnar', 'placeholder'=>'',  'class'=>'form-control']) !!}
            {!! Form::hidden('enviado', null, ['id'=>'enviado', 'placeholder'=>'',  'class'=>'form-control']) !!}
            <div class="m-b-md"></div>                
            <div class="form-group">
                <label class="col-sm-3 control-label">Dependencia / Organismo*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-building"></span></span>                        
                        {!! Form::select('id_dependencia', $dependencias, null, ['id' => 'id_dependencia', 'style'=>'width: 100%;', 'class' => 'form-control select2-single ']) !!} 
                    </div>
                    <label id="el-id_dependencia" class="error hidden" for="id_dependencia"></label>
                </div>
            </div>

            <div class="hr-line-dashed"></div>


            <div  class="form-group">
                <label class="col-sm-3 control-label">Remitente*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user"></span></span>  
                        {!! Form::text('remitente', null, ['id'=>'remitente', 'placeholder'=>'Nombre del remitente...',  'class'=>'form-control']) !!}
                    </div>
                    <label id="el-remitente" class="error hidden" for="remitente"></label>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
     
            <div class="form-group">
                <label class="col-sm-3 control-label">Cargo*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-sticky-note"></span></span>
                        {!! Form::select('id_cargo', $cargos, null, ['id' => 'id_cargo', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}                         
                    </div>
                    <label id="el-id_cargo" class="error hidden" for="id_cargo"></label>
                </div>
            </div>
            
            <div class="hr-line-dashed"></div>  

            <div class="form-group">
                <label class="col-sm-3 control-label">Tipo de documento*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-sticky-note"></span></span>
                        {!! Form::select('id_tipo_documento', $tipos_documentos, null, ['id' => 'id_tipo_documento', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}                         
                    </div>
                    <label id="el-id_tipo_documento" class="error hidden" for="id_tipo_documento"></label>
                </div>
            </div>
            
            <div class="hr-line-dashed"></div>                

            

            <div class="form-group">
                <label class="col-sm-3 control-label">Núm. del documento*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-hashtag"></span></span>
                        {!! Form::text('numero', null, ['id'=>'numero', 'placeholder'=>'',  'class'=>'form-control']) !!}                           
                    </div>
                    <label id="el-numero" class="error hidden" for="numero"></label>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Fecha del documento*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>                        
                        {!! Form::text('fecha', null, ['id'=>'fecha', 'placeholder'=>'',  'class'=>'form-control datepicker']) !!}                           
                    </div>
                    <label id="el-fecha" class="error hidden" for="fecha"></label>
                </div>
            </div>

            <div class="hr-line-dashed"></div>   

           <div class="form-group">
                <label class="col-sm-3 control-label">Destinatario*</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-send"></span></span>                        
                        {!! Form::select('id_destinatario', $destinatarios, null, ['id' => 'id_destinatario', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}                          
                    </div>
                    <label id="el-id_destinatario" class="error hidden" for="id_destinatario"></label>
                </div>
            </div>

            <div class="hr-line-dashed"></div>                              

            <div class="form-group">
                <label class="col-sm-3 control-label">Observaciones</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-align-justify"></span></span>
                        {!! Form::text('observacion', null, ['id'=>'observacion', 'placeholder'=>'',  'class'=>'form-control']) !!}                           
                    </div>
                    <label id="el-observacion" class="error hidden" for="observacion"></label>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-sm-3 control-label">Tipo de entrada</label>
                <div class="col-sm-9">
                    <div>
                        <label> 
                            <input type="radio" class="i-checks" @if($check==1) checked="" @endif value="1" id="id_tipo_entrada" name="id_tipo_entrada"> Asignación directa
                        </label>
                    </div>
                    <div>
                        <label> 
                            <input type="radio" class="i-checks" @if($check==2) checked="" @endif value="2" id="id_tipo_entrada" name="id_tipo_entrada"> Conocimiento
                        </label> 
                    </div>                   
                </div>
            </div> 

                    
       
    	
</div>



<div class="col-lg-4">
    <h3>Adjuntar archivos</h3>

            {!! Form::file('files[]', ['id'=>'filer_input', 'placeholder'=>'', 'multiple'=>'multiple',  'class'=>'form-control']); !!}

            @if(isset($datos))
                @if($errors->any())
                     <?php print_r(Request::old('files')); ?>
                @endif
                <?php $i=1; ?>            
                @foreach($doctos as $d)
                    @if($d->id<>"")

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
                                                <span>Tamaño: {{$d->id}}</span>
                                                <span>Tipo: {{$d->extension}}</span>
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
            @endif




</div>