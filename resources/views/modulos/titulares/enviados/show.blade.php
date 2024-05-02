@extends('layouts.app')
    
    @section('css')

        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/buttons.dataTables.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/responsive.bootstrap.min.css') }}" />

    @endsection

    @section('content')

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Documentación enviada</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Enviados</a>
                            </li>
                            <li class="breadcrumb-item active">detalle</li>
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
                        <div class="hstack gap-3 flex-wrap">
                            <div class="text-muted">No documento: 
                                <span class="text-body fw-medium">
                                    @if(Auth::User()->id_area == 4)
                                        {!! $respuesta->folio !!}
                                    @else
                                        {!! $respuesta->numero !!}
                                    @endif
                                </span>
                            </div>
                            <div class="vr"></div>
                            <div class="text-muted">Fecha enviado:
                                <span class="text-body fw-medium">
                                    @if( $internos )
                                        {!! $respuesta->sended_at !!}
                                    @else
                                        {!! $respuesta->created_at !!}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Begin destinatarios -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            Destinatario (s):
                            <div class="live-preview">
                                <ul class="list-group list-group-flush">
                                    @if($respuesta->id_tipo_documento==3)
                                    <?php
                                        $vciclo=1;
                                        $vtotalEnviados=count(json_decode($respuesta->destinatario));
                                        foreach(json_decode($respuesta->destinatario) as $vcargo) {
                                            $vflCargos=\App\Http\Models\Catalogos\C_Cargo::search(['id'=>$vcargo])->get();
                                            foreach($vflCargos as $vflCargo) {
                                                $vcomaTexto='';
                                                if ( $vtotalEnviados > $vciclo ) {
                                                    $vcomaTexto=', ';
                                                }
                                                $html ='';
                                                $html.='<li class="list-group-item">';
                                                $html.='    <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>'. $vflCargo->nombre . $vcomaTexto;
                                                $html.='</li">';
                                                
                                                echo $html;
                                                ++$vciclo;
                                            }
                                        }
                                    ?>                            
                                    @else
                                        @if ( count($destinatarios) > 0 )
                                            @foreach ( $destinatarios as $destinatario )
                                                @if ( $destinatario->id_tipo_envio == 1 )
                                                    <li class="list-group-item">
                                                        <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                                        {!! $destinatario->responsable_area !!} <small class="text-muted">.- {!! $destinatario->area_responsable !!}</small>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <!-- End destinatarios -->
                       
                        <!-- Begin contenido -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            <h5 class="fs-14"> {!! $respuesta->asunto !!} </h5>
                            @if(empty($respuesta->cuerpo))
                                {!! $respuesta->indicaciones !!}
                            @else
                                {!! $respuesta->cuerpo !!}
                            @endif
                        </div>
                        <!-- End Contenido -->

                        <!-- Begin atentamente -->
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            Atentamente: 
                            <div class="live-preview">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <i class="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                        {!! $respuesta->responsable_area !!} <small class="text-muted">.- {!! $respuesta->area_responsable !!}</small>
                                    </li> 
                                </ul>
                            </div>
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
                        <div class="mt-4 text-muted border-top border-top-dashed pt-3">
                            <h5 class="mb-3">LISTADO DE ACUSES</h5>
                            <table class="table align-middle table-nowrap mb-0" width="100%">
                                <thead>
                                    <th>VISTO</th>
                                    <th>TIPO</th>
                                    <th>AREA/RESPONSABLE</th>
                                    <th>ACUSE</th>
                                </thead>
                                <tbody>
                                @if(count($destinatarios) > 0)
                                    @foreach($destinatarios as $destinatario)
                                    <?php
                                        $vvisto='ri-checkbox-blank-line';
                                        $vacuse='Sin acusar';
                                        if ($destinatario->es_nuevo == 0) $vvisto='ri-checkbox-line';
                                        if ($destinatario->acuse != null) $vacuse=$destinatario->acuse;
                                    ?>
                                    <tr>
                                        <td><i class="{{ $vvisto }}"></i></td>
                                        <td><span class="badge badge-label bg-info">ORIGINAL</span></td>
                                        <td>
                                            {!! $destinatario->responsable_area !!} <br /><strong> {!! $destinatario->area_responsable !!} </strong>
                                        </td>
                                        <td>{!! $vacuse !!}</td>
                                    </tr>
                                    @endforeach
                                @endif

                                @if(count($copias) > 0)
                                    @foreach($copias as $copia)
                                    <?php
                                        $vvisto='ri-checkbox-blank-line';
                                        $vacuse='Sin acusar';
                                        if ($copia->es_nuevo == 0) $vvisto='ri-checkbox-line';
                                        if ($copia->acuse != null) $vacuse=$copia->acuse;
                                    ?>
                                    <tr>
                                        <td><i class="{{ $vvisto }} "></i></td>
                                        <td><span class="badge badge-label bg-info">ORIGINAL</span></td>
                                        <td>
                                            {!! $copia->responsable_area !!} <br /><strong> {!! $copia->area_responsable !!} </strong>
                                        </td>              
                                        <td>{!! $vacuse !!}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- End acuses -->
                    </div>
                    <div class="col-md-1"></div>
                </div>

            </div>
        </div>

    @endsection

    @section('js')

        <script src="{{ asset('velzon/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js') }}"></script>

    @endsection


    @section('script')

        $('._enviado').addClass('active');
        configTableBasic('table', false);
        
    @endsection