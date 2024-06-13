<link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.min.css')}}">
<script src="{{asset('plugins/dropzone/dropzone.min.js')}}"></script>
<div class="modal fade" id="modalLoadFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLabel">Gestion de archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row containerFormImg">
                    <div class="col-lg-12 mb-3 contHeaderTabs">
                        <ul class="nav nav-pills nav-justified" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="new-file-tab" data-toggle="pill" href="#new-file" role="tab" aria-controls="new-file" aria-selected="false">Nuevo Archivo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="listar-files-tab" data-toggle="pill" href="#listar-files" role="tab" aria-controls="listar-files" aria-selected="true">Lista de Archivos</a>
                            </li>
                        </ul>
                    </div> 
                    <div class="col-lg-12 contTabs">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade" id="new-file" role="tabpanel" aria-labelledby="new-file-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label m-0">Nombre del Archivo: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm nombreFile input">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label m-0">Descripcion del Archivo:</label>
                                            <textarea class="form-control descripcion input" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center py-0" id="dSubirArchivo" style="height: 250px !important;">
                                            <input type="hidden" id="nombreFile" name="nombreFile" class="input">
                                            <input type="hidden" id="descripcion" name="descripcion" class="input">
                                            <input type="hidden" id="idRegistro" name="idRegistro">
                                            <div class="dz-default dz-message align-content-center justify-content-center">
                                                <span class="font-weight-bold font-italic">Suelta la imagen o realiza click para cargar la imagen.</span>
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                    <div class="col-lg-12 text-center mt-3">
                                        <button type="button" class="btn btn-success btn-sm saveArchivo"><i class="fa fa-save"></i> Guardar Archivo</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="listar-files" role="tabpanel" aria-labelledby="listar-files-tab">
                                <div class="table-responsive contRegFilesFact">
                                    <table id="regArchivos" class="table table-hover table-striped table-bordered dt-responsive nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" data-priority="1">Nombre</th>
                                                <th class="text-center" data-priority="2">Descripcion</th>
                                                <th class="text-center" data-priority="2">Archivo</th>
                                                <th class="text-center" data-priority="1">Opc.</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataArchivos">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 contFormEditFile" style="display: none;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert bg-primary">
                                    <p class="m-0 text-center font-weight-bold">Editando archivo</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label m-0">Nombre del Archivo: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm enombreFile einput">
                                </div>
                                <div class="form-group">
                                    <label class="control-label m-0">Descripcion del Archivo:</label>
                                    <textarea class="form-control edescripcion einput" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="alert bg-danger py-0">
                                    <p class="m-0">El archivo sera reemplazado.</p>
                                </div>
                                <form method="post" enctype="multipart/form-data" class="dropzone dz-clickable h-100 text-center py-0" id="edSubirArchivo" style="height: 250px !important;">

                                    <input type="hidden" id="enombreFile" name="enombreFile" class="einput">
                                    <input type="hidden" id="edescripcion" name="edescripcion" class="einput">
                                    <input type="hidden" id="eidRegistro" name="eidRegistro">
                                    <input type="hidden" id="eidArchivo" name="eidArchivo" class="einput">
                                    <div class="dz-default dz-message align-content-center justify-content-center">
                                        <span class="font-weight-bold font-italic">Suelta la imagen o realiza click para cargar la imagen.</span>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                            <div class="col-lg-12 text-center mt-3">
                                <button type="button" class="btn btn-light btn-sm cancelarEdicion">Cancelar edicion</button>
                                <button type="button" class="btn btn-success btn-sm guardarCambiosArchivo"><i class="fa fa-save"></i> Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1 border-transparent">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-success btn-sm saveArchivo">Guardar imagen</button> -->
            </div>
        </div>
    </div>
</div>
<script>
    // alert('el modal interno');
    var __RUTA__ = "{{asset('/')}}";
    var __EXT_ARCHIVO__ = new Array(".doc", ".docx", "pdf","application/pdf");
    $('.nombreFile').on('keyup',function(){
        $('#nombreFile').val($(this).val());
    });
    $('.descripcion').on('keyup',function(){
        $('#descripcion').val($(this).val());
    });
    $('.enombreFile').on('keyup',function(){
        $('#enombreFile').val($(this).val());
    });
    $('.edescripcion').on('keyup',function(){
        $('#edescripcion').val($(this).val());
    });
    $('.cancelarEdicion').on('click',function(){
        cancelarEdicion();
    });
    function cancelarEdicion()
    {
        $('.contFormEditFile').css('display','none');

        $('#listar-files-tab').click();
        $('.contHeaderTabs').css('display','block');
        $('.contTabs').css('display','block');
        $('.contFormEditFile').css('display','none');
    }
    function loadFile(element)
    {
        // alert($(element).attr('data-solnro'));
        $('#idRegistro').val($(element).attr('data-idFac'));
        construirTablaFiles();
        listarFileFact($('#idRegistro').val());
        $('#modalLoadFile').modal('show');
    }
    function validateForm(myDropzone2)
    {
        if($('#nombreFile').val()=='')
        {
            msjSimple(false,'Registrar el Nombre del archivo.');
        }
        else
        {
            if(myDropzone2.files.length!=0)
            {
                if(__EXT_ARCHIVO__.includes(myDropzone2.files[0].type))
                    myDropzone2.processQueue();
                else
                    msjSimple(false,'Solo se puede registrar archivos en FORMATO PDF.');
            }
            else
                msjSimple(false,'No se encontro archivos cargados.');
        }
    }
    function validateFormEdit(myDropzone3)
    {
        if($('#enombreFile').val()=='')
        {
            msjSimple(false,'Registrar el Nombre del archivo.');
        }
        else
        {
            if(myDropzone3.files.length!=0)
            {
                if(__EXT_ARCHIVO__.includes(myDropzone3.files[0].type))
                    myDropzone3.processQueue();
                else
                    msjSimple(false,'Solo se puede registrar archivos en FORMATO PDF.');
            }
            else
                msjSimple(false,'No se encontro archivos cargados.');
        }
    }
    function editarArchivo(idArchivo)
    {
        jQuery.ajax(
        { 
            url: "{{url('archivo/editar')}}",
            data: {idArchivo:idArchivo},
            method: 'get',
            success: function(r){
                $('#enombreFile,.enombreFile').val(r.data.nombreFile);
                $('#edescripcion,.edescripcion').val(r.data.descripcion);
                $('#eidRegistro').val(r.data.idSolicitud);
                $('#eidArchivo').val(r.data.idArchivo);

                $('.contHeaderTabs').css('display','none');
                $('.contTabs').css('display','none');
                $('#listar-files-tab').removeClass('active');
                $('#listar-files-tab').attr('aria-selected',false);
                $('.contFormEditFile').css('display','block');
            }
        });
    }
    function clearForm(myDropzone2)
    {
        $('.input').val('');
        myDropzone2.removeAllFiles();
        construirTablaFiles();
        listarFileFact($('#idRegistro').val());
    }
    
    function clearFormEdit(myDropzone3)
    {
        $('.einput').val('');
        myDropzone3.removeAllFiles();
        construirTablaFiles();
        listarFileFact($('#idRegistro').val());
        $('.contFormEditFile').css('display','none');
    }
    function construirTablaFiles()
    {
        $('.contRegFilesFact>div').remove();
        $('.contRegFilesFact').html(tablaDeRegistrosArchivos);
    }
    function listarFileFact(id)
    {
        jQuery.ajax(
        { 
            url: "{{url('archivo/listarFact')}}",
            data: {idFac:id},
            method: 'get',
            success: function(result){
                var html = '';
                for (var i = 0; i < result.data.length; i++) 
                {
                    html += '<tr class="text-center">' +
                        '<td>' + novDato(result.data[i].nombreFile) + '</td>' +
                        '<td>' + novDato(result.data[i].descripcion) + '</td>' +
                        '<td><a href="' +__RUTA__+ novDato(result.data[i].ruta) + '" target="_blank"><i class="fa fa-file-pdf"></i></a></td>' +
                        '<td>' +
                            '<div class="btn-group btn-group-sm" role="group">'+
                                '<button type="button" class="btn text-info" title="Editar Archivo" onclick="editarArchivo('+result.data[i].idArchivo+');"><i class="fa fa-edit" ></i></button>'+
                                '<button type="button" class="btn text-danger" title="Eliminar Archivo" onclick="eliminarArchivo('+result.data[i].idArchivo+');"><i class="fa fa-trash"></i></button>'+
                            '</div>'+
                        '</td></tr>';
                }
                $('#dataArchivos').html(html);
                initDatatable('regArchivos');
            }
        });
    }
    function eliminarArchivo(idArchivo)
    {
        Swal.fire({
            title: 'Esta seguro de eliminar el archivo?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if(result.isConfirmed)
            {
                jQuery.ajax(
                { 
                    url: "{{url('archivo/eliminar')}}",
                    data: {idArchivo:idArchivo},
                    method: 'get',
                    success: function(r){
                        // $(".overlayRegDBL").toggle(flip++%2===0);
                        construirTablaFiles();
                        listarFileFact($('#idRegistro').val());
                        msjRee(r);
                    }
                });
            }
        });
    }
    myDropzone2 = new Dropzone("#dSubirArchivo", {
        url: "{{url('archivo/registrarFact')}}",
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
            var submitButton = document.querySelector('.saveArchivo');
            myDropzone2=this;
            submitButton.addEventListener('click',function(){
                validateForm(myDropzone2);
            });
            this.on("addedfile", function (file) {
                // alert('activar boton');
                $('.guardarArchivo').css('display','block');
            });
            this.on("removedfile", function (file) {
                console.log('Se removio un archivo');
                // alert('desactivar boton');
                $('.guardarArchivo').css('display','none');
            });
            this.on('complete',function(file){
                clearForm(myDropzone2);
                msjSimple(true,'Se guardo el registro exitosamente');
                // console.log(file);
                // let imgGuardada = path+$('#codigoFaja').val()+'/'+file.name;
                // $('#imgFaja').attr('src',imgGuardada);
                
            });
        },
    });
    myDropzone3 = new Dropzone("#edSubirArchivo", {
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