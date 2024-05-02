
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

                                

                                <!-- 
                                <li class="nav-main-heading">
                                    Heading
                                </li>
                                <li class="nav-main-item">
                                    <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu" data-toggle="submenu" href="#">
                                        <i class="nav-main-link-icon si si-puzzle">
                                        </i>
                                        <span class="nav-main-link-name">
                                            Dropdown
                                        </span>
                                    </a>
                                    <ul class="nav-main-submenu">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" href="javascript:void(0)">
                                                <span class="nav-main-link-name">
                                                    Link #1
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" href="javascript:void(0)">
                                                <span class="nav-main-link-name">
                                                    Link #2
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                                <!-- <li class="nav-main-heading">
                                    Extra
                                </li>
                                <li class="nav-main-item ms-lg-auto">
                                    <a aria-expanded="false" aria-haspopup="true" class="nav-main-link nav-main-link-submenu" data-toggle="submenu" href="#">
                                        <i class="nav-main-link-icon fa fa-brush">
                                        </i>
                                        <span class="nav-main-link-name d-lg-none">
                                            Themes
                                        </span>
                                    </a>
                                    <ul class="nav-main-submenu nav-main-submenu-right">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" data-theme="default" data-toggle="theme" href="#">
                                                <i class="nav-main-link-icon fa fa-square text-default">
                                                </i>
                                                <span class="nav-main-link-name">
                                                    Default
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" data-theme="assets/css/themes/amethyst.min.css" data-toggle="theme" href="#">
                                                <i class="nav-main-link-icon fa fa-square text-amethyst">
                                                </i>
                                                <span class="nav-main-link-name">
                                                    Amethyst
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" data-theme="assets/css/themes/city.min.css" data-toggle="theme" href="#">
                                                <i class="nav-main-link-icon fa fa-square text-city">
                                                </i>
                                                <span class="nav-main-link-name">
                                                    City
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" data-theme="assets/css/themes/flat.min.css" data-toggle="theme" href="#">
                                                <i class="nav-main-link-icon fa fa-square text-flat">
                                                </i>
                                                <span class="nav-main-link-name">
                                                    Flat
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" data-theme="assets/css/themes/modern.min.css" data-toggle="theme" href="#">
                                                <i class="nav-main-link-icon fa fa-square text-modern">
                                                </i>
                                                <span class="nav-main-link-name">
                                                    Modern
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" data-theme="assets/css/themes/smooth.min.css" data-toggle="theme" href="#">
                                                <i class="nav-main-link-icon fa fa-square text-smooth">
                                                </i>
                                                <span class="nav-main-link-name">
                                                    Smooth
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>