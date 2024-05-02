
                        <div class="d-none d-lg-block mt-2 mt-lg-0" id="main-navigation">
                            <ul class="nav-main nav-main-dark nav-main-horizontal nav-main-hover">
                                <li class="nav-main-item">
                                    <a class="nav-main-link _inicio" href="{{ route('home') }}">
                                        <i class="nav-main-link-icon si si-home"></i>
                                        <span class="nav-main-link-name">Inicio</span>
                                    </a>
                                </li>

                                @can('usuario-list')
                                <li class="nav-main-item">
                                    <a class="nav-main-link _usuario" href="{{ route('usuarios.index') }}">
                                        <i class="nav-main-link-icon si si-user"></i>
                                        <span class="nav-main-link-name">Usuarios</span>
                                    </a>
                                </li>
                                @endcan

                                @can('rol-list')
                                <li class="nav-main-item">
                                    <a class="nav-main-link _rol" href="{{ route('roles.index') }}">
                                        <i class="nav-main-link-icon far fa-chess-queen"></i>
                                        <span class="nav-main-link-name">Roles</span>
                                    </a>
                                </li>
                                @endcan

                                @can('permiso-list')
                                <li class="nav-main-item">
                                    <a class="nav-main-link _permiso" href="{{ route('permisos.index') }}">
                                        <i class="nav-main-link-icon fa fa-chalkboard-user"></i>
                                        <span class="nav-main-link-name">Permisos</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>