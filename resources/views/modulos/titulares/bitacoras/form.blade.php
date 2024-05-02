
    @section('scripts')

        $(".select2-single").select2();       
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    @endsection

    <div class="hpanel hred">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
            REGISTRO DE BITACORA
        </div>
        <div class="panel-body">      
            
            <div class="form-group row" id="vfecha_documento">
                <label class="col-sm-2 control-label" for="fecha_documento">Fecha Documento *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-date"></i></span>
                        {!! Form::text('fecha_documento', null, ['id' => 'fecha_documento', 'placeholder'=>'dd/mm/yyyy', 'class' =>  'form-control datepicker']) !!}
                    </div>
                    <label id="el-numero" class="error hidden" for="numero"></label>
                </div>
            </div>

            <div class="form-group row" id="vid_tipo_documento">
                <label class="col-sm-2 control-label" for="id_tipo_documento">Tipo de documento *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                        {!! Form::select('id_tipo_documento', $id_tipos_documentos, null, ['id' => 'id_tipo_documento', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}
                    </div>
                    <label id="el-numero" class="error hidden" for="numero"></label>
                </div>
            </div>
            <div class="form-group row" id="vid_dependencia">
                <label class="col-sm-2 control-label" for="id_dependencia">Organismo/Dependencia *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                        {!! Form::select('id_dependencia', $id_dependencia, null, ['id' => 'id_dependencia', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']) !!}
                    </div>
                    <label id="el-numero" class="error hidden" for="numero"></label>
                </div>
            </div>
            
            <div class="form-group row" id="vdestinatario">
                <label class="col-sm-2 control-label" for="folio">Numero de folio *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                        {!! Form::text('folio', null, ['id' => 'folio', 'placeholder'=>'Numero de folio del documento', 'class' =>  'form-control']) !!}
                    </div>
                    <label id="el-numero" class="error hidden" for="numero"></label>
                </div>
            </div>

            <div class="form-group row" id="vdestinatario">
                <label class="col-sm-2 control-label" for="destinatario">Destinatario *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                        {!! Form::text('destinatario', null, ['id' => 'destinatario', 'placeholder'=>'Destinatario documento', 'class' =>  'form-control']) !!}
                    </div>
                    <label id="el-numero" class="error hidden" for="numero"></label>
                </div>
            </div>

            <div class="form-group row" id="vcargo_destinatario">
                <label class="col-sm-2 control-label" for="cargo_destinatario">Cargo Destinatario *</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                        {!! Form::text('cargo_destinatario', null, ['id' => 'cargo_destinatario', 'placeholder'=>'Cargo del destinatario', 'class' =>  'form-control']) !!}
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

        </div>
    </div>