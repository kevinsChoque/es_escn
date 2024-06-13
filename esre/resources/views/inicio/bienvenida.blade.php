@extends('layout.layout')
@section('nombreContenido', '----')
@section('cabecera')
<div class="main-header p-1">
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12 m-auto">
            <h6 class="my-0 ml-3">Listar solicitudes</h6>
        </div>
        <div class="col-lg-6 col-sm-6 col-12">
            <button class="btn btn-sm btn-success float-right btnPmsRegistrar botonNewSoli">
                <i class="fa fa-plus"></i> 
                Nueva Solicitud
            </button>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<div class="container-fluid">
    <div class="alert alert-primary">
    	<h1 class="m-0">bienvenido</h1>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('.overlayPagina').css("display","none");
    } );
</script>
@endsection