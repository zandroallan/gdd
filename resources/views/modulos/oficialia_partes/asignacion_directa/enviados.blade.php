@extends('layouts.app')
@section('css')
    {!! Html::style('template/vendor/datatables.net-bs/css/dataTables.bootstrap.css'); !!} 

@endsection

@section('js')
    {!! Html::script('js/moment.js'); !!}
    {!! Html::script('template/vendor/datatables/media/js/jquery.dataTables.min.js'); !!}  
    {!! Html::script('template/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js'); !!}
    {!! Html::script('js/general.js'); !!}
    {!! Html::script('js/modulos/oficialia_partes/asignacion_directa.js'); !!}    
@endsection

@section('breadcrumb')
    <li class="active"><span>Inicio</span></li>
@endsection

@section('buttons')
 
@endsection

@section('scripts')  
    dt_default2('{{ URL::route('oop.asignacion-directa.resultados',1) }}', '{{ URL::route('oop.borradores.edit','_') }}');   

    $('#search').on( 'keyup', function () {
        $('.dt_default2').DataTable().search( this.value ).draw();
        var buscar=document.getElementById("search").value;

    } );
@endsection

@section('content')
    <style type="text/css">
      .dataTables_filter { display: none; }
    </style>
	
    {!! Form::open(['route' => [$current_route.'.destroy', 0], 'id'=>'myformdeletei', 'name'=>'myformdeletei','method' => 'DELETE' , 'class' => 'myformdeletei', 'style'=>'display : inline;'], ['role' => 'form']) !!}
    {!! Form::close() !!}
        
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

    <h3>Resultados de la busqueda</h3>
    <div class="hpanel">
        <div class="panel-body">
            <div class="input-group">
                {!! Form::text('search', null, ['id'=>'search', 'placeholder'=>'Buscar documento...',  'class'=>'form-control']) !!}               
                <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <br>            
            <table class="dt_default table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th width="120px">Núm. documento</th>
                        <th>Dependencia/Organismo</th>
                        <th>Destinatario</th>
                        <th width="150px" align="center">Fecha del documento</th>
                        <th width="100px" align="center">Fecha de envío</th>
                        <th width="50px" align="center">Acuse</th>
                        <th width="30px" align="center"></th>
                    </tr>
                </thead>
                <tbody id='dt_default'>
                </tbody>
            </table>

        </div>
    </div>    



@endsection
