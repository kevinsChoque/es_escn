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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Historial de reclamos por usuario</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted"><i class="fa fa-user"></i> </span>
                                    <span class="info-box-number text-center text-muted mb-0">Sara Sauñe Vilca</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">3</span>
                                    <span class="info-box-number text-center text-muted mb-0">Cant. de reclamos comerciales</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">2</span>
                                    <span class="info-box-number text-center text-muted mb-0">Cant. de reclamos operacionales</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4>Reclamos realizados</h4>
                            <div class="post">
                                <div class="user-block">
                                    <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image"> -->
                                    <span class="username">
                                        <a href="#">Representante: Enrique Gomez.</a>
                                    </span>
                                    <span class="description">Reclamo realizado el 23 de enero del 2023</span>
                                </div>
                                <p>
                                Reclamo por consumo elevado <br>
                                El incremento de la facturacion fue de un 15 %
                                </p>
                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Ver 1 archivo adjuntado</a>
                                </p>
                            </div>
                            <div class="post clearfix">
                                <div class="user-block">
                                    <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image"> -->
                                    <span class="username">
                                        <a href="#">Representante: Felipe Sauñe</a>
                                    </span>
                                    <span class="description">Reclamo realizado el 15 de noviembre del 2022</span>
                                </div>
                                <p>
                                Incremento del consumo <br>
                                Ruptura de tuberia
                                </p>
                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Ver 2 archivo adjuntado</a>
                                </p>
                            </div>
                            <div class="post">
                                <div class="user-block">
                                    <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image"> -->
                                    <span class="username">
                                        <a href="#">Titular: Sara Sauñe.</a>
                                    </span>
                                    <span class="description">Reclamo realizado el 24 de octubre del 2022</span>
                                </div>
                                <p>
                                Ruptura de medidor <br>
                                medidor dañado
                                </p>
                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Ver 3 archivo adjuntado</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <h3 class="text-primary"><i class="fas fa-user"></i> Sara Sauñe Vilca</h3>
                    <p class="text-muted">
                        Datos del titular:
                    </p>
                    <br>
                    <div class="text-muted">
                        <p class="text-sm">DNI
                            <b class="d-block">47456770</b>
                        </p>
                        <p class="text-sm">Direccion
                            <b class="d-block">Av Nuñez #245</b>
                        </p>
                        <p class="text-sm">Telefono
                            <b class="d-block">986854628</b>
                        </p>
                    </div>
                    <h5 class="mt-5 text-muted">Archivos adjuntados</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> foto de tuberia.pdf</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> Dni.pdf</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Mensaje enviado.mln</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Recibo.png</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> Resolucion.docx</a>
                        </li>
                    </ul>
                    <div class="text-center mt-5 mb-3">
                        <a href="#" class="btn btn-sm btn-primary">Agregar archivos</a>
                        <a href="#" class="btn btn-sm btn-warning">Notificar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('.overlayPagina').css("display","none");
    } );
    
</script>
@endsection