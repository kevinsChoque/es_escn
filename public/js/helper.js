$('.onlyNumbers').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g,'');
});
function novDato(dato){return dato!==null && dato!==''?dato:'--';}
function initDatatable(idTable)
{
    $('#'+idTable).DataTable( {
        "autoWidth":false,
        "responsive":true,
        "ordering": false,
        "lengthMenu": [[5, 10,25, -1], [5, 10,25, "Todos"]],
        // "order": [[ 1, 'desc' ]],
        "language": {
            "info": "Mostrando la pagina _PAGE_ de _PAGES_. (Total: _MAX_)",
            "search":"",
            "infoFiltered": "(filtrando)",
            "infoEmpty": "No hay registros disponibles",
            "sEmptyTable": "No tiene registros guardados.",
            "lengthMenu":"Mostrar registros _MENU_ .",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    } );
    $('input[type=search]').parent().css('width','100%');
    $('input[type=search]').css('width','100%');
    $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
}
function initDatatableDD(idTable)
{
    $('#'+idTable).DataTable( {
        "responsive": true,
        "autoWidth":false,
        "lengthMenu": [[5, 10,25, -1], [5, 10,25, "Todos"]],
        "language": {
            "info": "Mostrando la pagina _PAGE_ de _PAGES_. (Total: _MAX_)",
            "search":"",
            "infoFiltered": "(filtrando)",
            "infoEmpty": "No hay registros disponibles",
            "sEmptyTable": "No tiene registros guardados.",
            "lengthMenu":"Mostrar registros _MENU_ .",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    } );
    $('input[type=search]').parent().css('width','100%');
    $('input[type=search]').css('width','100%');
    $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
}
function formatDate(fecha)
{
    var fecha = new Date(fecha);
    return `${fecha.getDate()+1} de ${getNameMonth(fecha.getMonth() + 1)} del ${fecha.getFullYear()}`;
}
function getNameMonth(numberMonth) {
    var month = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    return month[numberMonth - 1];
}
function notifyGlobal(resp)
{
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: resp.time,
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
function initFv(id,rules)
{
    $('#'+id).validate({
        rules: rules,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });
}
