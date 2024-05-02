@extends('layouts.app')
    
    @section('css')
        
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/buttons.dataTables.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/responsive.bootstrap.min.css') }}" />

        {!! Html::style('template/vendor/select2-3.5.2/select2.css'); !!} 
        {!! Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css'); !!}
        {!! Html::style('template/vendor/footable/css/footable.standalone.min.css'); !!}
        {!! Html::style('template/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css'); !!}
        {!! Html::style('template/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'); !!}

    @endsection

   
    @section('buttons')

        

    @endsection

    @section('scripts')
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        $('#urgente').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            })

        $(".select2-multiple").select2({ allowClear: true });
        @if ( $acuse == 1 )
            $('#btnacusar').hide();
            $('#btnresponder').show();
            $('#btnreturnar').show();
            $('#btnconcluir').show();
        @else
            $('#btnresponder').hide();
            $('#btnreturnar').hide();
            $('#btnconcluir').hide();
        @endif

    @endsection

    @section('content')
           
        <?php

            $vid_=0;
            if ( $tipo == 0) $vid_=$respuesta->id;
            if (($tipo == 2) || ($tipo == 3))   $vid_=$respuesta->id_documento_interno;
            if ( $tipo == 7) $vid_=$respuesta->id;
            if ( $tipo == 100) $vid_=$respuesta->id;

        ?>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Documentación recibida</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Recibida</a>
                            </li>
                            <li class="breadcrumb-item active">detalles</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="flex-grow-1">

                            <button class="btn btn-soft-info" id="btnacusar" onclick="acusar('{{ $respuesta->id }}')">
                                <span class="fa fa-thumbs-up"></span> Acusar
                            </button>
                            @if(($tipo != 0) && ($tipo != 7))
                            <button class="btn btn-soft-primary" id="btnresponder" onclick="responder('{{ $respuesta->id }}')">
                                <span class="fa fa-commenting"></span> Responder
                            </button>
                            @endif
                            <button class="btn btn-soft-warning" id="btnreenviar" data-toggle="modal" data-target="#mdlreturnar">
                                <span class="fa fa-random"></span> 
                                @if(Auth::User()->id_area != 4)
                                    Returnar
                                @else
                                    Turnar
                                @endif
                            </button>       
                            @if($tipo == 7)
                            <button class="btn btn-soft-success" id="btnconcluir" data-toggle="modal" data-target="#mdlconcluir">
                                <span class="fa fa-gavel"></span> Concluir
                            </button>
                            @endif

                            <a href="{{ route($current_route.'.index') }}" class="btn btn-soft-dark">
                                <i class="ri-arrow-go-back-line"></i> Atras
                            </a>

                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <input type="hidden" name="id" id="id" value="{!! $vid_ !!}">

                        <!-- Begin encabezado -->
                        <div class="text-center">
                            <h3>
                                @if($tipo==7)
                                    {!! $respuesta->folio !!}
                                @else
                                    {!! $respuesta->numero !!}
                                @endif
                            </h3>
                            <p class="mb-0 text-muted">
                                Fecha enviado: 
                                @if(isset($respuesta->sended_at))
                                    {!! $respuesta->sended_at !!}
                                @else
                                    {!! $respuesta->created_at !!}
                                @endif
                            </p>
                        </div>
                        <!-- end encabezado -->

                        <!-- Begin destinatarios -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            Destinatario (s):
                            <ul class="list-group list-group-flush">
                            @if($respuesta->id_tipo_documento==3)
                                <?php $vi=1; ?>
                                @foreach(json_decode($respuesta->destinatario) as $vcargo)
                                    <?php
                                        $vcoma=', ';
                                        $vflCargos=\App\Http\Models\Catalogos\C_Cargo::findOrFail($vcargo); 
                                        if($vi >= count(json_decode($respuesta->destinatario))) $vcoma=' ';
                                    ?>
                                    <li class="list-group-item">
                                        <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> {!! $vflCargos->nombre !!} {!! $vcoma !!}
                                    </li">
                                   <?php ++$vi; ?>
                                @endforeach
                            @else
                                @if(count($destinatarios) > 0)
                                    @foreach($destinatarios as $destinatario)
                                        @if($destinatario->id_tipo_envio == 1)
                                        <li class="list-group-item">
                                            <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                            {!! $destinatario->responsable_area !!} <small class="text-muted">.- {!! $destinatario->area_responsable !!} </small>
                                        </li">
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                            </ul>
                        </div>
                        <!-- End destinatarios -->

                        <!-- Begin contenido -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            <h5 class="fs-14"> {!! $respuesta->asunto !!} </h5>
                            @if($tipo==0)
                                {!! $respuesta->observacion !!}
                            @endif
                            @if($tipo==7)
                                {!! $respuesta->indicaciones !!}
                            @else
                                <h4> {!! $respuesta->asunto !!} </h4>
                                {!! $respuesta->cuerpo !!}
                            @endif
                        </div>
                        <!-- End Contenido -->

                        <!-- Begin atentamente -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            Atentamente:                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                    {!! $respuesta->responsable_area !!} <small class="text-muted">.- {!! $respuesta->area_responsable !!}</small>
                                </li> 
                            </ul>
                        </div>
                        <!-- End atentamente -->

                        <!-- Begin anexos -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            <h6 class="fs-14">
                                <span class="badge badge-label bg-warning">{{ count($anexos) }}</span> Anexos Existentes
                            </h6>
                            @if ( count($anexos) > 0 )                       
                            <ul class="list-group list-group-flush">
                                @foreach($anexos as $anexo)
                                <a href="#" class="list-group-item list-group-item-action">
                                    <i class="bx bx-paperclip"></i> {!! $anexo->nombre !!}
                                </a>
                                @endforeach
                            </ul>                        
                            @endif
                        </div>
                        <!-- End anexos -->

                        <!-- Begin acuses -->
                        <div class="pt-3 border-top border-top-dashed mt-4" id="vdestinos"></div>
                        <!-- End acuses -->

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>



        

        <!-- Modal Returnado -->
        <div class="modal fade" id="mdlreturnar" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h5 class="modal-title">{!! $respuesta->numero !!}</h5>
                        <small class="font-bold">{!! $respuesta->asunto !!}</small>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => $current_route.'.returnar', 'method' => 'POST' , 'files' => true,  'name'=>'myform', 'class' => 'form-horizontal myform', 'enctype'=>'multipart/form-data'], ['role' => 'form']) !!}
                        
                        <input type="hidden" name="id_tipo_documento" id="id_tipo_documento" value="{{ $tipo }}">
                        <!-- Es documentacion interna Memorandum, Circular -->
                        

                        @if(($tipo==2) || ($tipo==3))           
                            <input type="hidden" name="id_documento" id="id_documento" value="{{ $respuesta->id_documento_interno }}">
                        @endif
                        @if($tipo==0)
                            <input type="hidden" name="id_documento" id="id_documento" value="{{ $respuesta->id }}">
                        @endif


                        @if(isset( $folio->id ))
                            <input type="hidden" name="id_folio" value="{{ $folio->id }}">
                        @endif

                        <div class="form-group row" id="vid_destinatario">
                            <label class="col-sm-2 control-label" for="id_destinatario">Destinatario</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-ticket"></i></span>
                                    {!! Form::select('id_destinatario[]', $turnado, null, ['id' => 'id_destinatario[]', 'style'=>'width: 100%;', 'class' =>  'form-control select2-multiple', 'multiple'=>'multiple']) !!}
                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>                            
                        <div class="form-group row" id="vasunto">
                            <label class="col-sm-2 control-label" for="asunto">Asunto</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                                    {!! Form::text('indicaciones', null, ['id' => 'indicaciones', 'placeholder'=>'Indicaciones turnado', 'class' =>  'form-control']) !!}
                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        <!-- Codigo cuando sea coordinación -->
                        @if(Auth::User()->id_area == 4)
                        <div class="form-group row" id="vfecha_vencimiento">
                            <label class="col-sm-2 control-label" for="fecha_vencimiento">Vencimiento</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! Form::text('fecha_vencimiento', null, ['id' => 'fecha_vencimiento', 'placeholder'=>'dd/mm/yyyy', 'class' =>  'form-control datepicker']) !!}
                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="vurgente">
                            <label class="col-sm-2 control-label" for="urgente">Urgente</label>
                            <div class="col-sm-10">
                                <div class="input-group">                                    
                                    <input type="checkbox" id="urgente" name="urgente" value="1">
                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>                        

                        @endif
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary" id="btnreturnar">
                            <span class="fa fa-random"></span> 
                            @if(Auth::User()->id_area != 4)
                                Returnar
                            @else
                                Turnar
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Conclucion -->
        <div class="modal fade" id="mdlconcluir" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="color-line"></div>
                    <div class="modal-header">
                        <h5 class="modal-title">{!! $respuesta->folio !!}</h5>
                        <small class="font-bold">{!! $respuesta->asunto !!}</small>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => $current_route.'.concluir', 'method' => 'POST' , 'files' => true,  'name'=>'myform_concluir', 'class' => 'form-horizontal myform_concluir', 'enctype'=>'multipart/form-data'], ['role' => 'form']) !!}
                       
                        @if(isset( $folio->id ))
                            <input type="hidden" name="id_folio" value="{{ $folio->id }}">
                        @endif
                                                  
                        <div class="form-group row" id="vinforme">
                            <label class="col-sm-2 control-label" for="informe">Informe</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="pe-7s-news-paper"></i></span>
                                    {!! Form::text('informe', null, ['id' => 'informe', 'placeholder'=>'Informe conclusion', 'class' =>  'form-control']) !!}
                                </div>
                                <label id="el-numero" class="error hidden" for="numero"></label>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary" id="btnconcluir_folio">
                            <span class="fa fa-random"></span> Concluir
                        </button>
                    </div>
                </div>
            </div>
        </div>


    @endsection

    @section('js')
        
        <script src="{{ asset('velzon/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

        {!! Html::script('template/vendor/select2-3.5.2/select2.min.js'); !!}
        {!! Html::script('template/vendor/moment/moment.js'); !!}  
        {!! Html::script('template/vendor/footable/js/footable.js'); !!}
        {!! Html::script('template/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js'); !!}
        {!! Html::script('template/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); !!}
        {!! Html::script('template/vendor/iCheck/icheck.min.js'); !!}
        {!! Html::script('js/general.js'); !!}
        {!! Html::script('js/modulos/titulares/recibidos.show.js'); !!}
        
    @endsection