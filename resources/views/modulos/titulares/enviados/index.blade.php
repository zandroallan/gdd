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
                                <a href="javascript: void(0);">Enviada</a>
                            </li>
                            <li class="breadcrumb-item active">listado</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <!-- <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Documentación enviada</h4>
                    </div> -->
                    <div class="card-body">
                        <div class="table-responsive _response"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bs-example-modal-lg mdl-show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Begin-modal -->
                        <div class="_destinatarios"></div>
                            
                        <div class="_anexos"></div>
                        <!-- End - modal -->
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1 align-middle"></i> Cerrar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js')

        <script src="{{ asset('velzon/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
        <!-- Js Personales -->
        <script src="{{ asset('js/modulos/titulares/enviados.js') }}"></script> 

    @endsection