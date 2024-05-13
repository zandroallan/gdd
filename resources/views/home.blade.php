@extends('layouts.app')

    @section('css')

        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/dataTables.bootstrap5.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/buttons.dataTables.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('velzon/libs/datatables/css/responsive.bootstrap.min.css') }}" />

    @endsection


    @section('content')
        
       

    @endsection


    @section('js')

        <script src="{{ asset('velzon/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('velzon/libs/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
        <!-- Js Personales -->
        <script src="{{ asset('js/tools.js') }}"></script>
        <script src="{{ asset('js/modulos/titulares/borradores.js') }}"></script> 

    @endsection