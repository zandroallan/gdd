@extends('layouts.app')

    @section('meta')
        <meta name="csrf-token" content="{{csrf_token()}}" />
    @stop
   
   @section('css')

        {!! Html::style('template/vendor/select2-3.5.2/select2.css'); !!} 
        {!! Html::style('template/vendor/select2-bootstrap/select2-bootstrap.css'); !!}
        {!! Html::style('template/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css'); !!}
        {!! Html::style('template/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'); !!}
        
    @endsection

    @section('js')
        
        {!! Html::script('template/vendor/select2-3.5.2/select2.min.js'); !!}
        {!! Html::script('template/vendor/moment/moment.js'); !!}
        {!! Html::script('template/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js'); !!}
        {!! Html::script('template/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); !!} 
        {!! Html::script('js/sweetalert2-7.33.1/sweetalert2.js'); !!}
        {!! Html::script('js/modulos/titulares/bitacoras.create.js'); !!}  
        
    @endsection

    @section('breadcrumb')

        <li class="">{!! html_entity_decode(link_to_route($current_route.'.index', 'Inicio',  [],['class'=>''])) !!}</li>
        <li class="active"><span>Nueva bitacora</span></li>

    @endsection

    @section('content')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bitacora (Documentación enviada fisicamente)</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Bitacora</a>
                            </li>
                            <li class="breadcrumb-item active">Registro</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="flex-grow-1">

                                {!! Form::button('<i class="fa fa-save"></i> Guardar', ['id'=>'btn-guardar','class' => 'btn btn-info btn-sm btn-guardar', 'type' => 'button', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Guardar']) !!}

                                {!! html_entity_decode(link_to_route($current_route.'.index', '<i class="fa fa-arrow-left"></i> Atrás',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Atrás', 'class'=>'btn btn-default btn-sm'])) !!} 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1 text-center">Generación de nuevo documento</h4>
                    </div>
                    <div class="card-body">
                        
                        {!! Form::open(['route' => $current_route.'.store', 'method' => 'POST' , 'files' => true,  'name'=>'myform', 'class' => 'form-horizontal myform'], ['role' => 'form']) !!}
                
                            {!! Form::hidden('id', null, ['id' => 'id']) !!}

                            @include('modulos.titulares.bitacoras.form')
                            
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

	   
    @stop
