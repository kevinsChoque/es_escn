@extends('layout.layout')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


<link rel="stylesheet" href="{{asset('escn/public/plugins/datatables/dataTables.dataTables.css')}}">
<link rel="stylesheet" href="{{asset('escn/public/plugins/datatables/responsive.dataTables.css')}}">

<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
<div class="container-fluid mt-3">
    <div class="row containerTask">
    </div>
</div>


<div class="container-fluid">
    <div class="card mt-3">
        <div class="d-none justify-content-center containerSpinner" style="background: rgb(199 206 213 / 50%);height: 100%;
        position: absolute;width: 100%;z-index: 1000000;">
            <div class="spinner-border m-auto text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="card-header">
            <h6 class="fw-bold m-0"><i class="fa fa-list"></i> PADRON DE USUARIOS EN CORTE</h6>
        </div>
        <div class="card-body">
            <div id="colorFilters" class="mb-3">
                <button id="filterActivate" class="btn btn-success">Usuarios que pagaron</button>
                <button id="filterGreen" class="btn btn-success" style="background: #bbd1a2;color: black;">Usuarios activados</button>
                <button id="filterRed" class="btn btn-danger">Usuarios cortados</button>
                <button id="filterBlue" class="btn btn-primary">Listos para activar</button>
                <button id="filterNone" class="btn btn-light">Registros sin accion</button>
                <button id="filterAll" class="btn btn-secondary">Todos los registros asignados</button>
            </div>
            <div class="row">
                {{-- <div class="col-lg-12">
                    <button class="btn btn-success w-100" onclick="updateRecords()"><i class="fa fa-sync"></i> Actualizar padron</button>
                </div> --}}
                <div class="col-lg-12 m-auto p-3 containerRecordsBlue table-responsive">
                    <table id="tableBlue" class="w-100 table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="3%" class="text-center" data-priority="2">#</th>
                                <th width="6%" class="text-center" data-priority="2">CORTE</th>
                                <th width="6%" class="text-center" data-priority="2">ACTIVAR</th>
                                <th width="6%" class="text-center" data-priority="1">Codigo</th>
                                {{-- <th width="3%" class="text-center" data-priority="1">Cod</th> --}}
                                <th width="6%" class="text-center" data-priority="2">inscri</th>
                                <th width="12%" class="text-center" data-priority="2">cliente</th>
                                <th width="9%" class="text-center" data-priority="3">direccion</th>
                                <th width="6%" class="text-center" data-priority="3">tarifa</th>
                                <th width="6%" class="text-center" data-priority="1">medidor</th>
                                <th width="3%" class="text-center" data-priority="3">meses</th>
                                <th width="9%" class="text-center" data-priority="1">monto</th>
                                <th width="6%" class="text-center" data-priority="3">servicio</th>
                                <th width="6%" class="text-center" data-priority="2">consumo</th>
                                <th width="6%" class="text-center" data-priority="1">EVIDENCIAS/OBS</th>
                            </tr>
                        </thead>
                        <tbody id="recordsBlue">
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 m-auto p-3 shadow containerRecordsCuts table-responsive">
                    <table id="tableCuts" class="w-100 table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="3%" class="text-center" data-priority="2">#</th>
                                <th width="6%" class="text-center" data-priority="2">CORTE</th>
                                <th width="6%" class="text-center" data-priority="2">ACTIVAR</th>
                                <th width="6%" class="text-center" data-priority="1">Codigo</th>
                                {{-- <th width="3%" class="text-center" data-priority="1">Cod</th> --}}
                                <th width="6%" class="text-center" data-priority="2">inscri</th>
                                <th width="12%" class="text-center" data-priority="2">cliente</th>
                                <th width="9%" class="text-center" data-priority="3">direccion</th>
                                <th width="6%" class="text-center" data-priority="3">tarifa</th>
                                <th width="6%" class="text-center" data-priority="1">medidor</th>
                                <th width="3%" class="text-center" data-priority="3">meses</th>
                                <th width="9%" class="text-center" data-priority="1">monto</th>
                                <th width="6%" class="text-center" data-priority="3">servicio</th>
                                <th width="6%" class="text-center" data-priority="2">consumo</th>
                                <th width="6%" class="text-center" data-priority="1">EVIDENCIAS/OBS</th>
                            </tr>
                        </thead>
                        <tbody id="recordsCourt">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEvidence" tabindex="-1" aria-labelledby="modalEvidenceLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenceLabel">Subir evidencias <span class="badge bg-danger">CORTADO</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>Datos del usuario</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Codigo-cod:</strong> <span class="showCod"></span></li>
                    <li class="list-group-item"><strong>Inscripcion:</strong> <span class="showIns"></span></li>
                    <li class="list-group-item"><strong>Cliente:</strong> <span class="showCli"></span></li>
                    <li class="list-group-item"><strong>Direccion:</strong> <span class="showDir"></span></li>
                </ul>
                <br>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-load-tab" data-bs-toggle="pill" data-bs-target="#pills-load" type="button" role="tab" aria-controls="pills-load" aria-selected="true">Subir evidencias</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-show-evidence-tab" data-bs-toggle="pill" data-bs-target="#pills-show-evidence" type="button" role="tab" aria-controls="pills-show-evidence" aria-selected="false">Ver evidencias subidas</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-load" role="tabpanel" aria-labelledby="pills-load-tab">
                        {{-- <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center" id="dzLoadEvidence">
                            <input type="hidden" id="inscription" name="inscription">
                            <input type="hidden" id="type" name="type">
                            <div>
                                <h6 class="text-center font-weight-bold">Archivos subidos</h6>
                            </div>
                            <div class="dz-default dz-message">
                                <span class="font-weight-bold font-italic">Suelta el archivo o realiza click para cargar archivos <span class="text-warning">(<5MB)</span></span>
                            </div>
                            @csrf
                        </form> --}}
                        <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center" id="dzLoadEvidence">
                            <input type="hidden" id="inscription" name="inscription">
                            <input type="hidden" id="type" name="type">
                            <input type="file" id="mobileCameraInput" accept="image/*" capture="environment" style="display:none;">
                            <div>
                                <h6 class="text-center font-weight-bold">Archivos subidos</h6>
                            </div>
                            <div class="dz-default dz-message">
                                <span class="font-weight-bold font-italic">Suelta el archivo o realiza click para cargar archivos <span class="text-warning">(<5MB)</span></span>
                            </div>
                            @csrf
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-show-evidence" role="tabpanel" aria-labelledby="pills-show-evidence-tab">
                        <div class="alert alert-info messageEvidences" style="display: none;">
                            <p class="m-0 fw-bold">No cuenta con evidencias guardadas.</p>
                        </div>
                        <button class="btn btn-primary w-100 mb-2" onclick="updateImage()"><i class="fa fa-sync"></i> Actualizar imagenes</button>
                        <div class="row containerEvidences">
                            {{-- <div class="col-md-4 d-flex align-items-center">
                                <img src="http://localhost/escn/storage/app/public/evidences/activate/24-00138798/1717530639_images.jpg" class="rounded w-100">
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveEvidence">Guardar evidencias</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalObs" tabindex="-1" aria-labelledby="modalObsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalObsLabel">Realizar observacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Datos del usuario</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Codigo-cod:</strong> <span class="oshowCod"></span></li>
                            <li class="list-group-item"><strong>Inscripcion:</strong> <span class="oshowIns"></span></li>
                            <li class="list-group-item"><strong>Cliente:</strong> <span class="oshowCli"></span></li>
                            <li class="list-group-item"><strong>Direccion:</strong> <span class="oshowDir"></span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="obs" class="form-label font-weight-bold">Ingrese la observacion:</label>
                            <textarea class="form-control obs" id="obs" rows="6"></textarea>
                            {{-- onkeyup="saveObs();" --}}
                          </div>
                    </div>
                </div>
                <br>
                <ul class="nav nav-pills mb-3" id="pills-tab-obs" role="tablist">
                    <li class="nav-item" role="loadObs">
                        <button class="nav-link active" id="pills-oload-tab-obs" data-bs-toggle="pill" data-bs-target="#pills-oload-obs" type="button" role="tab" aria-controls="pills-oload-obs" aria-selected="true">Subir imagenes</button>
                    </li>
                    <li class="nav-item" role="showObs">
                        <button class="nav-link" id="pills-show-images-tab-obs" data-bs-toggle="pill" data-bs-target="#pills-show-images-obs" type="button" role="tab" aria-controls="pills-show-images-obs" aria-selected="false">Ver imagenes subidas</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent-obs">
                    <div class="tab-pane fade show active" id="pills-oload-obs" role="tabpanel" aria-labelledby="pills-oload-tab-obs">
                        <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center" id="dzLoadObs">
                            <input type="hidden" id="oinscription" name="oinscription">
                            <input type="hidden" id="idObs" name="idObs">
                            <input type="hidden" id="oobs" name="oobs">
                            <div>
                                <h6 class="text-center font-weight-bold">Imagenes subidas</h6>
                            </div>
                            <div class="dz-default dz-message">
                                <span class="font-weight-bold font-italic">Suelta la imagen o realiza click para cargar imagenes <span class="text-warning">(<5MB)</span></span>
                            </div>
                            @csrf
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-show-images-obs" role="tabpanel" aria-labelledby="pills-show-images-tab-obs">
                        <div class="alert alert-info messageObs" style="display: none;">
                            <p class="m-0 fw-bold">No cuenta con imagenes guardadas.</p>
                        </div>
                        <button class="btn btn-primary w-100 mb-2" onclick="updateImageObs()"><i class="fa fa-sync"></i> Actualizar imagenes</button>
                        <div class="row containerImagesObs">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveImgObs">Guardar imagenes de la observacion</button>
            </div>
        </div>
    </div>
</div>
<style>
    .activate-row{background: rgba(0, 255, 0, 0.5) !important;}
    .green-row{background: rgba(119, 163, 69, 0.5) !important;}
    .blue-row{background: rgba(0, 0, 255, 0.5) !important;}
    .red-row{background: rgba(255, 0, 0, 0.5) !important;}
    .none-row{background: none !important;}
    .selected-task{background: rgb(31 208 58 / 50%) !important;}
</style>
<script src="{{asset('escn/public/plugins/dropzone/dropzone-min.js')}}"></script>
<link href="{{asset('escn/public/plugins/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />
<script>
var tableRecordsCuts;
var tableRecordsRehab;
var tableRecordsBlue;

var tabletest;
// Dropzone.options.myDropzone = false;
Dropzone.autoDiscover = false;
var myDropzone = '';
var myDropzoneObs = '';
$(document).ready( function ()
{
    console.log("{{ asset('storage/') }}")
    tableRecordsCuts = $('.containerRecordsCuts').html();
    tableRecordsRehab = $('.containerRecordsRehab').html();
    tableRecordsBlue = $('.containerRecordsBlue').html();
    // fillRecords();
    fillRecords2();
    fillTask();
    initDropzone();
    initDropzoneObs();
});
// $('.loadAssign').on('click',function(){
//     alert($(this).attr('data-idAss'))
// })
$('.obs').on('blur',function(){
    $('#oobs').val($(this).val())
})
function loadAssign(ele)
{
    // alert($(ele).attr('data-idAss'))
    $('.containerRecordsCuts>div').remove();
    $('.containerRecordsCuts').html(tableRecordsCuts);
    fillRecords3($(ele).attr('data-idAss'))
    $('.selected-task').removeClass('selected-task');
    $(ele).find('.card').addClass('selected-task');
}
console.log("---"+"{{Session::get('assign')->idAss}}");
function fillTask()
{
    jQuery.ajax({
        url: "{{ route('fillTask') }}",
        method: 'POST',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            if(r.state)
            {
                let html = '';
                let selected;
                let counter = 1;
                let idAss = "{{Session::get('assign')->idAss}}";
                for (var i = 0; i < r.data.length; i++)
                {
                    selected = idAss==r.data[i].idAss?'selected-task':'';
                    counter += i;
                    html += '<div class="col-lg-2" onclick="loadAssign(this)" style="cursor: pointer;" data-idAss="'+r.data[i].idAss+'">'+
                        '<div class="card shadow '+selected+'">'+
                            '<div class="card-body p-1">'+
                                '<h5 class="card-title">Tarea '+counter+'</h5>'+
                                '<h6 class="card-subtitle text-muted">Etiqueta: '+r.data[i].flat+'</h6>'+
                                '<p class="card-text">Cant.reg: '+r.data[i].cant+'</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                }
                $('.containerTask').html(html);
            }
            else
                alert(r.message);
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });

}
$('#filterActivate').on('click', function() {
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    $('#tableCuts').DataTable().rows().every(function() {
        if ($(this.node()).hasClass('activate-row')) {
            $(this.node()).show();
        } else {
            $(this.node()).hide();
        }
    });
});
$('#filterGreen').on('click', function() {
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    $('#tableCuts').DataTable().rows().every(function() {
        if ($(this.node()).hasClass('green-row')) {
            $(this.node()).show();
        } else {
            $(this.node()).hide();
        }
    });
});
$('#filterBlue').on('click', function() {
    // $('#tableCuts').DataTable().rows().every(function() {
    //     if ($(this.node()).hasClass('blue-row')) {
    //         $(this.node()).show();
    //     } else {
    //         $(this.node()).hide();
    //     }
    // });
    $('.overlayPage').css("display","flex");
    $('.containerRecordsBlue').css('display','block');
    $('.containerRecordsCuts').css('display','none');
    jQuery.ajax({
        url: "{{ route('showBlue') }}",
        method: 'POST',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            // var listString = JSON.stringify(r.data);
            // localStorage.setItem('__LISTCUT__', r.data);
            $('.containerRecordsBlue>div').remove();
            $('.containerRecordsBlue').html(tableRecordsBlue);
            if(r.state)
            {
                let htmlCourt = '';
                let countRecords = 0;
                let accordingState = '';
                let accordingStatePaid = '';
                let accordingStateCourt = '';
                let stillCut = '';
                let optionCourt = '';
                let letterCourt = '';
                let evidence = '';

                let classCut='';

                // var data = JSON.parse(r.data);
                // console.log(data)
                for (var i = 0; i < r.data.length; i++)
                {
                    countRecords++;
                    if(r.data[i].courtState=='4')
                    {
                        stillCut = 'rgba(255, 0, 0, 0.5)';
                        classCut = 'red-row';
                        accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'" checked>';
                        accordingStatePaid = '';

                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+r.data[i].numberInscription+'">'+
                        //     '<i class="fa fa-image"></i></button>';

                        evidence = "court";
                    }
                    else
                    {

                        stillCut = 'none';
                        classCut = 'none-row';
                        accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'">';
                    }
                    if(r.data[i].CtaMesActOld!=r.data[i].monthDebt && r.data[i].courtState=='4')
                    {
                        if(r.data[i].CtaMesActOld == 3 && r.data[i].monthDebt == 2)
                        {
                            stillCut = 'rgba(255, 0, 0, 0.5)';
                            classCut = 'red-row';
                            accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                            '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'" checked>';
                            accordingStatePaid = '';

                            // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+r.data[i].numberInscription+'">'+
                            // '<i class="fa fa-image"></i></button>';

                            evidence = "court";
                        }
                        else
                        {
                            if(r.data[i].CtaMesActOld<=3)
                            {
                                evidence = '';
                                if(r.data[i].courtState=='1')
                                {
                                    stillCut = "rgba(119, 163, 69, 0.5);";
                                    classCut = 'green-row';
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUserAct(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'" checked>';

                                    // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+r.data[i].numberInscription+'">'+
                                    //     '<i class="fa fa-image"></i></button>';

                                    evidence = "activate";
                                }
                                else
                                {
                                    stillCut = "rgba(0, 0, 255, 0.5);";
                                    classCut = 'blue-row';
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUserAct(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'">';
                                }
                            }
                            else
                            {
                                if(r.data[i].monthDebt == 0 || r.data[i].monthDebt == 1)
                                {
                                    evidence = '';
                                    if(r.data[i].courtState=='1')
                                    {
                                        stillCut = "rgba(119, 163, 69, 0.5);";
                                        classCut = 'green-row';
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUserAct(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'" checked>';

                                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+r.data[i].numberInscription+'">'+
                                        //     '<i class="fa fa-image"></i></button>';

                                        evidence = "activate";
                                    }
                                    else
                                    {
                                        stillCut = "rgba(0, 0, 255, 0.5);";
                                        classCut = 'blue-row';
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUserAct(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'">';
                                    }
                                }
                            }
                        }
                    }
                    if(r.data[i].courtState=='1')
                    {
                        stillCut = "rgba(119, 163, 69, 0.5);";
                        classCut = 'green-row';
                        accordingStateCourt = '';
                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="activateUserAct(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'" checked>';

                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+r.data[i].numberInscription+'">'+
                        //     '<i class="fa fa-image"></i></button>';

                        evidence = "activate";
                    }

                    if(r.data[i].CtaMesActOld!=r.data[i].monthDebt && r.data[i].courtState === null)
                    {

                        if(r.data[i].CtaMesActOld<=3)
                        {
                            if(r.data[i].CtaMesActOld == 3 && r.data[i].monthDebt == 2)
                            {
                                stillCut = 'none';
                                classCut = 'none-row';
                                accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                                '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+r.data[i].numberInscription+'">';
                            }
                            else
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                classCut = 'activate-row';
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                                console.log('State === nul --- ActOld<=3---'+r.data[i].numberInscription)
                            }
                        }
                        else
                        {
                            if(r.data[i].monthDebt == 0)
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                classCut = 'activate-row';
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                            }
                        }
                    }

                    htmlCourt += '<tr style="background: '+stillCut+';" class="'+i+'idRowTrAct '+classCut+'">' +
                        '<td class="align-middle text-center">' + countRecords + '</td>' +
                        '<td class="align-middle text-center containerSwitchCourt">' +
                            '<div class="form-check form-switch">' +
                                accordingStateCourt +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center containerSwitchActivate">' +
                            '<div class="form-check form-switch">' +
                                accordingStatePaid +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center cellCode">' + novDato(r.data[i].code) + ' - '+ novDato(r.data[i].cod)+ '</td>' +
                        // '<td class="align-middle text-center cellCod">' + novDato(r.data[i].cod) + '</td>' +
                        '<td class="align-middle text-center cellIns">' + novDato(r.data[i].numberInscription) + '</td>'+
                        '<td class="align-middle cellCli">' + novDato(r.data[i].client) + '</td>'+
                        '<td class="align-middle cellAdr">' + novDato(r.data[i].streetDescription) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].rate) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].meter) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].monthDebt) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].amount) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].serviceEnterprise) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].consumption) + '</td>'+
                        '<td class="align-middle text-center">' +
                            '<div class="mb-0 conteinerEvidence">' +
                                '<button type="button" class="btn btn-primary '+i+'idRowEvi" onclick="sendEvidence(this)" '+
                                    'data-type="'+evidence+'" '+
                                    'data-inscription="'+r.data[i].numberInscription+'" '+
                                    'data-cellCode="'+ novDato(r.data[i].code) +' - '+ novDato(r.data[i].cod) + '" '+
                                    'data-cellIns="'+ novDato(r.data[i].numberInscription) + '" '+
                                    'data-cellCli="'+ novDato(r.data[i].client) + '" '+
                                    'data-cellAdr="'+ novDato(r.data[i].streetDescription) + '" '+
                                    'style="display:'+(!isEmpty(evidence)?'inline':'none')+';">'+
                                '<i class="fa fa-image"></i></button>'+
                            '</div>' +
                            '<button type="button" class="btn btn-secondary mt-1" onclick="sendObs(this)" data-type="court" data-inscription="'+r.data[i].numberInscription+'"><i class="fa fa-comment"></i></button>'+
                        '</td>' +
                    '</tr>';
                    accordingStateCourt='';
                    accordingStatePaid='';
                    evidence='';

                    classCut='';
                    // -----
                }
                // console.log(htmlCourt)
                $('#recordsBlue').html(htmlCourt);
                // initDatatableDD('tableBlue');
                tabletestAct = initDatatableDD('tableBlue');
            }
            else
            {
                alert(r.message);
            }
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");

            $('.overlayPage').css("display","none");


        },
        error: function (xhr, status, error) {
            $('.overlayPage').css("display","none");
            // alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
});
$('#filterRed').on('click', function() {
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    $('#tableCuts').DataTable().rows().every(function() {
        if ($(this.node()).hasClass('red-row')) {
            $(this.node()).show();
        } else {
            $(this.node()).hide();
        }
    });
});
$('#filterNone').on('click', function() {
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    $('#tableCuts').DataTable().rows().every(function() {
        if ($(this.node()).hasClass('none-row')) {
            $(this.node()).show();
        } else {
            $(this.node()).hide();
        }
    });
});
$('#filterAll').on('click', function() {
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    $('#tableCuts').DataTable().rows().every(function() {
        $(this.node()).show();
    });
});
function updateImage()
{
    $('.overlayPage').css("display","flex");
    jQuery.ajax({
        url: "{{ route('showEvidences') }}",
        method: 'POST',
        data: {type: $('#type').val(),inscription: $('#inscription').val()},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            $('.containerEvidences').html('');
            if(r.data.length!=0)
            {
                let html = '';
                for (var i = 0; i < r.data.length; i++)
                {
                    html += '<div class="card col-lg-4 p-0">'+
                            '<img src="{{env('IMAGES_BASE_URL')}}'+r.data[i].path+'" class="card-img-top">'+
                            '<div class="card-body p-1">'+
                                '<p class="card-text text-center fw-bold mb-1">'+formatDate(r.data[i].dateEvidence)+' | '+r.data[i].hour+'</p>'+
                                '<a href="#" class="btn btn-danger w-100 py-1" onclick="deleteEvidence(this)" data-idEvi="'+r.data[i].idEvi+'"><i class="fa fa-trash"></i> Eliminar</a>'+
                            '</div>'+
                        '</div>';
                }
                $('.containerEvidences').append(html);
            }
            else
                $('.messageEvidences').css('display','block');
            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            $('.overlayPage').css("display","none");
            alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
}
function updateImageObs()
{
    $('.overlayPage').css("display","flex");
    jQuery.ajax({
        url: "{{ route('showObsevi') }}",
        method: 'POST',
        data: {idObs: $('#idObs').val()},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            $('.containerImagesObs').html('');
            if(r.data.length!=0)
            {
                let html = '';
                for (var i = 0; i < r.data.length; i++)
                {
                    html += '<div class="card col-lg-4 p-0">'+
                            '<img src="{{env('IMAGES_BASE_URL')}}'+r.data[i].path+'" class="card-img-top">'+
                            '<div class="card-body p-1">'+
                                '<p class="card-text text-center fw-bold mb-1">'+formatDate(r.data[i].date)+' | '+r.data[i].hour+'</p>'+
                                '<a href="#" class="btn btn-danger w-100 py-1" onclick="deleteEvidenceObs(this)" data-idOe="'+r.data[i].idOe+'"><i class="fa fa-trash"></i> Eliminar</a>'+
                            '</div>'+
                        '</div>';
                }
                $('.containerImagesObs').append(html);
            }
            else
                $('.messageObs').css('display','block');
            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            $('.overlayPage').css("display","none");
            alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
}
function notify(resp)
{
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: resp.state?"success":"error",
    title: resp.message,
    });
}
function initDropzone_borrar()
{
    myDropzone = new Dropzone('#dzLoadEvidence', {
    url: "{{route('sendEvidence')}}",
    dictDefaultMessage: "Arrastra y suelta archivos aquí para subirlos",
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFilesize: 50,
    autoProcessQueue: false,
    paramName: "files[]",
    addRemoveLinks: true,
    dictRemoveFile: "Remover",
    dictInvalidFileType: "No puedes subir archivos de este tipo.",
    init: function() {
        const submitButton = document.querySelector('.saveEvidence');
        myDropzone = this;
        submitButton.addEventListener('click', function()
        {
            if (myDropzone.getQueuedFiles().length > 0)
            {
                $('.overlayPage').css("display","flex");
                myDropzone.processQueue();
            }
            else
                Swal.fire({title: "EVIDENCIAS",
                    text:"Agregue imagenes para guardar",
                    icon: "warning",
                });
        });
        this.on('addedfile', function(file) {});// Código que se ejecuta cuando se agrega un archivo
        this.on("success", function(file, response) {
            if (response.state === false)
                this.removeFile(file); // Remover el archivo si hay un error
            notify(response);
            $('.overlayPage').css("display","none");
        });
    }
    });
}
function initDropzone() {
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const mobileCameraInput = $('#mobileCameraInput');

    // Inicializar Dropzone
    myDropzone = new Dropzone('#dzLoadEvidence', {
        url: "{{route('sendEvidence')}}",
        dictDefaultMessage: "Arrastra y suelta archivos aquí para subirlos",
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFilesize: 50,
        autoProcessQueue: false,
        paramName: "files[]",
        addRemoveLinks: true,
        dictRemoveFile: "Remover",
        dictInvalidFileType: "No puedes subir archivos de este tipo.",
        init: function () {
            const submitButton = document.querySelector('.saveEvidence');
            myDropzone = this;

            // Detectar clic en el área Dropzone
            $('#dzLoadEvidence').on('click', function () {
                if (isMobile) {
                    // Si es un dispositivo móvil, abre la cámara
                    mobileCameraInput.click();
                }
            });

            // Procesar los archivos capturados por la cámara
            mobileCameraInput.on('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    myDropzone.addFile(file); // Agregar el archivo al Dropzone
                }
            });

            // Procesar la cola al hacer clic en "Guardar"
            submitButton.addEventListener('click', function () {
                if (myDropzone.getQueuedFiles().length > 0) {
                    $('.overlayPage').css("display", "flex");
                    myDropzone.processQueue();
                } else {
                    Swal.fire({
                        title: "EVIDENCIAS",
                        text: "Agregue imágenes para guardar",
                        icon: "warning",
                    });
                }
            });

            // Eventos de Dropzone
            this.on('addedfile', function (file) {
                console.log('Archivo agregado:', file);
            });

            this.on('success', function (file, response) {
                if (response.state === false) {
                    this.removeFile(file); // Remover el archivo si hay un error
                }
                notify(response);
                $('.overlayPage').css("display", "none");
            });
        },
    });
}

function initDropzoneObs()
{
    // console.log(myDropzoneObs.getQueuedFiles().length);
    myDropzoneObs = new Dropzone('#dzLoadObs', {
    url: "{{route('sendImgObs')}}",
    dictDefaultMessage: "Arrastra y suelta archivos aquí para subirlos",
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFilesize: 50,
    autoProcessQueue: false,
    paramName: "files[]",
    addRemoveLinks: true,
    dictRemoveFile: "Remover",
    dictInvalidFileType: "No puedes subir archivos de este tipo.",
    init: function() {
        const submitButton = document.querySelector('.saveImgObs');
        myDropzoneObs = this;
        submitButton.addEventListener('click', function()
        {
            // if(isEmpty($('#obs').val()))
            // {
            //     $('#obs').val('img');
            //     saveObs();
            //     Swal.fire({title: "Observacion",
            //         text:"Intente guardar nuevamente.",
            //         icon: "warning",
            //     });
            //     return;
            // }
            if (myDropzoneObs.getQueuedFiles().length == 0)
            {
                if(isEmpty($('#obs').val()))
                {
                    alert('ingrese alguna observacion')
                    return;
                }
                console.log('enviar por aparte nomas')
                $('.overlayPage').css("display","flex");
                jQuery.ajax({
                    url: "{{ route('sendImgObs') }}",
                    method: 'POST',
                    data: {idObs:$('#idObs').val(),oinscription:$('#oinscription').val(),oobs:$('#oobs').val(),},
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                    success: function (r) {
                        notify(r)
                        $('#modalObs').modal('hide');
                        $('.overlayPage').css("display","none");
                    },
                    error: function (xhr, status, error) {
                        alert("Algo salio mal, porfavor contactese con el Administrador.");
                        $(".containerSpinner").removeClass("d-flex");
                        $(".containerSpinner").addClass("d-none");
                        $('.overlayPage').css("display","none");
                    }
                });
            }
            else
            {
                // console.log('enviar todo')
                $('.overlayPage').css("display","flex");
                myDropzoneObs.processQueue();
            }
            // myDropzoneObs.processQueue();

            // if (myDropzoneObs.getQueuedFiles().length > 0)
            //     myDropzoneObs.processQueue();
            // else
            //     Swal.fire({title: "Observacion",
            //         text:"Agregue imagenes para guardar",
            //         icon: "warning",
            //     });
        });
        this.on('addedfile', function(file) {});// Código que se ejecuta cuando se agrega un archivo
        this.on("success", function(file, r) {
            // if (response.state === false)
            $('#idObs').val(r.idObs)
            this.removeFile(file); // Remover el archivo si hay un error
            notify(r);
            $('.overlayPage').css("display","none");
            // $('#modalObs').modal('hide');
        });
    }
    });
}
// saveImgObs
function cutUpdateLs(inscription,action)
{
    var listObject = JSON.parse(localStorage.getItem('__LISTCUT__'));
    for (var i = 0; i < listObject.length; i++)
    {
        if (listObject[i].numberInscription === inscription) {
            listObject[i].courtState = action ? '4':null;
            break;
        }
    }
    var updatedListString = JSON.stringify(listObject);
    localStorage.setItem('__LISTCUT__', updatedListString);
    return updatedListString;
    console.log('Datos actualizados en localStorage');
}
function cutUpdateBd(data)
{
    jQuery.ajax({
        url: "{{ route('updateRecords') }}",
        method: 'POST',
        data: {data: data},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            console.log(r)
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        }
    });
}
// var row;
function courtUser(ele)
{
    event.preventDefault();
    Swal.fire({
    title: $(ele).is(':checked')?"Esta seguro de realizar corte?":"Esta seguro de cancelar el corte?",
    text: $(ele).is(':checked')?"Confirme la accion":"Al cancelar el corte, las evidencias asociadas al corte se eliminaran. ¿DESEA CONTINUAR?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, confirmar"
    }).then((result) => {
        if (result.isConfirmed)
        {
            $(".containerSpinner").removeClass("d-none");
            $(".containerSpinner").addClass("d-flex");
            jQuery.ajax({
                url: "{{ route('courtUser') }}",
                method: 'POST',
                data: {state: $(ele).is(':checked'),inscription: $(ele).attr('data-inscription')},
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                success: function (r) {
                    let evidence = '';
                    let row;
                    let infoEdit;
                    if(r.state)
                    {
                        if(r.checked)
                        {
                            console.log('entro aki para aserlo r.checked')
                            cutUpdateBd(cutUpdateLs($(ele).attr('data-inscription'),true));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTr').removeClass('none-row').addClass('red-row');

                            infoEdit = tabletest.row(idRow);
                            row = infoEdit.data()
                            row[1]=row[1].replace('sin accion', 'cortado')
                            row[1]=row[1].replace('<input', '<input checked')
                            row[13]=row[13].replace('none', 'inline')
                            infoEdit.data(row).draw();

                            // $(ele).parent().find('label').html('cortado');
                            // $(ele).prop('checked', true);
                            // $('.'+idRow+'idRowEvi').css('display','inline');
                        }
                        else
                        {
                            console.log('else r.checked')
                            cutUpdateBd(cutUpdateLs($(ele).attr('data-inscription'),false));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTr').removeClass('red-row').addClass('none-row');

                            infoEdit = tabletest.row(idRow);
                            row = infoEdit.data()
                            row[1]=row[1].replace('cortado', 'sin accion')
                            row[1]=row[1].replace('checked', ' ')
                            row[13]=row[13].replace('inline', 'none')
                            infoEdit.data(row).draw();

                            // $(ele).parent().find('label').html('sin accion');
                            // $(ele).prop('checked', false);
                            // $('.'+idRow+'idRowEvi').css('display','none');
                        }
                    }
                    if(r.according=='paid')
                    {
                        if(r.paid)
                        {
                            console.log('r.paid')
                            cutUpdateMonthBd(cutUpdateMonthLs($(ele).attr('data-inscription'), r.monthDebt));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTr').removeClass('none-row').addClass('activate-row');
                            // $(ele).parent().parent().parent().find('.containerSwitchCourt').html(' ');
                            // $(ele).parent().parent().parent().find('.containerSwitchActivate').html(' ');
                            // $('.'+idRow+'idRowEvi').css('display','none');

                            infoEdit = tabletest.row(idRow);
                            row = infoEdit.data()
                            row[1]=' ';
                            row[2]=' ';
                            row[13]=row[13].replace('inline', 'none')
                            infoEdit.data(row).draw();
                        }
                        else
                        {
                            console.log('else r.paid')
                            cutUpdateMonthBd(cutUpdateMonthLs($(ele).attr('data-inscription'), r.monthDebt));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTr').removeClass('red-row').addClass('blue-row');

                            let accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+idRow+'" data-inscription="'+$(ele).attr('data-inscription')+'">';

                            // $(ele).parent().parent().parent().find('.containerSwitchActivate>div').html(accordingStatePaid);
                            // $(ele).parent().parent().parent().find('.containerSwitchCourt').html(' ');
                            // $('.'+idRow+'idRowEvi').css('display','none');

                            infoEdit = tabletest.row(idRow);
                            row = infoEdit.data()
                            row[1]=' ';
                            row[2]=row[2].replace('</div>', accordingStatePaid+'</div>')
                            row[13]=row[13].replace('inline', 'none')
                            infoEdit.data(row).draw();
                        }
                    }
                    // Swal.fire({
                    //     title: r.message,
                    //     text: r.state?"La informacion fue registrada":'',
                    //     icon: r.state? "success" : "error",
                    // });
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                },
                error: function (xhr, status, error) {
                    alert("Algo salio mal, porfavor contactese con el Administrador.");
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                }
            });
        }
        // else
            // $(ele).prop('checked', false);
    });
}
function cutUpdateMonthLs(inscription,monthDebt)
{
    // console.log(typeof monthDebt);
    // console.log(monthDebt);
    // console.log('-------------')
    var listObject = JSON.parse(localStorage.getItem('__LISTCUT__'));
    for (var i = 0; i < listObject.length; i++)
    {
        if (listObject[i].numberInscription === inscription) {
            listObject[i].monthDebt = monthDebt;
            break;
        }
    }
    var updatedListString = JSON.stringify(listObject);
    localStorage.setItem('__LISTCUT__', updatedListString);
    return updatedListString;
}
function cutUpdateMonthBd(data)
{
    jQuery.ajax({
        url: "{{ route('updateRecords') }}",
        method: 'POST',
        data: {data: data},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            // console.log(r)
            notifyGlobal(r)
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        }
    });
}
function actUpdateLs(inscription, action)
{
    var listObject = JSON.parse(localStorage.getItem('__LISTCUT__'));
    for (var i = 0; i < listObject.length; i++)
    {
        if (listObject[i].numberInscription === inscription) {
            // listObject[i].courtState = '1';
            listObject[i].courtState = action ? '1':'4';
            break;
        }
    }
    var updatedListString = JSON.stringify(listObject);
    localStorage.setItem('__LISTCUT__', updatedListString);
    return updatedListString;
    // console.log('Datos actualizados en localStorage');
}
function actUpdateBd(data)
{
    jQuery.ajax({
        url: "{{ route('updateRecords') }}",
        method: 'POST',
        data: {data: data},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            console.log(r)
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        }
    });
}

function activateUserAct(ele)
{
    event.preventDefault();
    Swal.fire({
    title: $(ele).is(':checked')?"Esta seguro de activar?":"Esta seguro de cancelar activacion?",
    text: $(ele).is(':checked')?"Confirme la accion":"Al cancelar la activacion, las evidencias asociadas se eliminaran. ¿DESEA CONTINUAR?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, confirmar"
    }).then((result) => {
        if (result.isConfirmed)
        {
            $(".containerSpinner").removeClass("d-none");
            $(".containerSpinner").addClass("d-flex");
            jQuery.ajax({
                url: "{{ route('activateUser') }}",
                method: 'POST',
                data: {state: $(ele).is(':checked'),inscription: $(ele).attr('data-inscription')},
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                success: function (r) {
                    console.log(r)
                    let infoEdit;
                    let row;
                    if(r.state)
                    {
                        if(r.checked)
                        {
                            console.log('a: if(r.checked)')
                            // actualizar courtState y actualizar en base de datos
                            actUpdateBd(actUpdateLs($(ele).attr('data-inscription'),true));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTrAct').removeClass('blue-row').addClass('green-row');

                            // $(ele).parent().parent().parent().css('background','rgba(119, 163, 69, 0.5)');//caña verde
                            // $(ele).parent().parent().parent().removeClass('blue-row').addClass('green-row');

                            // $(ele).parent().find('label').html('Activado');
                            // $(ele).prop('checked', true);

                            infoEdit = tabletestAct.row(idRow);
                            row = infoEdit.data()
                            arow = row;
                            row[2]=row[2].replace('Activar', 'Activado')
                            row[2]=row[2].replace('<input', '<input checked')
                            row[13]=row[13].replace('none', 'inline')
                            row[13]=row[13].replace('data-type', 'data-type="activate"')
                            infoEdit.data(row).draw();


                            // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+$(ele).attr('data-inscription')+'">'+
                            // '<i class="fa fa-image"></i></button>';
                            // $(ele).parent().parent().parent().find('.conteinerEvidence').html(evidence);
                        }
                        else
                        {
                            console.log('a: else')
                            actUpdateBd(actUpdateLs($(ele).attr('data-inscription'),false));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTrAct').removeClass('green-row').addClass('blue-row');

                            // $(ele).parent().parent().parent().css('background','rgba(0, 0, 255, 0.5)');
                            // $(ele).parent().parent().parent().removeClass('green-row').addClass('blue-row');

                            // $(ele).parent().find('label').html('Activar');
                            // $(ele).prop('checked', false);

                            infoEdit = tabletestAct.row(idRow);
                            row = infoEdit.data()
                            arow = row;
                            row[2]=row[2].replace('Activado', 'Activar')
                            row[2]=row[2].replace('checked', ' ')
                            row[13]=row[13].replace('inline', 'none')

                            infoEdit.data(row).draw();


                            // $(ele).parent().parent().parent().find('.conteinerEvidence').html('');
                        }
                    }
                    else
                        alert('Algo salio mal, porfavor contactese con el Administrador.');
                    Swal.fire({
                        title: r.message,
                        text: r.state?"La informacion fue registrada":'',
                        icon: r.state? "success" : "error",
                    });
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                },
                error: function (xhr, status, error) {
                    alert("Algo salio mal, porfavor contactese con el Administrador.");
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                }
            });

        }
        // else
        //     $(ele).prop('checked', false);
    });
}
var arow;
function activateUser(ele)
{
    event.preventDefault();
    Swal.fire({
    title: $(ele).is(':checked')?"Esta seguro de activar?":"Esta seguro de cancelar activacion?",
    text: $(ele).is(':checked')?"Confirme la accion":"Al cancelar la activacion, las evidencias asociadas se eliminaran. ¿DESEA CONTINUAR?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, confirmar"
    }).then((result) => {
        if (result.isConfirmed)
        {
            $(".containerSpinner").removeClass("d-none");
            $(".containerSpinner").addClass("d-flex");
            jQuery.ajax({
                url: "{{ route('activateUser') }}",
                method: 'POST',
                data: {state: $(ele).is(':checked'),inscription: $(ele).attr('data-inscription')},
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                success: function (r) {
                    console.log(r)
                    let infoEdit;
                    let row;
                    if(r.state)
                    {
                        if(r.checked)
                        {
                            console.log('a: if(r.checked)')
                            // actualizar courtState y actualizar en base de datos
                            actUpdateBd(actUpdateLs($(ele).attr('data-inscription'),true));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTr').removeClass('blue-row').addClass('green-row');

                            // $(ele).parent().parent().parent().css('background','rgba(119, 163, 69, 0.5)');//caña verde
                            // $(ele).parent().parent().parent().removeClass('blue-row').addClass('green-row');

                            // $(ele).parent().find('label').html('Activado');
                            // $(ele).prop('checked', true);

                            infoEdit = tabletest.row(idRow);
                            row = infoEdit.data()
                            arow = row;
                            row[2]=row[2].replace('Activar', 'Activado')
                            row[2]=row[2].replace('<input', '<input checked')
                            row[13]=row[13].replace('none', 'inline')
                            row[13]=row[13].replace('data-type', 'data-type="activate"')
                            infoEdit.data(row).draw();


                            // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+$(ele).attr('data-inscription')+'">'+
                            // '<i class="fa fa-image"></i></button>';
                            // $(ele).parent().parent().parent().find('.conteinerEvidence').html(evidence);
                        }
                        else
                        {
                            console.log('a: else')
                            actUpdateBd(actUpdateLs($(ele).attr('data-inscription'),false));
                            let idRow = $(ele).attr('data-idRow');
                            $('.'+idRow+'idRowTr').removeClass('green-row').addClass('blue-row');

                            // $(ele).parent().parent().parent().css('background','rgba(0, 0, 255, 0.5)');
                            // $(ele).parent().parent().parent().removeClass('green-row').addClass('blue-row');

                            // $(ele).parent().find('label').html('Activar');
                            // $(ele).prop('checked', false);

                            infoEdit = tabletest.row(idRow);
                            row = infoEdit.data()
                            arow = row;
                            row[2]=row[2].replace('Activado', 'Activar')
                            row[2]=row[2].replace('checked', ' ')
                            row[13]=row[13].replace('inline', 'none')

                            infoEdit.data(row).draw();


                            // $(ele).parent().parent().parent().find('.conteinerEvidence').html('');
                        }
                    }
                    else
                        alert('Algo salio mal, porfavor contactese con el Administrador.');
                    Swal.fire({
                        title: r.message,
                        text: r.state?"La informacion fue registrada":'',
                        icon: r.state? "success" : "error",
                    });
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                },
                error: function (xhr, status, error) {
                    alert("Algo salio mal, porfavor contactese con el Administrador.");
                    $(".containerSpinner").removeClass("d-flex");
                    $(".containerSpinner").addClass("d-none");
                }
            });

        }
        // else
        //     $(ele).prop('checked', false);
    });
}
function sendEvidence(ele)
{
    // alert($(ele).attr('data-type'))
    myDropzone.removeAllFiles();
    $('#inscription').val($(ele).attr('data-inscription'))
    $('#type').val($(ele).attr('data-type'))
    $('.showCod').html($(ele).attr('data-cellCode'));
    $('.showIns').html($(ele).attr('data-cellIns'));
    $('.showCli').html($(ele).attr('data-cellCli'));
    $('.showDir').html($(ele).attr('data-cellAdr'));
    $('#modalEvidenceLabel').html($(ele).attr('data-type')=="court"?
        'Subir evidencias: <span class="badge bg-danger">CORTADO</span>':
        'Subir evidencias: <span class="badge bg-success">ACTIVADO</span>'
    );

    $('.messageEvidences').css('display','none');
    $('.overlayPage').css("display","flex");
    jQuery.ajax({
        url: "{{ route('showEvidences') }}",
        method: 'POST',
        data: {type: $(ele).attr('data-type'),inscription: $(ele).attr('data-inscription')},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            $('#modalEvidence').modal('show');
            $('.containerEvidences').html('');
            if(r.data.length!=0)
            {
                let html = '';
                for (var i = 0; i < r.data.length; i++)
                {
                    html += '<div class="card col-lg-4 p-0">'+
                            '<img src="{{env('IMAGES_BASE_URL')}}'+r.data[i].path+'" class="card-img-top">'+
                            '<div class="card-body p-1">'+
                                '<p class="card-text text-center fw-bold mb-1">'+formatDate(r.data[i].dateEvidence)+' | '+r.data[i].hour+'</p>'+
                                '<a href="#" class="btn btn-danger w-100 py-1" onclick="deleteEvidence(this)" data-idEvi="'+r.data[i].idEvi+'"><i class="fa fa-trash"></i> Eliminar</a>'+
                            '</div>'+
                        '</div>';
                }
                $('.containerEvidences').append(html);
            }
            else
                $('.messageEvidences').css('display','block');
            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            $('.overlayPage').css("display","none");
            alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });



}
function deleteEvidence(ele)
{
    $('.overlayPage').css("display","flex");
    jQuery.ajax({
        url: "{{ route('deleteEvidence') }}",
        method: 'POST',
        data: {idEvi: $(ele).attr('data-idEvi')},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            console.log(r)
            if(r.state)
                $(ele).parent().parent().remove();
            notify(r);
            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $('.overlayPage').css("display","none");
        }
    });
}
function deleteEvidenceObs(ele)
{
    $('.overlayPage').css("display","flex");
    jQuery.ajax({
        url: "{{ route('deleteEvidenceObs') }}",
        method: 'POST',
        data: {idOe: $(ele).attr('data-idOe')},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            console.log(r)
            if(r.state)
                $(ele).parent().parent().remove();
            notify(r);
            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $('.overlayPage').css("display","none");
        }
    });
}
function updateRecords()
{
    buildTable();
    fillRecords();
}
function buildTable()
{
    $('.containerRecordsCuts>div').remove();
    $('.containerRecordsCuts').html(tableRecordsCuts);
}
function fillRecords3(idAss)
{
    console.log('entro a fillRecords3')
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    jQuery.ajax({
        url: "{{ route('listCut2') }}",
        method: 'POST',
        data: {idAss: idAss},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            // console.log(typeof r.data)
            // console.log(JSON.parse(r.data)[0]["numberInscription"])
            // var sizeInBytes = new Blob([r.data]).size;
            // console.log(`El tamaño del JSON en bytes es: ${sizeInBytes}`);
            // ---------------------------------------
            // ---------------------------------------
            // ---------------------------------------
            var listString = JSON.stringify(r.data);
            // localStorage.setItem('__LISTCUT__', listString);
            localStorage.setItem('__LISTCUT__', r.data);
            if(r.state)
            {
                let htmlCourt = '';
                let countRecords = 0;
                let accordingState = '';
                let accordingStatePaid = '';
                let accordingStateCourt = '';
                let stillCut = '';
                let optionCourt = '';
                let letterCourt = '';
                let evidence = '';

                let classCut='';

                var data = JSON.parse(r.data);
                // console.log(data)
                for (var i = 0; i < data.length; i++)
                {
                    // console.log(data[i].numberInscription);
                    countRecords++;
                    if(data[i].courtState=='4')
                    {
                        stillCut = 'rgba(255, 0, 0, 0.5)';
                        classCut = 'red-row';
                        accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';
                        // '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+data[i].numberInscription+'" checked>';

                        accordingStatePaid = '';

                        evidence = "court";
                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+data[i].numberInscription+'">'+
                            // '<i class="fa fa-image"></i></button>';
                    }
                    else
                    {

                        stillCut = 'none';
                        classCut = 'none-row';
                        accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                        // '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+data[i].numberInscription+'">';
                    }
                    if(data[i].CtaMesActOld!=data[i].monthDebt && data[i].courtState=='4')
                    {
                        if(data[i].CtaMesActOld == 3 && data[i].monthDebt == 2)
                        {
                            stillCut = 'rgba(255, 0, 0, 0.5)';
                            classCut = 'red-row';
                            accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                            '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';
                            // '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+data[i].numberInscription+'" checked>';
                            accordingStatePaid = '';

                            // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+data[i].numberInscription+'">'+
                            // '<i class="fa fa-image"></i></button>';

                            evidence = "court";
                        }
                        else
                        {
                            if(data[i].CtaMesActOld<=3)
                            {
                                evidence = '';
                                if(data[i].courtState=='1')
                                {
                                    stillCut = "rgba(119, 163, 69, 0.5);";
                                    classCut = 'green-row';
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';

                                    // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+data[i].numberInscription+'">'+
                                    //     '<i class="fa fa-image"></i></button>';

                                    evidence = "activate";
                                }
                                else
                                {
                                    stillCut = "rgba(0, 0, 255, 0.5);";
                                    classCut = 'blue-row';
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                                }
                            }
                            else
                            {
                                // console.log('llego aki '+data[i].numberInscription)
                                // console.log(data[i].monthDebt)
                                if(data[i].monthDebt == 0 || data[i].monthDebt == 1)
                                {
                                    evidence = '';
                                    if(data[i].courtState=='1')
                                    {
                                        stillCut = "rgba(119, 163, 69, 0.5);";
                                        classCut = 'green-row';
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';

                                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+data[i].numberInscription+'">'+
                                        //     '<i class="fa fa-image"></i></button>';

                                        evidence = "activate";
                                    }
                                    else
                                    {
                                        stillCut = "rgba(0, 0, 255, 0.5);";
                                        classCut = 'blue-row';
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                                    }
                                }
                            }
                        }

                    }
                    if(data[i].courtState=='1')
                    {
                        stillCut = "rgba(119, 163, 69, 0.5);";
                        classCut = 'green-row';
                        accordingStateCourt = '';
                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';

                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+data[i].numberInscription+'">'+
                        //     '<i class="fa fa-image"></i></button>';

                        evidence = "activate";
                    }

                    if(data[i].CtaMesActOld!=data[i].monthDebt && data[i].courtState === null)
                    {

                        if(data[i].CtaMesActOld<=3)
                        {
                            if(data[i].CtaMesActOld == 3 && data[i].monthDebt == 2)
                            {
                                stillCut = 'none';
                                classCut = 'none-row';
                                accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                                '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                                // '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+data[i].numberInscription+'">';

                            }
                            else
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                classCut = 'activate-row';
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                                console.log('State === nul --- ActOld<=3---'+data[i].numberInscription)
                            }
                        }
                        else
                        {
                            if(data[i].monthDebt == 0)
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                classCut = 'activate-row';
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                            }
                        }
                    }

                    htmlCourt += '<tr style="background: '+stillCut+';" class="'+i+'idRowTr '+classCut+'">' +
                        '<td class="align-middle text-center">' + countRecords + '</td>' +
                        '<td class="align-middle text-center containerSwitchCourt">' +
                            '<div class="form-check form-switch">' +
                                accordingStateCourt +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center containerSwitchActivate">' +
                            '<div class="form-check form-switch">' +
                                accordingStatePaid +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center cellCode">' + novDato(data[i].code) +' - '+ novDato(data[i].cod) + '</td>' +
                        // '<td class="align-middle text-center cellCod">' + novDato(data[i].cod) + '</td>' +
                        '<td class="align-middle text-center cellIns">' + novDato(data[i].numberInscription) + '</td>'+
                        '<td class="align-middle cellCli">' + novDato(data[i].client) + '</td>'+
                        '<td class="align-middle cellAdr">' + novDato(data[i].streetDescription) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].rate) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].meter) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].monthDebt) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(Number(data[i].amount).toFixed(2)) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].serviceEnterprise) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].consumption) + '</td>'+
                        '<td class="align-middle text-center">' +
                            // '<div class="mb-0 conteinerEvidence">' +
                            //     '<button type="button" class="btn btn-primary '+i+'idRowEvi" onclick="sendEvidence(this)" data-type="'+evidence+'" data-inscription="'+data[i].numberInscription+'" style="display:'+(!isEmpty(evidence)?'inline':'none')+';">'+
                            //     '<i class="fa fa-image"></i></button>'+
                            // '</div>' +
                            '<div class="mb-0 conteinerEvidence">' +
                                '<button type="button" class="btn btn-primary '+i+'idRowEvi" onclick="sendEvidence(this)" '+
                                    'data-type="'+evidence+'" '+
                                    'data-inscription="'+data[i].numberInscription+'" '+
                                    'data-cellCode="'+ novDato(data[i].code) +' - '+ novDato(data[i].cod) + '" '+
                                    'data-cellIns="'+ novDato(data[i].numberInscription) + '" '+
                                    'data-cellCli="'+ novDato(data[i].client) + '" '+
                                    'data-cellAdr="'+ novDato(data[i].streetDescription) + '" '+
                                    'style="display:'+(!isEmpty(evidence)?'inline':'none')+';">'+
                                '<i class="fa fa-image"></i></button>'+
                            '</div>' +
                            // '<button type="button" class="btn btn-secondary mt-1" onclick="sendObs(this)" data-type="court" data-inscription="'+data[i].numberInscription+'"><i class="fa fa-comment"></i></button>'+
                            '<button type="button" class="btn btn-secondary mt-1" onclick="sendObs(this)" data-type="court" data-inscription="'+data[i].numberInscription+'" '+
                                    'data-cellCode="'+ novDato(data[i].code) +' - '+ novDato(data[i].cod) + '" '+
                                    'data-cellIns="'+ novDato(data[i].numberInscription) + '" '+
                                    'data-cellCli="'+ novDato(data[i].client) + '" '+
                                    'data-cellAdr="'+ novDato(data[i].streetDescription) + '" ><i class="fa fa-comment"></i></button>'+
                        '</td>' +
                    '</tr>';
                    accordingStateCourt='';
                    accordingStatePaid='';
                    evidence='';

                    classCut='';
                    // -----
                }
                // console.log(htmlCourt)
                $('#recordsCourt').html(htmlCourt);
                // initDatatableDD('tableCuts');
                tabletest = initDatatableDD('tableCuts');
                initDatatable('tableRehab');

                // $('.containerSpinner').css('display','none !important');
            }
            else
            {
                alert(r.message);
            }
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");

            $('.overlayPage').css("display","none");


        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        }
    });
}
function fillRecords2()
{
    console.log('entro a fillRecords2');
    $('.containerRecordsBlue').css('display','none');
    $('.containerRecordsCuts').css('display','block');
    jQuery.ajax({
        url: "{{ route('listCut') }}",
        method: 'get',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            // console.log(typeof r.data)
            // console.log(JSON.parse(r.data)[0]["numberInscription"])
            // var sizeInBytes = new Blob([r.data]).size;
            // console.log(`El tamaño del JSON en bytes es: ${sizeInBytes}`);
            // ---------------------------------------
            // ---------------------------------------
            // ---------------------------------------
            var listString = JSON.stringify(r.data);
            // localStorage.setItem('__LISTCUT__', listString);
            localStorage.setItem('__LISTCUT__', r.data);
            if(r.state)
            {
                let htmlCourt = '';
                let countRecords = 0;
                let accordingState = '';
                let accordingStatePaid = '';
                let accordingStateCourt = '';
                let stillCut = '';
                let optionCourt = '';
                let letterCourt = '';
                let evidence = '';

                let classCut='';

                var data = JSON.parse(r.data);
                // console.log(data)
                for (var i = 0; i < data.length; i++)
                {
                    // console.log(data[i].numberInscription);
                    countRecords++;
                    if(data[i].courtState=='4')
                    {
                        stillCut = 'rgba(255, 0, 0, 0.5)';
                        classCut = 'red-row';
                        accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';
                        accordingStatePaid = '';

                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+data[i].numberInscription+'">'+
                        //     '<i class="fa fa-image"></i></button>';

                        evidence = "court";
                    }
                    else
                    {

                        stillCut = 'none';
                        classCut = 'none-row';
                        accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                    }
                    if(data[i].CtaMesActOld!=data[i].monthDebt && data[i].courtState=='4')
                    {
                        if(data[i].CtaMesActOld == 3 && data[i].monthDebt == 2)
                        {
                            stillCut = 'rgba(255, 0, 0, 0.5)';
                            classCut = 'red-row';
                            accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                            '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';
                            accordingStatePaid = '';

                            // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+data[i].numberInscription+'">'+
                            // '<i class="fa fa-image"></i></button>';

                            evidence = "court";
                        }
                        else
                        {


                            if(data[i].CtaMesActOld<=3)
                            {
                                evidence = '';
                                if(data[i].courtState=='1')
                                {
                                    stillCut = "rgba(119, 163, 69, 0.5);";
                                    classCut = 'green-row';
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';

                                    // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+data[i].numberInscription+'">'+
                                    //     '<i class="fa fa-image"></i></button>';

                                    evidence = "activate";
                                }
                                else
                                {
                                    stillCut = "rgba(0, 0, 255, 0.5);";
                                    classCut = 'blue-row';
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                                }
                            }
                            else
                            {
                                // console.log('llego aki '+data[i].numberInscription)
                                // console.log(data[i].monthDebt)
                                if(data[i].monthDebt == 0 || data[i].monthDebt == 1)
                                {
                                    evidence = '';
                                    if(data[i].courtState=='1')
                                    {
                                        stillCut = "rgba(119, 163, 69, 0.5);";
                                        classCut = 'green-row';
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';

                                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+data[i].numberInscription+'">'+
                                        //     '<i class="fa fa-image"></i></button>';

                                        evidence = "activate";
                                    }
                                    else
                                    {
                                        stillCut = "rgba(0, 0, 255, 0.5);";
                                        classCut = 'blue-row';
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                                    }
                                }
                            }
                        }

                    }
                    if(data[i].courtState=='1')
                    {
                        stillCut = "rgba(119, 163, 69, 0.5);";
                        classCut = 'green-row';
                        accordingStateCourt = '';
                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'" checked>';

                        // evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+data[i].numberInscription+'">'+
                        //     '<i class="fa fa-image"></i></button>';

                        evidence = "activate";
                    }

                    if(data[i].CtaMesActOld!=data[i].monthDebt && data[i].courtState === null)
                    {

                        if(data[i].CtaMesActOld<=3)
                        {
                            if(data[i].CtaMesActOld == 3 && data[i].monthDebt == 2)
                            {
                                stillCut = 'none';
                                classCut = 'none-row';
                                accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                                '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-idRow="'+i+'" data-inscription="'+data[i].numberInscription+'">';
                            }
                            else
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                classCut = 'activate-row';
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                                console.log('State === nul --- ActOld<=3---'+data[i].numberInscription)
                            }
                        }
                        else
                        {
                            if(data[i].monthDebt == 0)
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                classCut = 'activate-row';
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                            }
                        }
                    }

                    htmlCourt += '<tr style="background: '+stillCut+';" class="'+i+'idRowTr '+classCut+'">' +
                        '<td class="align-middle text-center">' + countRecords + '</td>' +
                        '<td class="align-middle text-center containerSwitchCourt">' +
                            '<div class="form-check form-switch">' +
                                accordingStateCourt +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center containerSwitchActivate">' +
                            '<div class="form-check form-switch">' +
                                accordingStatePaid +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center cellCode">' + novDato(data[i].code) +' - '+ novDato(data[i].cod) + '</td>' +
                        // '<td class="align-middle text-center cellCod">' + novDato(data[i].cod) + '</td>' +
                        '<td class="align-middle text-center cellIns">' + novDato(data[i].numberInscription) + '</td>'+
                        '<td class="align-middle cellCli">' + novDato(data[i].client) + '</td>'+
                        '<td class="align-middle cellAdr">' + novDato(data[i].streetDescription) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].rate) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].meter) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].monthDebt) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(Number(data[i].amount).toFixed(2)) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].serviceEnterprise) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(data[i].consumption) + '</td>'+
                        '<td class="align-middle text-center">' +
                            '<div class="mb-0 conteinerEvidence">' +
                                '<button type="button" class="btn btn-primary '+i+'idRowEvi" onclick="sendEvidence(this)" '+
                                    'data-type="'+evidence+'" '+
                                    'data-inscription="'+data[i].numberInscription+'" '+
                                    'data-cellCode="'+ novDato(data[i].code) +' - '+ novDato(data[i].cod) + '" '+
                                    'data-cellIns="'+ novDato(data[i].numberInscription) + '" '+
                                    'data-cellCli="'+ novDato(data[i].client) + '" '+
                                    'data-cellAdr="'+ novDato(data[i].streetDescription) + '" '+
                                    'style="display:'+(!isEmpty(evidence)?'inline':'none')+';">'+
                                '<i class="fa fa-image"></i></button>'+
                            '</div>' +
                            '<button type="button" class="btn btn-secondary mt-1" onclick="sendObs(this)" '+
                                    'data-inscription="'+data[i].numberInscription+'" '+
                                    'data-cellCode="'+ novDato(data[i].code) +' - '+ novDato(data[i].cod) + '" '+
                                    'data-cellIns="'+ novDato(data[i].numberInscription) + '" '+
                                    'data-cellCli="'+ novDato(data[i].client) + '" '+
                                    'data-cellAdr="'+ novDato(data[i].streetDescription) + '" ><i class="fa fa-comment"></i></button>'+
                        '</td>' +
                    '</tr>';
                    accordingStateCourt='';
                    accordingStatePaid='';
                    evidence='';

                    classCut='';
                    // -----
                }
                // console.log(htmlCourt)
                $('#recordsCourt').html(htmlCourt);
                tabletest = initDatatableDD('tableCuts');
                initDatatable('tableRehab');

                // $('.containerSpinner').css('display','none !important');
            }
            else
            {
                alert(r.message);
            }
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");

            $('.overlayPage').css("display","none");


        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");
        }
    });
}
// function saveObs()
// {
    // jQuery.ajax({
    //     url: "{{ route('saveObs') }}",
    //     method: 'POST',
    //     data: {inscription: $('.oshowIns').html(),comment: $('#obs').val()},
    //     dataType: 'json',
    //     headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
    //     success: function (r) {
    //         console.log(r)
    //         $('#idObs').val(r.obs.idObs)
    //         alert('aka-'+r.obs.idObs)
    //     },
    //     error: function (xhr, status, error) {
    //         $('.overlayPage').css("display","none");
    //         alert("Algo salio mal, porfavor contactese con el Administrador.");
    //     }
    // });
// }
function sendObs(ele)
{
    $('#idObs').val('');
    myDropzoneObs.removeAllFiles()
    $('#modalObs').modal('show');
    $('#oinscription').val($(ele).attr('data-inscription'));
// ---------------------------
    $('.oshowCod').html($(ele).attr('data-cellCode'));
    $('.oshowIns').html($(ele).attr('data-cellIns'));
    $('.oshowCli').html($(ele).attr('data-cellCli'));
    $('.oshowDir').html($(ele).attr('data-cellAdr'));
    $('#obs').val('');
    // jQuery.ajax({
    //     url: "{{ route('showObs') }}",
    //     method: 'POST',
    //     data: {inscription: $(ele).attr('data-inscription')},
    //     dataType: 'json',
    //     headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
    //     success: function (r) {
    //         console.log(r)
    //         if(r.obs !== null)
    //         {
    //             $('#obs').val(r.obs.comment)
    //             $('#idObs').val(r.obs.idObs)
    //         }

    //     },
    //     error: function (xhr, status, error) {
    //         $('.overlayPage').css("display","none");
    //         alert("Algo salio mal, porfavor contactese con el Administrador.");
    //     }
    // });
// ---------------------------
    jQuery.ajax({
        url: "{{ route('showObs') }}",
        method: 'POST',
        data: {inscription: $(ele).attr('data-inscription')},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            $('.containerImagesObs').html('');
            if(r.obs!==null)
            {
                $('#obs').val(r.obs.comment)
                $('#idObs').val(r.obs.idObs)
                if(r.list!==null)
                {
                    let html = '';
                    for (var i = 0; i < r.list.length; i++)
                    {
                        html += '<div class="card col-lg-4 p-0">'+
                                '<img src="{{env('IMAGES_BASE_URL')}}'+r.list[i].path+'" class="card-img-top">'+
                                '<div class="card-body p-1">'+
                                    '<p class="card-text text-center fw-bold mb-1">'+formatDate(r.list[i].date)+' | '+r.list[i].hour+'</p>'+
                                    '<a href="#" class="btn btn-danger w-100 py-1" onclick="deleteEvidenceObs(this)" data-idOe="'+r.list[i].idOe+'"><i class="fa fa-trash"></i> Eliminar</a>'+
                                '</div>'+
                            '</div>';
                    }
                    $('.containerImagesObs').append(html);
                }
            }

            else
                $('.messageEvidences').css('display','block');
            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            $('.overlayPage').css("display","none");
            alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });

}
function showLs()
{
    console.log(JSON.parse(localStorage.getItem("__LISTCUT__")))
}
function fillRecords()
{
    $(".containerSpinner").removeClass("d-none");
    $(".containerSpinner").addClass("d-flex");
    jQuery.ajax({
        url: "{{ route('listCourtAssign') }}",
        method: 'get',
        success: function (r) {
            console.log(r.consulta)
            console.log("tiempo de la ejecucion---"+r.eje)
            console.log("tiempo del while---"+r.whi)
            console.log(r.assign.listCutsOld)
            console.log(JSON.parse(r.assign.listCutsOld))
            console.log(typeof r.assign.listCutsOld)
            console.log(JSON.parse(r.assign.listCutsOld)[0]["streetDescription"])
            console.log(JSON.parse(r.assign.listCutsOld)[0]["streetDescription"].length)

            if(r.state)
            {
                let htmlCourt = '';
                let countRecords = 0;
                let accordingState = '';
                let accordingStatePaid = '';
                let accordingStateCourt = '';
                let stillCut = '';
                let optionCourt = '';
                let letterCourt = '';
                let evidence = '';
                for (var i = 0; i < r.data.length; i++)
                {
                    countRecords++;

                    if(r.data[i].courtState=='4')
                    {
                        // console.log('cortar a este '+r.data[i].numberInscription);
                        stillCut = 'rgba(255, 0, 0, 0.5)';
                        accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+r.data[i].numberInscription+'" checked>';
                        accordingStatePaid = '';

                        evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+r.data[i].numberInscription+'">'+
                            '<i class="fa fa-image"></i></button>';
                    }
                    else
                    {

                        stillCut = 'none';
                        accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                        '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+r.data[i].numberInscription+'">';
                    }
                    // if(r.data[i].paid=='1')
                    // {
                    //     evidence = '';
                    //     if(r.data[i].courtState=='1')
                    //     {
                    //         stillCut = "rgba(119, 163, 69, 0.5);";
                    //         accordingStateCourt = '';
                    //         accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                    //         '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+r.data[i].numberInscription+'" checked>';

                    //         evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+r.data[i].numberInscription+'">'+
                    //             '<i class="fa fa-image"></i></button>';
                    //     }
                    //     else
                    //     {
                    //         stillCut = "rgba(0, 0, 255, 0.5);";
                    //         accordingStateCourt = '';
                    //         accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                    //         '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+r.data[i].numberInscription+'">';
                    //     }
                    // }

                    // console.log(r.data[i].CtaMesActOld)
                    // console.log(r.data[i].monthDebt)
                    // console.log(r.data[i].CtaMesActOld!=r.data[i].monthDebt)
                    // break;
                    if(r.data[i].CtaMesActOld!=r.data[i].monthDebt && r.data[i].courtState=='4')
                    {
                        if(r.data[i].CtaMesActOld == 3 && r.data[i].monthDebt == 2)
                        {
                            stillCut = 'rgba(255, 0, 0, 0.5)';
                            accordingStateCourt = '<label class="fw-bold">cortado</label>' +
                            '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+r.data[i].numberInscription+'" checked>';
                            accordingStatePaid = '';

                            evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+r.data[i].numberInscription+'">'+
                            '<i class="fa fa-image"></i></button>';
                        }
                        else
                        {


                            if(r.data[i].CtaMesActOld<=3)
                            {
                                evidence = '';
                                if(r.data[i].courtState=='1')
                                {
                                    stillCut = "rgba(119, 163, 69, 0.5);";
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+r.data[i].numberInscription+'" checked>';

                                    evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+r.data[i].numberInscription+'">'+
                                        '<i class="fa fa-image"></i></button>';
                                }
                                else
                                {
                                    stillCut = "rgba(0, 0, 255, 0.5);";
                                    accordingStateCourt = '';
                                    accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                    '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+r.data[i].numberInscription+'">';
                                }
                            }
                            else
                            {
                                // console.log('llego aki '+r.data[i].numberInscription)
                                // console.log(r.data[i].monthDebt)
                                if(r.data[i].monthDebt == 0 || r.data[i].monthDebt == 1)
                                {
                                    evidence = '';
                                    if(r.data[i].courtState=='1')
                                    {
                                        stillCut = "rgba(119, 163, 69, 0.5);";
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activado</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+r.data[i].numberInscription+'" checked>';

                                        evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+r.data[i].numberInscription+'">'+
                                            '<i class="fa fa-image"></i></button>';
                                    }
                                    else
                                    {
                                        stillCut = "rgba(0, 0, 255, 0.5);";
                                        accordingStateCourt = '';
                                        accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                        '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+r.data[i].numberInscription+'">';
                                    }
                                }
                            }
                        }

                    }
                    // if(r.data[i].courtState === null && r.data[i].courtState=='1')
                    // {
                    //     stillCut = "rgba(0, 255, 0, 0.5);";
                    //     accordingStateCourt = '';
                    //     accordingStatePaid = '';
                    // }


                    // if(r.data[i].numberInscription=='00139153')
                    // {
                    //     console.log(r.data[i].CtaMesActOld)
                    //     console.log(r.data[i].monthDebt)
                    //     console.log(r.data[i].courtState)
                    //     console.log(r.data[i].CtaMesActOld!=r.data[i].monthDebt)
                    //     console.log(r.data[i].courtState === null)
                    //     break;
                    // }

                    if(r.data[i].CtaMesActOld!=r.data[i].monthDebt && r.data[i].courtState === null)
                    {

                        if(r.data[i].CtaMesActOld<=3)
                        {
                            if(r.data[i].CtaMesActOld == 3 && r.data[i].monthDebt == 2)
                            {
                                stillCut = 'none';
                                accordingStateCourt = '<label class="fw-bold">sin accion</label>' +
                                '<input type="checkbox" class="form-check-input" onclick="courtUser(this)" data-inscription="'+r.data[i].numberInscription+'">';
                            }
                            else
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                                console.log('State === nul --- ActOld<=3---'+r.data[i].numberInscription)
                            }
                        }
                        else
                        {
                            if(r.data[i].monthDebt == 0)
                            {
                                stillCut = "rgba(0, 255, 0, 0.5);";
                                accordingStateCourt = '';
                                accordingStatePaid = '';
                            }
                        }
                    }

                    htmlCourt += '<tr style="background: '+stillCut+';">' +
                        '<td class="align-middle text-center">' + countRecords + '</td>' +
                        '<td class="align-middle text-center containerSwitchCourt">' +
                            '<div class="form-check form-switch">' +
                                accordingStateCourt +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center containerSwitchActivate">' +
                            '<div class="form-check form-switch">' +
                                accordingStatePaid +
                            '</div>' +
                        '</td>' +
                        '<td class="align-middle text-center cellCode">' + novDato(r.data[i].code) + '</td>' +
                        '<td class="align-middle text-center cellCod">' + novDato(r.data[i].cod) + '</td>' +
                        '<td class="align-middle text-center cellIns">' + novDato(r.data[i].numberInscription) + '</td>'+
                        '<td class="align-middle cellCli">' + novDato(r.data[i].client) + '</td>'+
                        '<td class="align-middle cellAdr">' + novDato(r.data[i].streetDescription) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].rate) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].meter) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].monthDebt) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].amount) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].serviceEnterprise) + '</td>'+
                        '<td class="align-middle text-center">' + novDato(r.data[i].consumption) + '</td>'+
                        '<td class="align-middle text-center">' +
                            '<div class="mb-0 conteinerEvidence">' +
                                evidence +
                            '</div>' +
                        '</td>' +
                    '</tr>';
                    accordingStateCourt='';
                    accordingStatePaid='';
                    evidence='';
                    // -----
                }
                $('#recordsCourt').html(htmlCourt);
                initDatatableDD('tableCuts');
                initDatatable('tableRehab');

                // $('.containerSpinner').css('display','none !important');
            }
            else
            {
                alert(r.message);
            }
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");

            $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            console.log("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
}
</script>
<script>

tabletest.on('responsive-display', function(e, datatable, row, showHide, update) {
        if (showHide) {
            // La fila se acaba de expandir
            console.log('Fila expandida');

            // Puedes acceder a los datos de la fila expandida
            var data = row.data();

            // Por ejemplo, cambiamos el valor de la columna 'cliente' (index 5)
            data[5] = 'Nuevo Cliente'; // Cambia el valor por lo que necesites

            // Actualizamos los datos de la fila
            row.data(data).draw();
        } else {
            // La fila se acaba de contraer
            console.log('Fila contraída');
        }
    });
    $('#tableCuts').on( 'draw.dt', function () {
        alert( 'Table redrawn' );
    } );
</script>
{{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script> --}}

<script src="{{asset('escn/public/plugins/datatables/dataTables.js')}}"></script>
<script src="{{asset('escn/public/plugins/datatables/dataTables.responsive.js')}}"></script>
<script src="{{asset('escn/public/plugins/datatables/responsive.dataTables.js')}}"></script>
@endsection
