function sideBarCollapse()
{
    if(localStorage.getItem("sbd")==1)
    {
        $('.sbd1').addClass('menu-is-opening menu-open');
        $('.sbd1>ul').css('display','block');
    }
    if(localStorage.getItem("sbd")==2)
    {
        $('.sbd2').addClass('menu-is-opening menu-open');
        $('.sbd2>ul').css('display','block');
    }
    if(localStorage.getItem("sbd")==3)
    {
        $('.sbd3').addClass('menu-is-opening menu-open');
        $('.sbd3>ul').css('display','block');
    }
    if(localStorage.getItem("sbd")==4)
    {
        $('.sbd4').addClass('menu-is-opening menu-open');
        $('.sbd4>ul').css('display','block');
    }
    if(localStorage.getItem("sbd")==5)
    {
        $('.sbd5').addClass('menu-is-opening menu-open');
        $('.sbd5>ul').css('display','block');
    }
    if(localStorage.getItem("sbd")==6)
    {
        $('.sbd6').addClass('menu-is-opening menu-open');
        $('.sbd6>ul').css('display','block');
    }
    if(localStorage.getItem("sba")==1)
    {
        $('.sba1').removeClass('bg-light');
        $('.sba1').addClass('bg-info');
    }
}
function sideBarActive()
{
    if(localStorage.getItem("sba")==2)$('.sba2').addClass('bg-info');
    if(localStorage.getItem("sba")==3)$('.sba3').addClass('bg-info');
    if(localStorage.getItem("sba")==4)$('.sba4').addClass('bg-info');
    if(localStorage.getItem("sba")==5)$('.sba5').addClass('bg-info');
    if(localStorage.getItem("sba")==6)$('.sba6').addClass('bg-info');
    if(localStorage.getItem("sba")==7)$('.sba7').addClass('bg-info');
    if(localStorage.getItem("sba")==8)$('.sba8').addClass('bg-info');
    if(localStorage.getItem("sba")==9)$('.sba9').addClass('bg-info');
    if(localStorage.getItem("sba")==10)$('.sba10').addClass('bg-info');
    if(localStorage.getItem("sba")==11)$('.sba11').addClass('bg-info');
    if(localStorage.getItem("sba")==12)$('.sba12').addClass('bg-info');
    if(localStorage.getItem("sba")==13)$('.sba13').addClass('bg-info');
    if(localStorage.getItem("sba")==14)$('.sba14').addClass('bg-info');
    if(localStorage.getItem("sba")==15)$('.sba15').addClass('bg-info');
    if(localStorage.getItem("sba")==16)$('.sba16').addClass('bg-info');
    if(localStorage.getItem("sba")==17)$('.sba17').addClass('bg-info');
    if(localStorage.getItem("sba")==18)$('.sba18').addClass('bg-info');
    if(localStorage.getItem("sba")==19)
    {
        $('.sba19').removeClass('bg-light');
        $('.sba19').addClass('bg-info');
    }
    if(localStorage.getItem("sba")==20)
    {
        $('.sba20').removeClass('bg-light');
        $('.sba20').addClass('bg-info');
    }
    if(localStorage.getItem("sba")==21)$('.sba21').addClass('bg-info');
    if(localStorage.getItem("sba")==22)$('.sba22').addClass('bg-info');
    if(localStorage.getItem("sba")==23)$('.sba23').addClass('bg-info');
}
function navBarActive()
{
    if(localStorage.getItem("nb")==1)$('.nb1').addClass('bg-info');
    if(localStorage.getItem("nb")==2)$('.nb2').addClass('bg-info');
    if(localStorage.getItem("nb")==3)$('.nb3').addClass('bg-info');
    if(localStorage.getItem("nb")==4)$('.nb4').addClass('bg-info');
    if(localStorage.getItem("nb")==5)$('.nb5').addClass('bg-info');
}
// nb5
// id de la tabla para inicializar con dattable INIT
function initDatatable(idTabla)
{
    $('#'+idTabla).DataTable( {
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
    $('input[type=search]').css('width','100%');            $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
}
function initDatatableBuscar(idTabla)
{
    $('#'+idTabla).DataTable( {
        "autoWidth":false,
        "responsive":true,
        "ordering": false,
        "lengthMenu": [[3,6,9, -1], [3,6,9, "Todos"]],   
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
    $('input[type=search]').css('width','100%');            $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
}
// id tabla de reporte
function initDatatableReport(idTabla)
{
    $('#'+idTabla).DataTable( {
        "dom":'Bfrtip',
        "buttons": [
            {   extend: 'csvHtml5',
                title: 'VEHICULOS POR EMPRESA'
            },
            {   extend: 'excelHtml5',
                title: 'VEHICULOS POR EMPRESA'
            },
            {   extend: 'pdfHtml5',
                title: 'VEHICULOS POR EMPRESA'
            },
        ],
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
    $('input[type=search]').css('width','100%');            $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
    $('.dt-buttons').css('display','block');
    $('.dt-buttons').addClass('text-center mb-3');
}
// limpiar los msj de validacion
// form = nombre del formulario del cual se quiere limpiar
function limpiarValidacion(form)
{
    var validator = $("#"+form).validate();
    validator.resetForm();
    $("#"+form+" .error").removeClass("error");
}
// verifica los campos de la tabla si son null o vacio
// dato = nombre del campo
function novDato(dato)
{
    return dato!==null && dato!=''?dato:'--';
}
function formatoTipoDoc(doc)
{
    let tipo = '';
    if(doc=='PASAPORTE')
        tipo='PAS';
    if(doc=='DNI' || doc=='dni')
        tipo='DNI';
    if(doc=='CARNET DE EXTRANJERIA')
        tipo='CEX';
    if(doc=='OTROS')
        tipo='OTR';
    return '<span class="badge badge-success">'+tipo+':</span>';
}
function formatoEstado(est)
{
    return est=='1'?'<span class="badge badge-success shadow">Activo</span>':'<span class="badge badge-danger shadow">Inactivo</span>';
}
function formatoBadge(est)
{
    return est!='--'?'<span class="badge badge-info shadow">'+est+'</span>':'--';
}
function formatoGeneral(texto,icono,valor,salt='')
{
    return valor!==null && valor!=''?texto+': <span class="badge badge-info"><i class="'+icono+'"></i> '+valor+'</span>'+salt:'';
}


// le da formato
// fecha = fecha como esta en la bd
function formatoDateHours(fecha)
{
    var date = new Date(fecha);
    const months = ["ENE", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    const formatDate = (date)=>{
        let formatted_date = '<span class="badge badge-secondary"><i class="fa fa-calendar-days"></i> '+date.getDate() + "-" + months[date.getMonth()] + "-" + date.getFullYear()+'</span> ';
        let formatted_hours = '<span class="badge badge-secondary"><i class="fa fa-clock"></i> '+date.getHours() + ":" + date.getMinutes()+'</span>';
        return formatted_date+formatted_hours;
    }
    return formatDate(date);
}
function formatoDate(fecha)
{
    var date = new Date(fecha);
    const months = ["ENE", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    const formatDate = (date)=>{
        let formatted_date = '<span class="badge badge-secondary"><i class="fa fa-calendar-days"></i> '+date.getDate() + "-" + months[date.getMonth()] + "-" + date.getFullYear()+'</span> ';
        return formatted_date;
    }
    return formatDate(date);
}
// verifica si la fecha esta vacia para dar formato
// valor = novDato(dato)
function verificarFecha(valor)
{
    if(valor=='--')
    {
        return valor;
    }
    return formatoDateHours(valor);
}
// validaciones con clases CLASES
$('.soloNumeros').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
$('.contadorDigitos').on('keyup',function(){
    let maximo = $(this).attr("maxlength");
    $(this).parent().find('.cant').html($(this).val().length+'/'+maximo);
});
//posibliemente se reemplaze FUNCIONES
// no se usa esta funcion 8 de junio
function msjSwal(estado,msj) 
{
    if(estado)
    {
        // swal(
        // {
        //     title : 'Correcto',
        //     text : msj,
        //     icon : 'success',
        //     timer: 2000
        // });
        if(msj=='eliminado')
        {
            Swal.fire(
                'Eliminado!',
                'Su registro a sido eliminado.',
                'success'
            )
        }
        else
        {
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: msj,
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
    else
    {
        new PNotify(
        {
            title : 'No se pudo proceder',
            text : '--',
            type : 'error'
        });
    }
}
function msjRee(result)
{
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        // timer: 3000
        timer:3000
    });
    if(result.estado)
    {
        Toast.fire({
            icon: 'success',
            title: result.msg
        });
    }
    else
    {
        if(result.validator)
        {
            let verifyObject = JSON.parse(result.msg);
            if(typeof verifyObject === 'object')
            {
                var msg='';
                for (const property in verifyObject) 
                {
                    console.log(`${property}: ${verifyObject[property]}`);
                    msg=msg+`${verifyObject[property]}`+'<br>';
                }
                Toast.fire({
                    icon: 'error',
                    title: msg
                });
            }
        }
        else
        {
            Toast.fire({
                icon: 'error',
                title: result.msg
            });
        }
    }
}
// posiblemente esta funcion desaparesca
function msjFiles(estado,mensaje)
{
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: estado?'success':'error',
        title: mensaje
    });
}
function msjSimple(estado,mensaje)
{
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: estado?'success':'error',
        title: mensaje
    });
}
function setInputSegunDoc(doc)
{
    $('#doc').val('');
    if(doc=="OTROS")
    {
        $('.documentoCantidad').css('display','none');
        $('.buscarDni').css('display','none');
        $('#doc').attr('maxlength','100');
    }
    else
    {
        let cantidad='12';
        $('.buscarDni').css('display','none');
        if(doc=="DNI")
        {
            $('.buscarDni').css('display','block');
            cantidad='8';
        }
        $('#doc').attr('maxlength',cantidad);
        $('.documentoCantidad').html('0/'+cantidad);
        $('.documentoCantidad').css('display','block');
    }
}
function esetInputSegunDoc(doc)
{
    $('#edoc').val('');
    if(doc=="OTROS")
    {
        $('.edocumentoCantidad').css('display','none');
        $('.ebuscarDni').css('display','none');
        $('#edoc').attr('maxlength','100');
    }
    else
    {
        let cantidad='12';
        $('.ebuscarDni').css('display','none');
        if(doc=="DNI")
        {
            $('.ebuscarDni').css('display','block');
            cantidad='8';
        }
        $('#edoc').attr('maxlength',cantidad);
        $('.edocumentoCantidad').html('0/'+cantidad);
        $('.edocumentoCantidad').css('display','block');
    }
}
$('.buscarDni').on('click',function(){
    if($('#doc').val().length==8)
    {
        jQuery.ajax(
        { 
            url: "https://www.dayangels.xyz/api/reniec/reniec-dni",
            method: 'post',
            data:{dni:$('#doc').val()},
            beforeSend(request) {
                request.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjozMDUsImNvcnJlbyI6Imtldmlucy5jaG9xdWVAZ21haWwuY29tIiwiaWF0IjoxNjU0NjI2MzY3fQ.BxPEwgV24FCAemB8lAPwgfTPhCHZs8b4IHOqQ56PLKU');
            },
            success: function(data){
                $('#nombre').val(data.result.nombres);
                $('#apellido').val(data.result.paterno+' '+data.result.materno);
                msjSimple(true,'Los datos fueron traidos exitosamente.');
            },
            error: function(data){
                msjSimple(false,'Las consultas a la RENIEC se encuentra inabilitada en estos momentos.');
            },
        });
    }
});
$('.ebuscarDni').on('click',function(){
    if($('#edoc').val().length==8)
    {
        jQuery.ajax(
        { 
            url: "https://www.dayangels.xyz/api/reniec/reniec-dni",
            method: 'post',
            data:{dni:$('#edoc').val()},
            beforeSend(request) {
                request.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjozMDUsImNvcnJlbyI6Imtldmlucy5jaG9xdWVAZ21haWwuY29tIiwiaWF0IjoxNjU0NjI2MzY3fQ.BxPEwgV24FCAemB8lAPwgfTPhCHZs8b4IHOqQ56PLKU');
            },
            success: function(data){
                $('#enombre').val(data.result.nombres);
                $('#eapellido').val(data.result.paterno+' '+data.result.materno);
                msjSimple(true,'Los datos fueron traidos exitosamente.');
            },
            error: function(data){
                msjSimple(false,'Las consultas a la RENIEC se encuentra inabilitada en estos momentos.');
            },
        });
    }
});
// -----------------------------------------------PMS
var pmsFlat='';
function pmsEntidad(ent)
{
    pmsFlat=pmsVerySim(ent);
    if(!pmsFlat.r)
        $('.btnPmsRegistrar').remove();
    else
        $('.btnPmsRegistrar').css('display','block');
}
function pmsEntidadDual(ent)
{
    pmsFlat=pmsVerySim(ent);
    if(!pmsFlat.l)
        $('.btnPmsListar').remove();
    else
        $('.btnPmsListar').css('display','block');
}
// posiblemente esta funcion ya no se use
// function pmsEntidadEsp(ent)
// {
//     pmsFlat=pmsVerySim(ent);
//     if(!pmsFlat.r)
//         $('.btnPmsRegistrar').remove();
//     else
//         $('.btnPmsRegistrar').css('display','block');
//     if(!pmsFlat.l)
//         $('.btnPmsListar').remove();
//     else
//         $('.btnPmsListar').css('display','block');
// }
pmsVerySim = function(ent)
{
    return {
        r:localStorage.getItem("pms").includes(ent+'/registrar')?true:false,
        l:localStorage.getItem("pms").includes(ent+'/listar')?true:false,
        a:localStorage.getItem("pms").includes(ent+'/editar')?true:false,
        e:localStorage.getItem("pms").includes(ent+'/eliminar')?true:false,
    };
}
function notPmsList()
{
    $('.overlayRegistros').css('display','none');
    $('.msjPms').css('display','block');
    $('.contenedorRegistros').remove();
}
function pmsShareEntidad(listEnt)
{
    for (let i = 0; i < listEnt.length; i++) 
    {
        if(!localStorage.getItem("pms").includes(listEnt[i]+'/registrar'))
        {
            $('.'+listEnt[i]+'PmsShare').remove();
        }
    }
}



