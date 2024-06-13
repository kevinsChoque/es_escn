<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(-45deg,#212c50 50%,#20273e);">
    <a href="#" class="brand-link">
        <img src="{{asset('img/logo.jpg')}}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light ml-5">EMUSAP</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block text-center ocultarTextIzqNameUser nameSidebar" title="nombre apellido">
                    admin user
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{url('home/home')}}" class="nav-link bg-light sba1">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p data-npms="dashboard">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('solicitud/registrar')}}" class="nav-link bg-secondary sba9">
                        <i class="nav-icon fa-solid fa-ruler"></i>
                        <p>Registrar solicitud</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('solicitud/solicitud')}}" class="nav-link bg-secondary sba9">
                        <i class="nav-icon fa-solid fa-ruler"></i>
                        <p>Solicitud de reclamos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('acta/acta')}}" class="nav-link bg-secondary sba9">
                        <i class="nav-icon fa-solid fa-ruler"></i>
                        <p>Actas de inspeccion</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{url('reporte/reporte')}}" class="nav-link bg-secondary sba14">
                        <i class="nav-icon fa-solid fa-clipboard"></i>
                        <p>REPORTES</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="#" class="nav-link bg-secondary sba15 cerrarSesion">
                        <i class="nav-icon fas fa-arrow-right"></i>
                        <p>Cerrar sesion</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<script>
    $('.cerrarSesion').on('click',function(){
        $('.overlayPagina').css("display","none");
        window.location.href = "{{url('home/logout')}}";
    });
    function showCuadroPresupuestal()
    {
        localStorage.setItem("solnro",0);
        window.location.href = "{{url('presupuesto/cuadroPresupuestal')}}";
    }
    smPms();
    var content=false;
    function smPms()
    {
        $('.smPms').each(function(){
            // if($(this).prop('checked'))
            // {
            //     listRol.push($(this).val());
            //     console.log($(this).val());
            // }
            // console.log('nombre de los submenu->'+$(this).find('p').html());

            $(this).find('p').each(function(){
                // console.log($(this).html());
                if(localStorage.getItem("pms").includes($(this).attr('data-npms')))
                {
                    // console.log('si incluye-------------------');
                    $(this).parent().parent().css('display','block');
                    content=true;
                }
                else
                {
                    $(this).parent().parent().css('display','none');
                }
            });
            if(content)
            {
                $(this).css('display',content?'block':'none');
                content=false;
            }
            else
            {
                $(this).remove();
            }
            
            // $(this).css('display',content?'block':'none');
            // content=false;
            console.log('-----------------');
        });
    }
    // alert(JSON.parse(localStorage.getItem("userStart")).id);
    if(JSON.parse(localStorage.getItem("userStart")).id!=1)
    {
        $('.onlyAdmin').remove();
    }
    var userSidebar = JSON.parse(localStorage.getItem("userStart"));
    // $('.nameSidebar').html(userSidebar.nombre+ ' '+userSidebar.apellido);
    $('.sidebarPermisosAdmin').remove();
</script>