@extends('layout.layout')
@section('nombreContenido', '----')
@section('cabecera')
<div class="main-header p-1">
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12 m-auto">
            <h6 class="my-0 ml-3">Listar de registros</h6>
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
                <div class="overlay overlayRegistros">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
                <!-- <div class="overlay dark overlayRegistros">
                    <img src="{{asset('img/imgAdicionales/spinerLetter.svg')}}" class="svgLoadLetter">
                </div> -->
                <div class="card-header border-transparent py-2">
                    <h3 class="card-title m-0 font-weight-bold"><i class="fa fa-file"></i> Listar actas por solicitud</h3>
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
                                        <th class="text-center" data-priority="2">Fecha</th>
                                        <th class="text-center" data-priority="2">Inspeccion interna</th>
                                        <th class="text-center" data-priority="1">Inspeccion externa</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('acta.mInspeccionInterna')
<script>
    var tablaDeRegistros;
    var tablaDeRegistrosArchivos;
    var flip=0;
    $(document).ready( function () {
        tablaDeRegistros=$('.contenedorRegistros').html();
        $('.overlayPagina').css("display","none");
        fillRegistros();
    } );
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
                        '<td class="align-middle">' + novDato(r.data[i].clientec) + '</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].fr) + '</td>' +
                        '<td class="align-middle">' + 
                            '<button type="button" class="btn text-secondary ver" onclick="loadFile(this)"><i class="fa fa-upload" ></i> Subir formato</button>'+
                            '<a href="{{url('actaArchivo/inspeccionInterna')}}/'+r.data[i].idSol+'" class="btn text-secondary" title="Descargar formato 5A" target="_blank"><i class="fa fa-file-download"></i> Formato 5A</a>'+
                        '</td>' +
                        '<td class="align-middle">' + 
                            '<button type="button" class="btn text-secondary ver" onclick="ver();"><i class="fa fa-upload" ></i> Subir formato</button>'+
                            '<a href="{{url('actaArchivo/inspeccionExterna')}}/'+r.data[i].idSol+'" class="btn text-secondary" title="Descargar formato 5A" target="_blank"><i class="fa fa-file-download"></i> Formato 5B</a>'+
                        '</td>' +
                        '</tr>';
                }
                $('#data').html(html);
                initDatatable('registros');
                $('.overlayRegistros').css('display','none');
            }
        });
    } 
</script>
@endsection