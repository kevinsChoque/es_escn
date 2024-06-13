@extends('layout.layout')
@section('nombreContenido', '----')
@section('cabecera')
<div class="main-header p-1">
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12 m-auto">
            <h6 class="my-0 ml-3">Listar solicitudess</h6>
        </div>
        <div class="col-lg-6 col-sm-6 col-12">
            <a href="{{url('solicitud/registrar')}}" class="btn btn-sm btn-success float-right">
                <i class="fa fa-plus"></i> 
                Nueva Solicitud
            </a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 contenedorFormulario">
            <div class="card">
                <!-- <div class="overlay dark overlayRegistros">
                    <img src="{{asset('img/imgAdicionales/spinerLetter.svg')}}" class="svgLoadLetter">
                </div> -->
                <div class="overlay overlayRegistros">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
                <div class="card-header border-transparent py-2">
                    <h3 class="card-title m-0 font-weight-bold"><i class="fa fa-file"></i> Listar solicitudes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning msjPms" style="display: none;">
                        <p class="m-0 font-weight-bold font-italic">El usuario no cuenta con el acceso a registros.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive contenedorRegistros" style="display: none;">
                            <table id="registros" class="table table-hover table-striped table-bordered dt-responsive nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="2">Titular</th>
                                        <th class="text-center" data-priority="2">Representante</th>
                                        <th class="text-center" data-priority="2">Contacto</th>
                                        <th class="text-center" data-priority="1">Reclamo</th>
                                        <th class="text-center" data-priority="1">Fecha</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <!-- <tfoot class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="2">Num.Sol.</th>
                                        <th class="text-center" data-priority="2">Dni</th>
                                        <th class="text-center" data-priority="2">Nombre</th>
                                        <th class="text-center" data-priority="1">Direccion</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var tablaDeRegistros;
    var flip=0;
    $(document).ready( function () {
        tablaDeRegistros=$('.contenedorRegistros').html();
        $('.overlayPagina').css("display","none");
        fillRegistros();
    } );
    function ver()
    {
        window.location.href = "{{url('solicitud/ver')}}";
    }
    function fillRegistros()
    {
        $('.contenedorRegistros').css('display','block');
        jQuery.ajax(
        { 
            url: "{{url('solicitud/listar')}}",
            method: 'get',
            success: function(r){
                console.log(r.data);
                var html = '';
                for (var i = 0; i < r.data.length; i++) 
                {
                    html += '<tr class="text-center">' +
                        '<td class="align-middle">' + dataTit(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + dataRep(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + dataCon(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].descripcionr) + '</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].fr) + '</td>' +
                        '<td class="align-middle">' +
                            '<div class="btn-group btn-group-sm" role="group">'+
                                '<button type="button" class="btn text-info ver" onclick="ver();"><i class="fa fa-eye" ></i></button>'+
                                '<a href="{{url('formatoSolicitud/mostrar')}}/'+r.data[i].idSol+'" class="btn text-success" title="Imprimir en PDF" target="_blank"><i class="fa fa-file-pdf"></i></a>'+
                                '<button type="button" class="btn text-info" title="Editar registro" onclick="editar('+r.data[i].idSol+');"><i class="fa fa-edit" ></i></button>'+
                                '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="eliminar('+r.data[i].idSol+');"><i class="fa fa-trash"></i></button>'+
                            '</div>' + 
                        '</td></tr>';
                }
                $('#data').html(html);
                initDatatable('registros');
                $('.overlayRegistros').css('display','none');
            }
        });
    }
    
    function dataTit(tit)
    {
        var cliente = tit.clientec!==null && tit.clientec!=''?
            'Cliente: <span class="font-weight-bold">'+tit.clientec+'</span><br>':'';
        var dni = tit.dnic!==null && tit.dnic!=''?
            'DNI: <span class="font-weight-bold">'+tit.dnic+'</span><br>':'';
        var direccion = tit.direccionc!==null && tit.direccionc!=''?
            'Direccion: <span class="font-weight-bold">'+tit.direccionc+'</span><br>':'';
        var telefono = tit.telefonoc!==null && tit.telefonoc!=''?
            'Telefono: <span class="font-weight-bold">'+tit.telefonoc+'</span>':'';
        let data = cliente=='' &&  dni=='' && direccion=='' && telefono==''?
            '--':cliente+dni+direccion+telefono; 
        return data;
    }
    function dataRep(rep)
    {
        var representante = rep.representanter!==null && rep.representanter!=''?
            'Nombre: <span class="font-weight-bold">'+rep.representanter+'</span><br>':'';
        var dni = rep.dnir!==null && rep.dnir!=''?
            'DNI: <span class="font-weight-bold">'+rep.dnir+'</span><br>':'';
        var direccion1 = rep.direccionr1!==null && rep.direccionr1!=''?
            'Dire.notif.1: <span class="font-weight-bold">'+rep.direccionr1+'</span><br>':'';
        var direccion2 = rep.direccionr2!==null && rep.direccionr2!=''?
            'Dire.notif.2: <span class="font-weight-bold">'+rep.direccionr2+'</span><br>':'';
        var telefono = rep.telefonor!==null && rep.telefonor!=''?
            'Telefono: <span class="font-weight-bold">'+rep.telefonor+'</span>':'';
        let data = representante=='' &&  dni=='' && direccion1=='' && direccion2=='' && telefono==''?
            '--':representante+dni+direccion1+direccion2+telefono; 
        return data;
    }
    function dataCon(con)
    {
        var postal = con.postalr!==null && con.postalr!=''?
            'Codigo postal: <span class="font-weight-bold">'+con.postalr+'</span><br>':'';
        var correo = con.correor!==null && con.correor!=''?
            'Correo: <span class="font-weight-bold">'+con.correor+'</span><br>':'';
        let data = postal=='' &&  correo==''?
            '--':postal+correo; 
        return data;
    }
</script>
@endsection