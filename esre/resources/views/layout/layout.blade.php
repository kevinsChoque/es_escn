<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EMUSAP</title>
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/all/all.min.css')}}">
    <!-- Theme style ADMIN LTE CSS -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    
    <!-- ---------------- -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <!-- -------------- -->
    <!-- jquery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    
    <!-- para validaciones -->
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('plugins/validate/translateMsgValidate.js')}}"></script>
    <!-- para notificaciones y alertas -->
    <link rel="stylesheet" href="{{asset('css/pnotify.custom.min.css')}}">
    <script src="{{asset('js/pnotify.custom.min.js')}}"></script>
    <!-- start cambiado porq ya esta desfasado -->
    <!-- <script src="{{asset('js/sweetalert.min.js')}}"></script> -->
    <!-- end cambiado porq ya esta desfasado -->
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- estart esto posiblemente se eliminara -->
    <!-- //------------pone dos barras negras en la tabla REEMPLAZAR -->
    <!-- <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"> -->
    <!-- js de datatable -->
    <!-- <script src="{{asset('js/jquery.dataTables.min.js')}}"></script> -->
    <!-- end esto posiblemente se eliminara -->
    <!-- start datatablae archivos de ahi -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="{{asset('plugins/datatable/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatable/responsive.bootstrap4.min.css')}}">
    <!-- end datatable archivos de ahi -->

    <!-- select 2 -->
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <!-- dropzone para subir archivos -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.min.css')}}">
    <!-- Subir archivos -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="{{asset('plugins/dropzone/dropzone.min.js')}}"></script>
    <!-- propiedades generales -->
    <link rel="stylesheet" href="{{asset('css/general.css')}}">
    <!-- modificaciones en los mensajes de jsvalidate -->
    <script src="{{asset('js/modificacionJqueryValidate.js')}}"></script>
    <script>
        var __API__='{{ env('API') }}';
    </script>
    <script>
        // verifyToken
        // jQuery.ajax(
        // { 
        //     url: __API__+"auth/verifyToken",
        //     data:{key:localStorage.getItem("__token__")},
        //     method: 'post',
        //     // beforeSend(request) {
        //     //     request.setRequestHeader('Authorization', localStorage.getItem("token"));
        //     // },
        //     success: function(result){
        //         console.log(result);
        //         // localStorage.setItem("token",'');
        //         // window.location.href = "{{url('login')}}";
        //         // window.location.href = "{{url('logout')}}";

        //         if(!result.state) window.location.href = "{{url('login')}}";
        //     },
        //     error: function(result){
        //         console.log(result);
        //         // window.location.href = "{{url('login')}}";
        //     },
        // });
    </script>
</head>
<body class="hold-transition sidebar-mini layout-boxed layout-fixed">
    
    <div class="wrapper" style="max-width: 100%;">
        @include('layout.secciones.navbar')
        @include('layout.secciones.sidebar')
        <div class="content-wrapper py-3">
            <div class="overlayPagina">
                <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
                    <div class="ldio-onxyanc9oyh">
                        <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                    </div>
                </div>
            </div>
            @yield('contenido')
        </div>
        @include('layout.secciones.footer')


        <!-- Control Sidebar -->
        <!-- <aside class="control-sidebar control-sidebar-dark"> -->
        <!-- Control sidebar content goes here -->
        <!-- </aside> -->
        <!-- /.control-sidebar -->
    </div>
    <!-- jQuery -->
    <!-- <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script> -->
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App js-->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

    <!-- start datatablae archivos de ahi -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script> -->
<script src="{{asset('plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
<!-- end datatable archivos de ahi -->
<!-- select 2 -->
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- ------------------------------------ -->
@yield('forReport')
<!-- ------------------------------------ -->
<script>
    var __API__='{{ env('API') }}';
</script>
<!-- mi propio script funciones generales -->
<script src="{{asset('js/helper.js')}}"></script>
<script>
$(document).ready( function () {
    sideBarCollapse();
    sideBarActive();
    navBarActive();
} );
$('.logout').on('click',function(){
    jQuery.ajax(
    { 
        url: "http://127.0.0.1:8000/api/auth/logout",
        method: 'post',
        beforeSend(request) {
            request.setRequestHeader('Authorization', localStorage.getItem("token"));
        },
        success: function(result){
            console.log(result);
            localStorage.setItem("token",'');
            // window.location.href = "{{url('login')}}";
            localStorage.setItem("__token__",'');
            window.location.href = "{{url('logout')}}";
        },
        error: function(result){
            console.log(result);
            localStorage.setItem("__token__",'');
            window.location.href = "{{url('login')}}";
        },
    });
})
</script>
@if(Session::has('globalMessage'))
<script>
$(function()
{
    @if(Session::get('type')=='error')
        @foreach(explode('__BREAKLINE__', Session::get('globalMessage')) as $value)
            @if(trim($value)!='')
                new PNotify(
                {
                    title : 'No se pudo proceder',
                    text : '{{$value}}',
                    type : '{{Session::get('type')}}'
                });
            @endif
        @endforeach
    @else
        swal(
        {
            title : '{{Session::get('type')=='success' ? 'Correcto' : 'Alerta'}}',
            text : '{!!Session::get('globalMessage')!!}',
            icon : '{{Session::get('type')=='success' ? 'success' : 'warning'}}',
            timer: {{Session::get('type')=='success' ? '2000' : '60000'}}
        });
    @endif
});
</script>
@endif
</body>
</html>
