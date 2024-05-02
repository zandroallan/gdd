    <?php $route_nam = Route::currentRouteName();  /*print_r($route_nam);*/ ?>

    <ul class="nav" id="side-menu">

        <li class="menu-title">
            <a href="index.html"> <span class="nav-label">Inicio</span></a>
        </li>

        <li class="@if($route_nam=='oop.borradores.create') active @endif">
            {!! html_entity_decode(link_to_route('oop.borradores.create', '<span class="fa fa-certificate"></span> Nuevo documento</a>', null, ['class'=>'sub-menu'])) !!}
        </li> 

        <li class="@if($route_nam=='oop.borradores.index' || $route_nam=='oop.borradores.edit') active @endif">
            {!! html_entity_decode(link_to_route('oop.borradores.index', '<span class="fa fa-eraser"></span> Borradores</a>', null, ['class'=>'sub-menu'])) !!}
        </li> 

        <li class="menu-title">
            <a href="#" aria-expanded="false"> 
                <span class="fa arrow-right"></span>
                <span class="nav-label">Asignación directa</span>                            
            </a>
        </li>
        
 
        <li class="@if($route_nam=='oop.enviados.index' || $route_nam=='oop.enviados.create' || $route_nam=='oop.enviados.edit') active @endif">
            {!! html_entity_decode(link_to_route('oop.enviados.index', '<span class="fa fa-send"></span> Enviados</a>', null, ['class'=>'sub-menu'])) !!}
        </li> 
        <li class="@if($route_nam=='oop.acusados.index' || $route_nam=='oop.acusados.create' || $route_nam=='oop.acusados.edit') active @endif">
            {!! html_entity_decode(link_to_route('oop.acusados.index', '<span class="fa fa-check-square"></span> Acusados</a>', null, ['class'=>'sub-menu'])) !!}
        </li>  

        <li class="menu-title">
            <a href="#" aria-expanded="false"> 
                <span class="fa arrow-right"></span>
                <span class="nav-label">Conocimiento</span>                            
            </a>
        </li> 

        <li class="@if($route_nam=='oopc.enviados.index' || $route_nam=='oop.enviados.create' || $route_nam=='oopc.enviados.edit') activec @endif">
            {!! html_entity_decode(link_to_route('oopc.enviados.index', '<span class="fa fa-send"></span> Enviados</a>', null, ['class'=>'sub-menu'])) !!}
        </li> 
        <li class="@if($route_nam=='oopc.acusados.index' || $route_nam=='oopc.acusados.create' || $route_nam=='oopc.acusados.edit') activec @endif">
            {!! html_entity_decode(link_to_route('oopc.acusados.index', '<span class="fa fa-check-square"></span> Acusados</a>', null, ['class'=>'sub-menu'])) !!}
        </li>  

    </ul>