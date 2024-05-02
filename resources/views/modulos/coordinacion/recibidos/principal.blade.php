@extends('layouts.app')
@section('css')
    {!! Html::style('template/vendor/datatables.net-bs/css/dataTables.bootstrap.css'); !!} 

@endsection

@section('js')
    {!! Html::script('js/moment.js'); !!}
    {!! Html::script('template/vendor/datatables/media/js/jquery.dataTables.min.js'); !!}  
    {!! Html::script('template/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js'); !!}
    {!! Html::script('js/general.js'); !!}
    {!! Html::script('js/modulos/coordinacion/recibidos/principal.js'); !!}    
@endsection

@section('breadcrumb')
    <li class="active"><span>Inicio</span></li>
@endsection

@section('buttons')
 
@endsection

@section('scripts')  
    dt_default('{{ URL::route('coo.recibidos.resultados',1) }}', '{{ URL::route('coo.oficialia.edit','_') }}', '{{ URL::route('coo.oficialia.acusar','_') }}');   

    $('#search').on( 'keyup', function () {
        $('.dt_default').DataTable().search( this.value ).draw();
        var buscar=document.getElementById("search").value;
    } );      

@endsection

@section('content')

<style type="text/css">
  .dataTables_filter { display: none; }
</style>
<div class="hpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> <i class="fa fa-desktop"></i> Oficialia</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"><i class="fa fa-laptop"></i> Folios</a> </li>
                <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false"><i class="fa fa-database"></i> Memorandums</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                       @include('modulos.coordinacion.recibidos.result-oficialia')
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        1
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        2
                    </div>
                </div>
            </div>
        </div>

        
    <!--<h3>Busqueda Avanzada</h3>
	<div class="row">
		<div class="col-lg-12">
			<div class="hpanel">
				<div class="panel-body">
					<div class="input-group">
						<input id="search-input" class="form-control" type="text" placeholder="Número de documento..">
						<div class="input-group-btn">
						    <button class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->

  



@endsection
