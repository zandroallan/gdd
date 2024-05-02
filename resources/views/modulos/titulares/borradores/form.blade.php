
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Generación de nuevo documento</h4>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <div class="row gy-4">
                                <div class="col-md-12" id="vid_tipo_documento">
                                    <label class="form-label" for="id_tipo_documento">Tipo de documento *</label>
                                    {!! Form::select('id_tipo_documento', $tipos_documentos, null, ['id' => 'id_tipo_documento', 'class' =>  'form-control']) !!}
                                </div> 

                                <div class="col-md-12" id="vid_destinatario">
                                    <label class="form-label" for="id_destinatario">Destinatario *</label>
                                    {!! Form::select('id_destinatario[]', $destinatarios, null, 
                                    [
                                        'id'=> 'id_destinatario[]', 
                                        'class'=> 'form-control', 
                                        'multiple'=> 'multiple'
                                    ]) !!}
                                </div>

                                <!-- Begin: Cuando sea una circular -->
                                <div class="col-md-12" id="vcargos">
                                    <label class="form-label" for="cargos">Cargos *</label>
                                    {!! Form::select('cargos[]', $cargos, null, ['id' => 'cargos[]', 'class' =>  'form-control', 'multiple'=>'multiple']) !!}
                                </div>
                                <!-- End -->

                                <div class="col-md-12" id="vcpp">
                                    <label class="form-label" for="ccp">Copias *</label>
                                    {!! Form::select('ccp[]', $copias, null, ['id' => 'ccp[]', 'class' =>  'form-control', 'multiple'=>'multiple']) !!}
                                </div>

                                <div class="col-md-12" id="vasunto">
                                    <label class="form-label" for="asunto">Asunto *</label>
                                    {!! Form::text('asunto', null, ['id' => 'asunto', 'placeholder'=>'Asunto del documento', 'class' =>  'form-control']) !!}
                                </div>

                                <div class="col-md-12" id="vcuerpo">
                                    <label class="form-label" for="cuerpo">Contenido ducumento *</label>
                                    {!! Form::textarea('cuerpo', null, ['id'=>'cuerpo', 'class'=>'form-control summernote']) !!}
                                </div>

                                <div class="col-md-12" id="vadjunto">
                                    <label class="form-label" for="files">Archivos anexos *</label>                                       
                                    {!! Form::file('files[]', ['id'=>'filer_input', 'placeholder'=>'', 'multiple'=>'multiple',  'class'=>'form-control']); !!}

                                    <?php $i=1; ?>
                                    @foreach($documentos as $d)
                                        @if ( $d->id != "" )

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

                            </div>
                        </div>    
                        <div class="col-lg-1"></div>    
                    </div>
                
                </div>
            </div>
        </div>
    </div>


