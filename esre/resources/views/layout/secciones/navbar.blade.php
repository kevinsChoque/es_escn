<nav class="main-header navbar navbar-expand navbar-white navbar-light py-0">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item border-right border-left ml-2 tcvPmsNavbar">
            <a class="nav-link nb1" href="{{url('solicitud/solicitud')}}" title="Listar Solicitudes">
                <i class="fa fa-list d-none d-sm-inline-block"></i>
                <span class="description-text">SOL</span>
            </a>
        </li> -->
        <!-- <li class="nav-item border-right tcvPmsNavbar">
            <a class="nav-link nb2" href="{{url('factibilidad/factibilidad')}}" title="Listar Factibilidad">
                <i class="fa fa-list d-none d-sm-inline-block"></i>
                <span class="description-text">FAC</span>
            </a>
        </li>
        <li class="nav-item border-right tcvPmsNavbar">
            <a class="nav-link nb3" href="{{url('medicion/medicion')}}" title="Listar Medicion">
                <i class="fa fa-list d-none d-sm-inline-block"></i>
                <span class="description-text">MED</span>
            </a>
        </li>
        <li class="nav-item border-right tcvPmsNavbar">
            <a class="nav-link nb4" href="#" title="Registrar Presupuesto" onclick="showCuadroPresupuestal();">
                <i class="fas fa-plus d-none d-sm-inline-block"></i>
                <span class="description-text">PRE</span>
            </a>
        </li>
        <li class="nav-item border-right tcvPmsNavbar">
            <a class="nav-link nb5" href="{{url('doc/doc')}}" title="Listar Contratos">
                <i class="fa fa-list d-none d-sm-inline-block"></i>
                <span class="description-text">CON</span>
            </a>
        </li> -->
    </ul>
    
    <a href="" class="m-auto">
        <!-- <h3 class="m-0">@yield('nombreContenido')</h3> -->
    </a>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge" style="font-size: 60%;">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <!-- <img src="https://adminlte.io/themes/v3/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            Elsa Suarez
                            <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                            </h3>
                            <p class="text-sm">Reclamo por consumo elevado</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 4 horas</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <!-- <img src="https://adminlte.io/themes/v3/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            Jainor Montes
                            <!-- <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span> -->
                            </h3>
                            <p class="text-sm">Roptura de tuberia</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 1 horas</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <!-- <img src="https://adminlte.io/themes/v3/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                            Juan Gonzales
                            <!-- <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span> -->
                            </h3>
                            <p class="text-sm">Medidor dañado</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 66 minutos</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Ver todos los reclamos ingresados por web.</a>
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link ocultarTextIzqNameUser" href="#" title="">
                <i class="fa fa-circle-user fa-lg"></i>
                
            </a>
        </li> -->
        <li class="nav-item dropdown">
            <a class="nav-link nameNavbar" data-toggle="dropdown" href="#" aria-expanded="false" title="">
                <i class="fa fa-circle-user fa-lg"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;min-width: 20rem; display: none;">
                <a href="#" class="dropdown-item">
                    <div class="media mb-2">
                        <img src="https://yt3.ggpht.com/ytc/AMLnZu-CkHfe_d5oAVhWMfn4e8Ul-COm3yptlLyR1sFCNQ=s900-c-k-c0x00ffffff-no-rj" alt="User Avatar" class="img-size-50 img-circle m-auto">
                    </div>
                    <div class="media-body">
                        <p class="text-center nameLastNavbar">nombre apellido</p>
                        <p class="text-center">
                            <span class="text-sm text-muted">Usuario registrado el <span class="dateRegNavbar"></span></span>
                        </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-item">
                    <!-- <a href="{{url('pdf/Manual-de-Usuario-v1-SIACI.pdf')}}" target="_blank" class="btn btn-sm btn-warning w-100 mb-1"><i class="fa fa-book"></i> Manual de usuario</a> -->
                    <div class="media">
                        <div class="media-body">
                            <a href="#" class="btn btn-info btn-sm float-left"><i class="fa fa-house-user fa-sm"></i> Perfil</a>
                            <button class="btn btn-info btn-sm float-right"><i class="fa fa-arrow-right-from-bracket fa-sm"></i> Cerrar Sesion</button>
                            <!-- <a href="#" class="btn btn-info btn-sm float-right logout">
                                <i class="fa fa-arrow-right-from-bracket fa-sm"></i>
                                Cerrar Sesion
                            </a> -->
                        </div>
                    </div>
                </div>
                <!-- <a href="#" class="dropdown-item">
                </a> -->
            </div>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<script>
    pmsNavbarEntidad(['infraccion','tcv']);
    function pmsNavbarEntidad(listEnt)
    {
        for (let i = 0; i < listEnt.length; i++) 
        {
            if(!localStorage.getItem("pms").includes(listEnt[i]+'/registrar'))
            {
                $('.'+listEnt[i]+'PmsNavbar').remove();
            }
        }
    }
    var userNavbar = JSON.parse(localStorage.getItem("userStart"));
    $('.nameLastNavbar').html(userNavbar.nombre+ ' '+userNavbar.apellido);
    $('.nameNavbar').append(userNavbar.nombre);
    $('.dateRegNavbar').html(userNavbar.fechaRegistro);
</script>
@yield('cabecera')