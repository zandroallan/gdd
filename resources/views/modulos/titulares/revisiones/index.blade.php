@extends('layouts.app')

    @section('css')

        {!! Html::style('template/vendor/footable/css/footable.standalone.min.css'); !!}  

    @endsection

    @section('js')

        {!! Html::script('template/vendor/moment/moment.js'); !!}  
        {!! Html::script('template/vendor/footable/js/footable.js'); !!}  
        {!! Html::script('js/modulos/titulares/revisiones.js'); !!}   

    @endsection

    @section('breadcrumb')
        <li class="active"><span>Inicio</span></li>
    @endsection

    @section('buttons')
        {!! html_entity_decode(link_to_route($current_route.'.create', '<i class="fa fa-plus-square"></i> Nuevo',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Nuevo registro', 'class'=>'btn btn-primary btn-sm'])) !!}    
    @endsection

    @section('scripts')  
        
    @endsection

    @section('content')
    
    <div class="hpanel hred">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
            LISTADO DE REVISIONES
        </div>
        <div class="panel-body">  
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <h3><i class="fa fa-search text-warning"></i> Revisiones</h3>
            <div class="table-responsive">                
                <table class="table table-hover manage-u-table" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="15">
                    <thead>
                        <tr class="csstr">
                            <th class="text-center">No</th>
                            <th class="text-center">DOCUMENTO</th>
                            <th class="text-center">ASUNTO</th>
                            <th class="text-center">CREACION</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody class="vrespuesta"></tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection
