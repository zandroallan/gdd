    <?php $route_nam = Route::currentRouteName();  print_r($route_nam); ?>

    <ul class="nav" id="side-menu">

        <li class="menu-title">
            <a href="index.html"> <span class="nav-label"><span class="fa fa-home"></span> Inicio</span></a>
        </li>

        <li class="@if($route_nam=='coo.principal.index' || $route_nam=='coo.oficialia.edit') active @endif">
            {!! html_entity_decode(link_to_route('coo.principal.index', '<span class="fa fa-eraser"></span> Borradores</a>', null, ['class'=>'sub-menu'])) !!}
        </li> 


        <li class="menu-title">
            <a href="#" aria-expanded="false"> 
                <span class="fa arrow-right"></span>
                <span class="nav-label"><span class="fa fa-inbox"></span> Recibidos</span>                            
            </a>
        </li>
        
 
        <li class="@if($route_nam=='coo.principal.index' || $route_nam=='coo.oficialia.edit') active @endif">
            {!! html_entity_decode(link_to_route('coo.principal.index', '<span class="fa fa-envelope"></span> Principal</a>', null, ['class'=>'sub-menu'])) !!}
        </li> 
  

        <li class="menu-title">
            <a href="#" aria-expanded="false"> 
                <span class="fa arrow-right"></span>
                <span class="nav-label"><span class="fa fa-send"></span> Enviados</span>                            
            </a>
        </li> 

        <li class="@if($route_nam=='coo.principal.index' || $route_nam=='coo.oficialia.edit') active @endif">
            {!! html_entity_decode(link_to_route('coo.principal.index', '<span class="fa fa-envelope-o"></span> Principal</a>', null, ['class'=>'sub-menu'])) !!}
        </li>    

    </ul>