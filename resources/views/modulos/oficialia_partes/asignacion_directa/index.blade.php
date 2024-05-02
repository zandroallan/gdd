@extends('layouts.app')

@section('js')
    {!! Html::script('template/vendor/datatables/media/js/jquery.dataTables.min.js'); !!}  
    {!! Html::script('template/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js'); !!}
    {!! Html::script('js/general.js'); !!}
    {!! Html::script('js/modulos/oficialia_partes/asignacion_directa.js'); !!}    
@endsection

@section('breadcrumb')
    <li class="active"><span>Inicio</span></li>
@endsection

@section('buttons')
    {!! html_entity_decode(link_to_route($current_route.'.create', '<i class="fa fa-plus-square"></i> Nuevo documento',  [],['data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Nuevo registro', 'class'=>'btn btn-primary btn-sm'])) !!}    
@endsection

@section('scripts')  
    dt_default('{{ URL::route($current_route.'.resultados',1) }}', '{{ URL::route($current_route.'.edit','_') }}');      
@endsection

@section('content')
	<h3>Resultados de la busqueda</h3>
	<div class="row">
		<div class="col-lg-12">
			<div class="hpanel">
				<div class="panel-body">
					<div class="input-group">
						<input class="form-control" type="text" placeholder="Número de documento..">
						<div class="input-group-btn">
						    <button class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

    <table class="dt_default table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Núm. documento</th>
                <th>Dependencia/Organismo</th>
                <th>Fecha</th>
                <th width="20px"></th>
            </tr>
        </thead>
        <tbody id='dt_default'>
        </tbody>
    </table>

@endsection
