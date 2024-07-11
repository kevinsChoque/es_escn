@extends('layout.layout')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


<link rel="stylesheet" href="{{asset('escn/public/plugins/datatables/dataTables.dataTables.css')}}">
<link rel="stylesheet" href="{{asset('escn/public/plugins/datatables/responsive.dataTables.css')}}">

<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

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
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success w-100" onclick="updateRecords()"><i class="fa fa-sync"></i> Actualizar padron</button>
                </div>
                <div class="col-lg-12 m-auto p-3 shadow containerRecordsCuts table-responsive">
                    <table id="tableCuts" class="w-100 table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="3%" class="text-center" data-priority="2">#</th>
                                <th width="6%" class="text-center" data-priority="2">CORTE</th>
                                <th width="6%" class="text-center" data-priority="2">ACTIVAR</th>
                                <th width="6%" class="text-center" data-priority="3">Codigo</th>
                                <th width="3%" class="text-center" data-priority="1">Cod</th>
                                <th width="6%" class="text-center" data-priority="1">inscri</th>
                                <th width="12%" class="text-center" data-priority="2">cliente</th>
                                <th width="9%" class="text-center" data-priority="3">direccion</th>
                                <th width="6%" class="text-center" data-priority="3">tarifa</th>
                                <th width="6%" class="text-center" data-priority="1">medidor</th>
                                <th width="3%" class="text-center" data-priority="3">meses</th>
                                <th width="9%" class="text-center" data-priority="1">monto</th>
                                <th width="6%" class="text-center" data-priority="3">servicio</th>
                                <th width="6%" class="text-center" data-priority="2">consumo</th>

                                <th width="6%" class="text-center" data-priority="1">EVIDENCIAS</th>
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
                        <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center" id="dzLoadEvidence">
                            <input type="hidden" id="inscription" name="inscription">
                            <input type="hidden" id="type" name="type">
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
<script src="{{asset('escn/public/plugins/dropzone/dropzone-min.js')}}"></script>
<link href="{{asset('escn/public/plugins/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />
<script>
var tableRecordsCuts;
var tableRecordsRehab;
// Dropzone.options.myDropzone = false;
Dropzone.autoDiscover = false;
var myDropzone = '';
$(document).ready( function ()
{
    tableRecordsCuts = $('.containerRecordsCuts').html();
    tableRecordsRehab = $('.containerRecordsRehab').html();
    fillRecords();
    initDropzone();
});
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
function initDropzone()
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
                myDropzone.processQueue();
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
        });
    }
    });
}
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
                    console.log(r)
                    let evidence = '';
                    if(r.state)
                    {
                        if(r.checked)
                        {
                            $(ele).parent().parent().parent().css('background','rgba(255, 0, 0, 0.5)');
                            $(ele).parent().find('label').html('cortado');
                            $(ele).prop('checked', true);

                            evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="court" data-inscription="'+$(ele).attr('data-inscription')+'">'+
                            '<i class="fa fa-image"></i></button>';
                            $(ele).parent().parent().parent().find('.conteinerEvidence').html(evidence);

                        }
                        else
                        {
                            $(ele).parent().parent().parent().css('background','none');
                            $(ele).parent().find('label').html('sin accion');
                            $(ele).prop('checked', false);
                            $(ele).parent().parent().parent().find('.conteinerEvidence').html('');
                        }
                    }
                    if(r.according=='paid')
                    {
                        if(r.paid)
                        {
                            $(ele).parent().parent().parent().css('background','rgba(0, 255, 0, 0.5)');
                            $(ele).parent().parent().parent().find('.containerSwitchCourt').html(' ');
                            $(ele).parent().parent().parent().find('.containerSwitchActivate').html(' ');
                        }
                        else
                        {
                            $(ele).parent().parent().parent().css('background','rgba(0, 0, 255, 0.5)');
                            let accordingStatePaid = '<label class="fw-bold">Activar</label>' +
                                '<input type="checkbox" class="form-check-input" onclick="activateUser(this)" data-inscription="'+$(ele).attr('data-inscription')+'">';
                            $(ele).parent().parent().parent().find('.containerSwitchActivate>div').html(accordingStatePaid);
                            $(ele).parent().parent().parent().find('.containerSwitchCourt').html(' ');
                        }
                        $(ele).parent().parent().parent().find('.conteinerEvidence').html('');
                    }
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
            // $(ele).prop('checked', false);
    });
}
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
                    if(r.state)
                    {
                        if(r.checked)
                        {
                            $(ele).parent().parent().parent().css('background','rgba(119, 163, 69, 0.5)');//caña verde
                            $(ele).parent().find('label').html('Activado');
                            $(ele).prop('checked', true);

                            evidence = '<button type="button" class="btn btn-primary" onclick="sendEvidence(this)" data-type="activate" data-inscription="'+$(ele).attr('data-inscription')+'">'+
                            '<i class="fa fa-image"></i></button>';
                            $(ele).parent().parent().parent().find('.conteinerEvidence').html(evidence);
                        }
                        else
                        {
                            $(ele).parent().parent().parent().css('background','rgba(0, 0, 255, 0.5)');
                            $(ele).parent().find('label').html('Activar');
                            $(ele).prop('checked', false);
                            $(ele).parent().parent().parent().find('.conteinerEvidence').html('');
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
        else
            $(ele).prop('checked', false);
    });
}
function sendEvidence(ele)
{
    $('.messageEvidences').css('display','none');
    $('.overlayPage').css("display","flex");
    jQuery.ajax({
        url: "{{ route('showEvidences') }}",
        method: 'POST',
        data: {type: $(ele).attr('data-type'),inscription: $(ele).attr('data-inscription')},
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
                            '<img src="http://localhost/escn/storage/app/public/'+r.data[i].path+'" class="card-img-top">'+
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
    $('#inscription').val($(ele).attr('data-inscription'))
    $('#type').val($(ele).attr('data-type'))
    $('#modalEvidenceLabel').html($(ele).attr('data-type')=="court"?
        'Subir evidencias: <span class="badge bg-danger">CORTADO</span>':
        'Subir evidencias: <span class="badge bg-success">ACTIVADO</span>'
    );
    $('.showCod').html($(ele).parent().parent().parent().find('.cellCode').html()+'-'+$(ele).parent().parent().parent().find('.cellCod').html());
    $('.showIns').html($(ele).parent().parent().parent().find('.cellIns').html());
    $('.showCli').html($(ele).parent().parent().parent().find('.cellCli').html());
    $('.showDir').html($(ele).parent().parent().parent().find('.cellAdr').html());
    $('#modalEvidence').modal('show');
    myDropzone.removeAllFiles();
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
function fillRecords()
{
    $(".containerSpinner").removeClass("d-none");
    $(".containerSpinner").addClass("d-flex");
    jQuery.ajax({
        url: "{{ route('listCourtAssign') }}",
        method: 'get',
        success: function (r) {
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
{{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script> --}}
<script src="{{asset('escn/public/plugins/datatables/dataTables.js')}}"></script>
<script src="{{asset('escn/public/plugins/datatables/dataTables.responsive.js')}}"></script>
<script src="{{asset('escn/public/plugins/datatables/responsive.dataTables.js')}}"></script>
@endsection
