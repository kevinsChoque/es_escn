<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>EMUSAP</title>
        <link rel="stylesheet" href="{{asset('escn/public/css/spinnerPage.css')}}">
        <script src="{{asset('escn/public/plugins/sweetalert2/sweetalert2.11.js')}}"></script>
        {{-- <script src="{{asset('escn/public/js/helper.js')}}"></script> --}}
    </head>
    <body style="background-image: linear-gradient(to right, rgb(49 76 181), rgb(3 97 18));">
        <div class="overlayPage">
            <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
                <div class="ldio-onxyanc9oyh">
                    <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                </div>
            </div>
        </div>
{{-- ------------------------------- --}}
        <form id="photoForm" enctype="multipart/form-data">
            <input type="file" id="cameraInput" accept="image/*" capture="environment" style="display:none;">
            <button type="button" id="takePhoto" class="btn btn-primary">Tomar Foto</button>
            <p id="errorMsg" style="display:none; color:red; margin-top:10px;">Este dispositivo no es compatible con la cámara.</p>
            <img id="preview" style="display:none; max-width:100%; margin-top:10px;" />
        </form>

        <!-- Incluye el token CSRF de Laravel -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
<script>
$(document).ready(function () {
    // Detectar si el dispositivo es móvil
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    $('#takePhoto').on('click', function () {
        if (isMobile) {
            // Si es un móvil, abrir la cámara
            $('#cameraInput').click();
        } else {
            // Mostrar un mensaje de error si no es un móvil
            $('#errorMsg').show().text('Este dispositivo no es compatible con la cámara.');
        }
    });

    // Mostrar la foto seleccionada
    $('#cameraInput').on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const preview = $('#preview');
            preview.attr('src', URL.createObjectURL(file)).show(); // Mostrar la foto
            $('#errorMsg').hide(); // Ocultar mensaje de error si estaba visible

            // Opcional: enviar automáticamente la foto al servidor
            const formData = new FormData();
            formData.append('photo', file);

            // $.ajax({
            //     url: '/upload-photo', // Ruta al controlador Laravel
            //     method: 'POST',
            //     data: formData,
            //     processData: false,
            //     contentType: false,
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
            //     },
            //     success: function (response) {
            //         alert(response.message);
            //     },
            //     error: function (xhr) {
            //         alert('Error al subir la foto: ' + xhr.responseJSON.message);
            //     }
            // });
        }
    });
});

</script>
{{-- ------------------------------- --}}
        <div class="container-fluid">
            <div class="row" style="height: 100vh;">
                <div class="col-md-6 m-auto">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                        <form id="fvLogin">
                            <div class="card-body shadow text-center">
                                <img src="{{asset('escn/public/bannerLogin.png')}}" class="img-fluid rounded-top"/>
                                <br>
                                <br>
                                <div class="form-floating">
                                    <input type="text" class="form-control onlyNumbers" id="dni" name="dni" placeholder="DNI" maxlength="8">
                                    <label for="dni">DNI</label>
                                </div>
                                <br>
                                {{-- <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password"  placeholder="Contraseña">
                                    <label for="password">Contraseña</label>
                                </div> --}}
                                {{-- <br> --}}
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary sig-in" type="button">Ingresar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        $(document).ready( function () {
            $('.overlayPage').css("display","none");
        } );
        $('.sig-in').on('click',function(){
            var formData = new FormData($("#fvLogin")[0]);
            $('.sig-in').prop('disabled',true);
            $('.overlayPage').css("display","flex");
            jQuery.ajax({
                url: "{{ route('login') }}",
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                success: function (r) {
                    console.log(r)
                    if (r.estado)
                        window.location.href = "{{route('home')}}";
                    else
                    {
                        $('.overlayPage').css("display","none");
                        $('.sig-in').prop('disabled',false);
                        // msjRee(r);
                        notifyGlobal(r)
                    }
                },
                error: function (xhr, status, error) {
                    $('.overlayPage').css("display","none");
                    $('.sig-in').prop('disabled',false);
                    console.log(false,'Ocurrio un problema, porfavor contactese con el administrador');
                }
            });
        });
    </script>
    <script src="{{asset('escn/public/js/helper.js')}}"></script>
</html>
