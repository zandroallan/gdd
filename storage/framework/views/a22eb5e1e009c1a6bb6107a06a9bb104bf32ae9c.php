<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    
    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="<?php echo e(asset('velzon/images/user.jpg')); ?>" alt=".">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text"><?php echo e(Auth::User()->nombre); ?></span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text">
                        <i class="ri ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle text-success">Activo</span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Bienvenido <?php echo e(Auth::User()->nickname); ?></h6>
            <a class="dropdown-item" href="pages-profile.html">
                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Mi perfil</span>
            </a>
            <!-- <a class="dropdown-item" href="apps-chat.html">
                <i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Messages</span>
            </a>
            <a class="dropdown-item" href="apps-tasks-kanban.html">
                <i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Taskboard</span>
            </a>
            <a class="dropdown-item" href="pages-faqs.html">
                <i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Help</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile.html">
                <i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Balance : <b>$5971.67</b></span>
            </a>
            <a class="dropdown-item" href="pages-profile-settings.html">
                <span class="badge bg-success-subtle text-success mt-1 float-end">New</span>
                <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Settings</span>
            </a>
            <a class="dropdown-item" href="auth-lockscreen-basic.html">
                <i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Lock screen</span>
            </a> -->
            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle" data-key="t-logout">Cerrar sesión</span>
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?>

            </form>    
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
               <li class="nav-item">
                    <a class="nav-link menu-link _inicio" href="<?php echo e(url('/')); ?>" aria-expanded="false">
                        <i class="ri-home-4-fill"></i> <span data-key="t-widgets">Inicio</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link _por_enviar" href="<?php echo e(url('titular/borradores')); ?>" aria-expanded="false">
                        <i class="ri-eraser-line"></i> 
                        <span data-key="t-widgets">Por enviar</span>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link menu-link _enviado" href="<?php echo e(url('titular/enviados')); ?>" aria-expanded="false">
                        <i class="ri-mail-send-line"></i> 
                        <span data-key="t-widgets">Enviados</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link _recibido" href="<?php echo e(url('titular/recibidos')); ?>" aria-expanded="false">
                        <i class="ri-stack-line"></i> 
                        <span data-key="t-widgets">Recibidos</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link _bitacora" href="<?php echo e(url('titular/bitacoras')); ?>" aria-expanded="false">
                        <i class="ri-file-list-3-fill"></i> 
                        <span data-key="t-widgets">Bitacoras</span>
                    </a>
                </li>
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>