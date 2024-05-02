<?php
    $route_nam = Route::currentRouteName();
    /*
    <ul class="nav" id="side-menu">

        <li class="">
            <a href="index.html"> <span class="nav-label">Inicio</span></a>
        </li>
        <li class="">
            <a href="#" aria-expanded="false">
                <span class="fa arrow-right"></span>
                <span class="nav-label">Asignación directa</span>
            </a>
        </li>

        <li class="@if($route_nam=='oop.borradores.index' || $route_nam=='oop.borradores.create' || $route_nam=='oop.borradores.edit') active @endif">
            {!! html_entity_decode(link_to_route('oop.borradores.index', '<span class="fa fa-eraser"></span> Borradores</a>', null, ['class'=>'sub-menu'])) !!}
        </li>
        <li class="@if($route_nam=='oop.enviados.index' || $route_nam=='oop.enviados.create' || $route_nam=='oop.enviados.edit') active @endif">
            {!! html_entity_decode(link_to_route('oop.enviados.index', '<span class="fa fa-send"></span> Enviados</a>', null, ['class'=>'sub-menu'])) !!}
        </li>
        <li class="@if($route_nam=='oop.acusados.index' || $route_nam=='oop.acusados.create' || $route_nam=='oop.acusados.edit') active @endif">
            {!! html_entity_decode(link_to_route('oop.acusados.index', '<span class="fa fa-check-square"></span> Acusados</a>', null, ['class'=>'sub-menu'])) !!}
        </li>
    </ul>
    */
?>

    <ul class="nav" id="side-menu">
        <li class="">
            <a href="#"> <span class="nav-label">Inicio</span></a>
        </li>
        <li class="">
            <a href="{{ asset('titular/borradores') }}">
                <i class="fa fa-eraser text-danger"></i>
                <span class="nav-label">Borradores</span>
            </a>
        </li>
        <li class="">
            <a href="{{ asset('titular/revisiones') }}">
                <i class="fa fa-search text-danger"></i>
                <span class="nav-label">Revisiones</span>
            </a>
        </li>
        <li class="active">
            <a href="#" aria-expanded="true">                
                <span class="nav-label">Enviadas</span>
                <span class="fa arrow"></span>
            </a>

            <ul class="nav nav-second-level collapse in" aria-expanded="true" style="">
                <li>
                    <a href="{{ asset('titular/enviados') }}">
                        <i class="fa fa-send text-danger"></i>
                        <span class="nav-label"> Enviados</span>
                    </a>
                </li>
                <!-- <li><a href="{{ asset('titular/enviados/acusados') }}"><span class="fa fa-check-square"></span> Acusados</a></li> -->
            </ul>
        </li>
        <li class="active">
            <a href="#" aria-expanded="true">
                <span class="nav-label">Recibidas</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse in" aria-expanded="true" style="">
                <li>
                    <a href="{{ asset('titular/recibidos') }}">
                        <i class="fa fa-inbox text-danger"></i>
                        <span class="nav-label"> Recibidos</span>
                    </a>
                </li>
                <!-- <li><a href="{{ asset('titular/recibidos/copias') }}"><span class="fa fa-check-square"></span> Copias</a></li> -->
                <!-- <li><a href="{{ asset('titular/recibidos/acusados') }}"><span class="fa fa-check-square"></span> Acusados</a></li> -->
            </ul>
        </li>
        <li class="">
            <a href="{{ asset('titular/bitacoras') }}"> 
                <i class="fa fa-list text-danger"></i>
                <span class="nav-label"> Bitacoras</span>
            </a>
        </li>
    </ul>
