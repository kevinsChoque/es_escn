@extends('layout.layout')
@section('content')
<div class="container-fluid mt-1">
    <div class="card shadow bg-light">
        <div class="card-header">
            <h6 class="m-0">Lista de asignaciones del ultimo periodo programado</h6>
        </div>
        <div class="d-none justify-content-center containerSpinner" style="background: rgb(199 206 213 / 50%);height: 100%;
        position: absolute;width: 100%;z-index: 1000000;">
            <div class="spinner-border m-auto text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <table id="tableCuts" class="w-100 table table-hover table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="3%" class="text-center" data-priority="2">DNI</th>
                                <th width="6%" class="text-center" data-priority="2">TECNICO</th>
                                <th width="6%" class="text-center" data-priority="2">MES</th>
                                <th width="6%" class="text-center" data-priority="3">ETIQUETA</th>
                                <th width="6%" class="text-center" data-priority="1">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="recordsAssign">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready( function ()
{
    $('.overlayPage').css("display","none");
    fillRecords();
});
// $('.deleteRecords').on('click',function(){
//     alert('aki')
// })
function deleteRecords(idAss)
{
    event.preventDefault();
    Swal.fire({
    title: "Esta seguro de eliminar la asignacion?",
    text: "Confirme la accion ¿DESEA CONTINUAR?",
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
                url: "{{ route('deleteAssign') }}",
                method: 'POST',
                data: {state: $(ele).is(':checked'),inscription: $(ele).attr('data-inscription')},
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                success: function (r) {
                    console.log(r)
                    Swal.fire({
                        title: r.message,
                        text: r.state?"La informacion fue eliminada":'',
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
function fillRecords()
{
    $(".containerSpinner").removeClass("d-none");
    $(".containerSpinner").addClass("d-flex");
    jQuery.ajax({
        url: "{{ route('listAssign') }}",
        method: 'get',
        success: function (r) {
            console.log(r)

            if(r.state)
            {
                $('#recordsAssign').html('');
                let html = '';
                for (var i = 0; i < r.data.length; i++)
                {
                    html += '<tr>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].dni) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].name) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].month) + '</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].flat) + '</td>'+
                        '<td class="align-middle text-center">' +
                            '<button class="btn btn-danger" onclick="deleteRecords('+r.data[i].idAss+')"><i class="fa fa-trash"></i> Eliminar</button>'
                        '</td>' +
                    '</tr>';
                }
                $('#recordsAssign').html(html);
            }
            // else
            // {
            //     alert(r.message);
            // }
            $(".containerSpinner").removeClass("d-flex");
            $(".containerSpinner").addClass("d-none");

            // $('.overlayPage').css("display","none");
        },
        error: function (xhr, status, error) {
            console.log("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
}
</script>
@endsection
