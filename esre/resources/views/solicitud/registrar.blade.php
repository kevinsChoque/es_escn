@extends('layout.layout')
@section('nombreContenido', '----')
@section('cabecera')
<link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.min.css')}}">
<script src="{{asset('plugins/dropzone/dropzone.min.js')}}"></script>
<style>
	.page-link {
    padding: 0rem 0.75rem !important;
}
.dataTables_info{
	padding: 0 !important;
}
td{
	font-size: .7rem !important;
    font-weight: bold;
}
th{
	font-size: .8rem !important;
}
</style>

<div class="main-header p-1">
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12 m-auto">
            <h6 class="my-0 ml-3">Registrar solicitud</h6>
        </div>
        <div class="col-lg-6 col-sm-6 col-12">
            <!-- <button class="btn btn-sm btn-success float-right btnPmsRegistrar botonNewSoli">
                <i class="fa fa-plus"></i> 
                Lista de solicitudes
            </button> -->
            <a href="{{url('solicitud/solicitud')}}" class="btn btn-sm btn-success float-right">
                <i class="fa fa-list"></i> 
                Lista de solicitudes
            </a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					  	<a class="nav-link active groupRegistrar" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" data-opc="cli"><i class="fa fa-user"></i> Cliente</a>
					  	<a class="nav-link groupRegistrar" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" data-opc="rep"><i class="fa fa-user"></i> Representante</a>
					  	<a class="nav-link groupRegistrar" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" data-opc="rec"><i class="fa fa-user"></i> Reclamo</a>
					  	<a class="nav-link groupRegistrar" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false" data-opc="arc"><i class="fa fa-user"></i> Archivos</a>
					  	<a class="nav-link groupRegistrar" id="v-pills-date-tab" data-toggle="pill" href="#v-pills-date" role="tab" aria-controls="v-pills-date" aria-selected="false" data-opc="fec"><i class="fa fa-user"></i> Fechas</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="card">
				<!-- <div class="overlay dark overlayRegistros">
                    <img src="{{asset('img/imgAdicionales/spinerLetter.svg')}}" class="svgLoadLetter">
                </div> -->
				<div class="card-header border-transparent py-2">
                	<div class="row">
                		<div class="form-group col-lg-6 m-0">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary bPorInscripcion"><i class="fa fa-search"></i></button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center" id="numInscri" name="numInscri" placeholder="Buscar por numero de inscripcion">
                            </div>
                        </div>
                	</div>
                </div>
				<!-- overlayRegistros -->
				<div class="overlay dark overlayRegistrar" style="display: none;">
					<i class="fas fa-2x fa-sync-alt"></i>
				</div>
				<div class="card-body">
					<div class="row contentClientes" style="display: none;">
						<!-- style="display: none;" -->
                        <div class="col-md-12 table-responsive contenedorRegistros" >
                            <table id="clientes" class="table table-hover table-bordered dt-responsive nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="2">Cliente</th>
                                        <th class="text-center" data-priority="2">DNI</th>
                                        <!-- <th class="text-center" data-priority="2">RUC</th> -->
                                        <th class="text-center" data-priority="1">Direccion</th>
                                        <th class="text-center" data-priority="1">Urbanizacion</th>
                                    </tr>
                                </thead>
                                <tbody id="dataBuscada">
                                </tbody>
                            </table>
                        </div>
                        <hr class="w-100">
                    </div>
					<div class="row">
						<div class="col-lg-12">
							<form id="fvregistrar">
							<div class="tab-content" id="v-pills-tabContent">
							  	<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
								  	<div class="row">
								  		<div class="form-group col-lg-4">
				                            <label for="clientec" class="m-0">Cliente:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="clientec" name="clientec">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="dnic" class="m-0">DNI:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="dnic" name="dnic">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="rucc" class="m-0">RUC:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="rucc" name="rucc">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="direccionc" class="m-0">Direccion:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="direccionc" name="direccionc">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="urbanizacionc" class="m-0">Urbanizacion:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="urbanizacionc" name="urbanizacionc">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="provinciac" class="m-0">Provincia:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="provinciac" name="provinciac">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="distritoc" class="m-0">Distrito:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="distritoc" name="distritoc">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="telefonoc" class="m-0">Telefono:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="telefonoc" name="telefonoc">
				                            </div>
				                        </div>
								  	</div>	

							  	</div>
							  	<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
								  	<div class="row">
								  		<div class="form-group col-lg-4">
				                            <label for="representanter" class="m-0">Representante:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="representanter" name="representanter">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="dnir" class="m-0">DNI:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="dnir" name="dnir">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="medidorr" class="m-0">Medidor:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="medidorr" name="medidorr">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="direccionr1" class="m-0">Direccion Notif. 1:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="direccionr1" name="direccionr1">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="direccionr2" class="m-0">Direccion Notif. 2:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="direccionr2" name="direccionr2">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="postalr" class="m-0">Codigo Postal:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="postalr" name="postalr">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="telefonor" class="m-0">Telefono/Celular:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="telefonor" name="telefonor">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="correor" class="m-0">Correo Elect.:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="correor" name="correor">
				                            </div>
				                        </div>
								  	</div>	
							  	</div>
							  	<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							  		<div class="row">
							  			<div class="form-group col-lg-4">
				                            <label for="codigor" class="m-0">Codigo:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="codigor" name="codigor">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="descripcionr" class="m-0">Descripcion:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="descripcionr" name="descripcionr">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="serier" class="m-0">Nª Serie:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="serier" name="serier">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="recibor" class="m-0">Nª Recibo:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="recibor" name="recibor">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="fer" class="m-0">Fecha Emision:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="date" class="form-control form-control-sm clean" id="fer" name="fer">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-4">
				                            <label for="importer" class="m-0">Importe:</label>
				                            <div class="input-group input-group-sm">
				                                <div class="input-group-prepend">
				                                    <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
				                                </div>
				                                <input type="text" class="form-control form-control-sm clean" id="importer" name="importer">
				                            </div>
				                        </div>
				                        <div class="form-group col-lg-12">
										    <label for="fundamentor" class="m-0">Fundamento del Reclamo:</label>
										    <textarea class="form-control" id="fundamentor" rows="3"></textarea>
										</div>
							  		</div>
							  	</div>
							  	<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
									<label for="">La EPS entrega cartilla informativa:</label><br>
							  		<div class="row">
							  			<div class="col-sm-2">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="cartilla" checked="" id="copc1">
													<label for="copc1">Si</label>
												</div>
												
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="cartilla" id="copc2">
													<label for="copc2">No</label>
												</div>
											</div>
										</div>
							  		</div>	
							  		<label for="">DECLARACION DEL RECLAMANTE:</label><br>
									<p>Aplicable a reclamos por consumo medido; solicito la relacion de prueba de contrastacion y acepto asumir su costo.</p>	
									<div class="row">
										<div class="col-sm-2">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="declaracion" checked="" id="dopc1">
													<label for="dopc1">Si</label>
												</div>
												
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group clearfix">
												<div class="icheck-success d-inline">
													<input type="radio" name="declaracion" id="dopc2">
													<label for="dopc2">No</label>
												</div>
											</div>
										</div>
									</div>
							  	</div>
							  	<div class="tab-pane fade" id="v-pills-date" role="tabpanel" aria-labelledby="v-pills-date-tab">
									<!-- <label for="">La EPS entrega cartilla informativa:</label><br> -->
							  		<div class="row mb-3">
                                        <label for="fecha1f" class="col-3 col-form-label">Inspeccion interna y externa</label>
                                        <label for="fecha1f" class="col-1 col-form-label" style="font-size: .8rem;">Fecha</label>
                                        <div class="col-3">
                                            <input type="date" class="form-control form-control-sm" id="fecha1f">
                                        </div>
                                        <label for="hora1f" class="col-3 col-form-label">Hora (Rango de 2 horas)</label>
                                        <div class="col-2">
                                            <input type="time" class="form-control form-control-sm" id="hora1f">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fecha2f" class="col-3 col-form-label">Citacion a reunion</label>
                                        <label for="fecha2f" class="col-1 col-form-label" style="font-size: .8rem;">Fecha</label>
                                        <div class="col-3">
                                            <input type="date" class="form-control form-control-sm" id="fecha2f">
                                        </div>
                                        <label for="hora2f" class="col-3 col-form-label">Hora</label>
                                        <div class="col-2">
                                            <input type="time" class="form-control form-control-sm" id="hora2f">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fecha3f" class="col-6 col-form-label">Fecha maxima de notificacion de la resolucion</label>
                                        <label for="fecha3f" class="col-1 col-form-label" style="font-size: .8rem;">Fecha</label>
                                        <div class="col-5">
                                            <input type="date" class="form-control form-control-sm" id="fecha3f">
                                        </div>
                                    </div>	
							  	</div>
							</div>
							</form>
						</div>
						<!-- <div class="col-lg-12">
				            <button class="btn btn-sm btn-success float-right guardar"><i class="fa fa-save"></i> Guardar Solicitud</button>
				        </div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
                        <div class="col-lg-12">
                            <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center py-0" id="dSubirArchivo" style="height: 250px !important;">
                                <input type="hidden" id="codigo" name="codigo">
                                <input type="hidden" id="marca" name="marca">
                                <input type="hidden" id="modelo" name="modelo">
                                <input type="hidden" id="descripcion" name="descripcion">
                                <input type="hidden" id="estado" name="estado">
                                <input type="hidden" id="costo" name="costo">
                                <input type="hidden" id="precio" name="precio">
                                <input type="hidden" id="stock" name="stock">
                                <input type="hidden" id="sinArchivo" name="sinArchivo" value="0">
                                <div class="dz-default dz-message align-content-center justify-content-center">
                                    <span class="font-weight-bold font-italic">Suelta la imagen o realiza click para cargar la imagen.</span>
                                </div>
                                @csrf
                            </form>
                        </div>

                    </div>	
				</div>
			</div>
		</div>
		<div class="col-lg-12">
            <button class="btn btn-sm btn-success float-right guardar"><i class="fa fa-save"></i> Guardar Solicitud</button>
        </div>
	</div>
</div>
<script>
var flip=0;
var tablaDeRegistros;
$(document).ready( function () {
    $('.overlayPagina').css("display","none");
    tablaDeRegistros=$('.contenedorRegistros').html();
} );
$('.guardar').on('click',function(){
	guardar();
});
$('.bPorInscripcion').on('click',function(){
	bPorInscripcion();
});
$('.groupRegistrar').on('click',function(){
	// if($(this).attr('data-opc')=='cli')
	// 	$('.contentClientes').css('display','block');
	// else
		$('.contentClientes').css('display','none');

});
function bPorInscripcion()
{
	
	$( ".overlayRegistrar" ).toggle( flip++ % 2 === 0 );
	jQuery.ajax(
    { 
        url: "{{url('buscar/bPorInscripcion')}}",
        data: $('#numInscri').val(),
        method: 'get',
        success: function(r){
        	construirTabla();
            console.log(r);
            var html = '';
            var nombre='';
            for (var i = 0; i < r.data.length; i++) 
            {
            	nombre = r.data[i].SolNombre;
                html += '<tr class="text-center" ondblclick="elegir(this);" data-nombre="'+nombre+'">' +
                    '<td class="align-middle">' + novDato(r.data[i].SolNombre) + '</td>' +
                    '<td class="align-middle">' + novDato(r.data[i].SolElect) + '</td>' +
                    // '<td class="align-middle">' + novDato('') + '</td>' +
                    '<td class="align-middle">' + novDato(r.data[i].SolTipCal) +
                    	novDato(r.data[i].SolDirec) +
                    	novDato(r.data[i].SolDirNro) +
                    '</td>' +
                    '<td class="align-middle">' + novDato(r.data[i].SolUrban) + '</td>' +
                    '</tr>';
            }
            $('.contentClientes').css('display','block');
            $( ".overlayRegistrar" ).toggle( flip++ % 2 === 0 );
            $('#dataBuscada').html(html);
            initDatatableBuscar('clientes');
            // $( ".overlayRegistrar" ).toggle( flip++ % 2 === 0 );
            // $('.overlayPagina').css("display","flex");
            msjRee(r);
        }
    });
}
function construirTabla()
{
    $('.contenedorRegistros>div').remove();
    $('.contenedorRegistros').html(tablaDeRegistros);
}
function elegir()
{
	alert($(this).attr('data-nombre'));
	Swal.fire({
        title: 'Elegir cliente',
        text: 'cliente '+$(this).attr('data-nombre'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if(result.isConfirmed)
        {
            alert('confirmado');
        }
    });
}
function data()
{
    return {
        clientec:$('#clientec').val(),
        dnic:$('#dnic').val(),
        rucc:$('#rucc').val(),
        direccionc:$('#direccionc').val(),
        urbanizacionc:$('#urbanizacionc').val(),
        provinciac:$('#provinciac').val(),
        distritoc:$('#distritoc').val(),
        telefonoc:$('#telefonoc').val(),

        representanter:$('#representanter').val(),
        dnir:$('#dnir').val(),
        medidorr:$('#medidorr').val(),
        direccionr1:$('#direccionr1').val(),
        direccionr2:$('#direccionr2').val(),
        postalr:$('#postalr').val(),
        telefonor:$('#telefonor').val(),
        correor:$('#correor').val(),

        codigor:$('#codigor').val(),
        descripcionr:$('#descripcionr').val(),
        serier:$('#serier').val(),
        recibor:$('#recibor').val(),
        fer:$('#fer').val(),
        importer:$('#importer').val(),
        fundamentor:$('#fundamentor').val(),

        cartilla:$('input[name=cartilla]').prop('checked')?'1':'0',

        fecha1f:$('#fecha1f').val(),
        fecha2f:$('#fecha2f').val(),
        fecha3f:$('#fecha3f').val(),
        hora1f:$('#hora1f').val(),
        hora2f:$('#hora2f').val(),
    }
}
function guardar()
{
	$( ".overlayRegistrar" ).toggle( flip++ % 2 === 0 );
	$('.overlayPagina').css("display","flex");
    if($('#fvregistrar').valid()==false)
    {return;}
    jQuery.ajax(
    { 
        url: "{{url('solicitud/guardar')}}",
        data: data(true),
        method: 'get',
        success: function(result){
            console.log(result);
            $( ".overlayRegistrar" ).toggle( flip++ % 2 === 0 );
            window.location.href = "{{url('solicitud/solicitud')}}";
            $('.overlayPagina').css("display","flex");
            msjRee(result);
        }
    });
}
// function editar(id)
// {
//     localStorage.setItem("idPresupuesto",id);
//     window.location.href = "{{url('presupuesto/editCuadroPresupuestal')}}";
// }
$("#fvregistrar").validate({
    errorClass: "text-danger font-italic font-weight-normal",
    ignore: ".ignore",
    rules: {
        clientec: "required",
        dnic: "required",
    },
});
myDropzone3 = new Dropzone("#dSubirArchivo", {
        url: "{{url('archivo/guardarCambios')}}",
        dictDefaultMessage: "Seleccione algun archivo.",
        paramName: "file",
        autoProcessQueue:false,
        addRemoveLinks: true,
        maxFiles: 1,
        maxFilesize: 5,
        clickable: true,
        renameFile: function(file) {
            // return "_" + file.name;
            // var name = $('#codigoFaja').val();
            console.log(file.name);
            return file.name;
        },
        init:function(){
            var submitButton = document.querySelector('.guardarCambiosArchivo');
            myDropzone3=this;
            submitButton.addEventListener('click',function(){
                validateFormEdit(myDropzone3);
            });
            this.on("addedfile", function (file) {
                // alert('activar boton');
                // $('.guardarArchivo').css('display','block');
            });
            this.on("removedfile", function (file) {
                // console.log('Se removio un archivo');
                // alert('desactivar boton');
                // $('.guardarArchivo').css('display','none');
            });
            this.on('complete',function(file){
                // fillImgs();
                clearFormEdit(myDropzone3);
                cancelarEdicion();
                msjSimple(true,'Se guardo los cambios del archivo exitosamente');
                // clearFormEditImg(myDropzone3);
                // console.log(file);
                // let imgGuardada = path+$('#codigoFaja').val()+'/'+file.name;
                // $('#imgFaja').attr('src',imgGuardada);
                
            });
        },
    });
</script>
@endsection