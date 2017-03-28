
function cambiar_estado(id,estado){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/cambiar_estado_usuario', {id: id,estado:estado}, function(markup) {
        if(estado==1){
            $('#usuario_'+id).html('<a href="" onclick="cambiar_estado('+id+',0)"><i class="fa fa-fw fa-power-off text-green"></i></a>');
        }
        else{
            $('#usuario_'+id).html('<a href="" onclick="cambiar_estado('+id+',1)"><i class="fa fa-fw fa-power-off text-red"></i></a>');
        }
    }).fail(function (markup) {

    });
}

function cambiar_estado_cli(id,estado){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/cambiar_estado_cliente', {id: id,estado:estado}, function(markup) {
        if(estado==1){
            $('#cliente_'+id).html('<a href="" onclick="cambiar_estado_cli('+id+',0)"><i class="fa fa-fw fa-power-off text-green"></i></a>');
        }
        else{
            $('#cliente_'+id).html('<a href="" onclick="cambiar_estado_cli('+id+',1)"><i class="fa fa-fw fa-power-off text-red"></i></a>');
        }
    }).fail(function (markup) {
        console.log(markup);
    });
}
function guardar_asistencia(){
    var dni=$("#term").val();
    console.log('dni:'+dni);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/asistencia', {dni: dni}, function(markup) {
        $('#respusta').html(markup);
        // var rpt=markup.split('_');
        // if(rpt[0]==1){
        //     var rpt1=markup.split('/');
        //     var cuotas=rpt1[1];
        //     var rpt1=rpt1[2].split('_');
        //     var membresia='<p>el cliente esta asociado mediante la promocion '+rpt1[0]+' por un monto de '+rpt1[1]+' por '+rpt1[3]+' '+rpt1[1]+'</p>';
        //     $('#respusta').html('' +
        //         '<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> Se registro la asistencia del cliente con dni nro: '+dni+' <p>Cliente: '+rpt[1]+' '+rpt[2]+'</p><p>Fecha: '+rpt[3]+' '+rpt[4]+'</p></div>' +
        //         membresia+
        //         cuotas);
        // }
        // else if(rpt[0]==0){
        //     $('#respusta').html('<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> No existe el cliente con dni nro: '+dni+'</div>');
        // }
    }).fail(function (markup) {
        $('#respusta').html(markup);
    });
}
function buscar_membresia(){
    var dni=$("#term").val();
    console.log('dni:'+dni);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/buscar_cuotas', {dni: dni}, function(markup) {
        $('#respusta').html(markup);
        // var rpt=markup.split('_');
        // if(rpt[0]==1){
        //     var rpt1=markup.split('/');
        //     var cuotas=rpt1[1];
        //     var rpt1=rpt1[2].split('_');
        //     var membresia='<p>el cliente esta asociado mediante la promocion '+rpt1[0]+' por un monto de '+rpt1[1]+' por '+rpt1[3]+' '+rpt1[1]+'</p>';
        //     $('#respusta').html('' +
        //         '<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> Se registro la asistencia del cliente con dni nro: '+dni+' <p>Cliente: '+rpt[1]+' '+rpt[2]+'</p><p>Fecha: '+rpt[3]+' '+rpt[4]+'</p></div>' +
        //         membresia+
        //         cuotas);
        // }
        // else if(rpt[0]==0){
        //     $('#respusta').html('<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> No existe el cliente con dni nro: '+dni+'</div>');
        // }
    }).fail(function (markup) {
        $('#respusta').html(markup);
    });
}
function cambiar_estado_pro(id,estado){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/cambiar_estado_promocion', {id: id,estado:estado}, function(markup) {
        var rpt=markup.split('_');
        if(estado==1){
            $('#promocion_'+id).html('<a href="" onclick="cambiar_estado_cli('+id+',0)"><i class="fa fa-fw fa-power-off text-green"></i></a>');
        }
        else{
            $('#promocion_'+id).html('<a href="" onclick="cambiar_estado_cli('+id+',1)"><i class="fa fa-fw fa-power-off text-red"></i></a>');
        }
    }).fail(function (markup) {

    });
}
function Buscar_cliente(){
    var dni=$("#dni").val();
    if(dni.length>0){
        $('#datos_cliente').html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/buscar_cliente', {dni: dni}, function(markup) {
            $('#datos_cliente').html(markup);
        }).fail(function (markup) {
            $('#datos_cliente').html('');
        });
    }
}

function escojer_promo(){
    var promo=$('#promocion').val().split('_');
    $('#total').val(promo[1]);
}
function escojer_fecha(){
    var promo=$('#promocion').val().split('_');
    var fecha=$('#fechaInicio').val();
    fecha=new Date(fecha);
    var dia=fecha.getDate()+1;
    var mes=fecha.getMonth()+1;
    var anio=fecha.getFullYear();
    console.log('fecha inicio:'+anio+'-'+mes+'-'+dia);

    if(promo[3]=='Dias') {
        dia=fecha.getDate()+1;
        console.log('dias'+promo[2]);
    }
    if(promo[3]=='Meses') {
        mes=fecha.getMonth()+1;
        console.log('Meses'+promo[2]);
    }
    if(promo[3]=='Anios') {
        anio=fecha.getFullYear()+1;
        console.log('Anios'+promo[2]);
    }
    console.log('fecha fin:'+anio+'-'+mes+'-'+dia);
    $('#fechafin').val(anio+'-'+mes+'-'+dia);
}
function Generar_cuota(){
    var cuotas=$("#cuotas").val();
    console.log('cuotas'+cuotas);

    if(cuotas>0){
        $('#lista_cuotas').html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/generar_cuotas', {cuotas: cuotas}, function(markup) {
            $('#lista_cuotas').html(markup);
        }).fail(function (markup) {
            $('#lista_cuotas').html('');
        });
    }
}
function pagar_cuota(cuota){
    if($("#estado_"+cuota).val()==0){
        $("#estado_"+cuota).val(1);
        $("#pagar_"+cuota).removeClass('btn-primary');
        $("#pagar_"+cuota).addClass('btn-success');
        $("#pagar_"+cuota).html('Pagado');
    }
    else if($("#estado_"+cuota).val()==1){
        $("#estado_"+cuota).val(0);
        $("#pagar_"+cuota).removeClass('btn-success');
        $("#pagar_"+cuota).addClass('btn-primary');
        $("#pagar_"+cuota).html('Pagar ahora');
    }
}
function Envia_membresia(){
        var estado= '';
        jQuery("input[name='estado']").each(function(){
            estado+= $(this).val() + '[]';
        });
        estado=estado.substring(0, estado.length-2);
        var cuota_fecha= '';
        jQuery("input[name='cuota_fecha']").each(function(){
            cuota_fecha+= $(this).val() + '[]';
        });
        cuota_fecha=cuota_fecha.substring(0, cuota_fecha.length-2);
        var cuota_precio= '';
        jQuery("input[name='cuota_precio']").each(function(){
            cuota_precio+= $(this).val() + '[]';
        });
    cuota_precio=cuota_precio.substring(0, cuota_precio.length-2);

        console.log('estado:'+estado);
        console.log('cuota_fecha:'+cuota_fecha);
        console.log('cuota_precio:'+cuota_precio);
        $.ajax({
            type: 'POST',
            url: '/nueva_membresia',
            // data: $('#form_plan').serializeArray(),
            data: $('#Membresia').serialize()+'&&estado='+estado+'&&cuota_fecha='+cuota_fecha+'&&cuota_precio='+cuota_precio,
            // data:valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data){
                data=data.split('_');
                // $('#lista_cuotas').html(data);
                if(data[0]=='-1')
                    $('#mensaje').html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong> '+data[1]+'</div>');
                else if(data[0]=='0')
                    $('#mensaje').html('<div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong> '+data[1]+'</div>');
                else if(data[0]=='1')
                    $('#mensaje').html('<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> '+data[1]+'</div>');
                $('#term').val();
                $('#fechaInicio').val();
                $('#fechafin').val();
                $('#total').val();
                $("#promocion option[value="+ 0 +"]").attr("selected",true);
                $('#lista_cuotas').html('');
            }
        });

}
var nrocuotas=1;
function agregar_cuota() {
    nrocuotas=parseInt($('#cuotas').val());
    nrocuotas++;
    $('#cuotas').val(nrocuotas);
    $('#lista_cuotas').append('' +
        '<tr id="elemento_'+nrocuotas+'">'+
            '<td><input type="hidden" name="estado" id="estado_'+nrocuotas+'" value="0"><input type="date" name="cuota_fecha" id="cuota_fecha_'+nrocuotas+'" value="'+Date("Y-m-d")+'" required></td>'+
            '<td><input type="number" name="cuota_precio" id="cuota_precio_'+nrocuotas+'"  required></td>'+
            '<td><a id="pagar_'+nrocuotas+'" type="button" class="btn btn-primary" onclick="pagar_cuota('+nrocuotas+')">Pagar ahora</a></td>'+
            '<td><a href="#!" onclick="borrar_cuota('+nrocuotas+')"><i class="text-red glyphicon glyphicon-trash fa-2x"></i></a></td>'+
        '</tr>');
}

function borrar_cuota(pos) {
    $('#elemento_'+pos).remove();
}
function editar_membresia(id){
    var estado= '';
    jQuery("input[name='estado']").each(function(){
        estado+= $(this).val() + '[]';
    });
    estado=estado.substring(0, estado.length-2);
    var cuota_fecha= '';
    jQuery("input[name='cuota_fecha']").each(function(){
        cuota_fecha+= $(this).val() + '[]';
    });
    cuota_fecha=cuota_fecha.substring(0, cuota_fecha.length-2);
    var cuota_precio= '';
    jQuery("input[name='cuota_precio']").each(function(){
        cuota_precio+= $(this).val() + '[]';
    });
    cuota_precio=cuota_precio.substring(0, cuota_precio.length-2);

    console.log('estado:'+estado);
    console.log('cuota_fecha:'+cuota_fecha);
    console.log('cuota_precio:'+cuota_precio);
    $.ajax({
        type: 'POST',
        url: '/editar_membresia',
        // data: $('#form_plan').serializeArray(),
        data: $('#Membresia').serialize()+'&&estado='+estado+'&&cuota_fecha='+cuota_fecha+'&&cuota_precio='+cuota_precio+'&&id='+id,
        // data:valor,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data){
            data=data.split('_');
            // $('#lista_cuotas').html(data);
            if(data[0]=='-1')
                $('#mensaje').html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong> '+data[1]+'</div>');
            else if(data[0]=='0')
                $('#mensaje').html('<div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong> '+data[1]+'</div>');
            else if(data[0]=='1')
                $('#mensaje').html('<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> '+data[1]+'</div>');
            // $('#term').val();
            // $('#fechaInicio').val();
            // $('#fechafin').val();
            // $('#total').val();
            // $("#promocion option[value="+ 0 +"]").attr("selected",true);
            // $('#lista_cuotas').html('');
        }
    });

}
function pagar_cuota_ahora(id) {
    var estado=$("#estado_"+id).val();

    $.ajax({
        type: 'POST',
        url: '/pagar_cuota_ahora',
        // data: $('#form_plan').serializeArray(),
        data: 'id='+id,
        // data:valor,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data){
            // $("#estado_"+cuota).val(0);

            if(data==1){
                $("#estado_"+id).val(1);
                $("#pagar_"+id).removeClass('btn-primary');
                $("#pagar_"+id).addClass('btn-success');
                $("#pagar_"+id).html('Pagado');
            }
            else{
                // $("#estado_"+cuota).val(0);
                // $("#pagar_"+id).removeClass('btn-success');
                // $("#pagar_"+id).addClass('btn-primary');
                // $("#pagar_"+id).html('Pagar ahora');
            }
        }
    });
}

function mostrar_asistencia(){
    var dni=$("#term").val();
    console.log('dni:'+dni);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/asistencia_clientes', {dni: dni}, function(markup) {
        $('#respusta').html(markup);
        // var rpt=markup.split('_');
        // if(rpt[0]==1){
        //     var rpt1=markup.split('/');
        //     var cuotas=rpt1[1];
        //     var rpt1=rpt1[2].split('_');
        //     var membresia='<p>el cliente esta asociado mediante la promocion '+rpt1[0]+' por un monto de '+rpt1[1]+' por '+rpt1[3]+' '+rpt1[1]+'</p>';
        //     $('#respusta').html('' +
        //         '<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> Se registro la asistencia del cliente con dni nro: '+dni+' <p>Cliente: '+rpt[1]+' '+rpt[2]+'</p><p>Fecha: '+rpt[3]+' '+rpt[4]+'</p></div>' +
        //         membresia+
        //         cuotas);
        // }
        // else if(rpt[0]==0){
        //     $('#respusta').html('<div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> No existe el cliente con dni nro: '+dni+'</div>');
        // }
    }).fail(function (markup) {
        $('#respusta').html(markup);
    });
}