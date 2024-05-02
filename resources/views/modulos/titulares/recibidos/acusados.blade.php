@extends('layouts.app')

    @section('css')

        {!! Html::style('template/vendor/footable/css/footable.standalone.min.css'); !!}  

    @endsection
    
    @section('js')

        {!! Html::script('template/vendor/moment/moment.js'); !!}  
        {!! Html::script('template/vendor/footable/js/footable.js'); !!}
        {!! Html::script('js/modulos/titulares/recibidos.acusados.js'); !!}    
    @endsection

    @section('breadcrumb')
        <li class="active"><span>Inicio</span></li>
    @endsection

    @section('buttons')


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
                DOCUMENTOS ACUSADOS
            </div>
            <div class="panel-body">  
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <div class="table-responsive vrespuesta"></div>
            </div>
        </div>

    @endsection
