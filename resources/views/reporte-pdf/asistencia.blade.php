@php
function fecha_peru($fecha){
$fecha=explode('-',$fecha);
return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
}
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Membresia</title>
    <style>
        h3{
            color: #3c8dbc;
        }
        .subtitulo{
            font-size: 20px;
            padding-top: 10px;
            padding-bottom: 5px;
            color: #222d32;
            font-family: Tahoma, Helvetica, Arial;
        }
        .titulo{
            padding: 10px;
            color: #f7f7f7;
            background: #3c8dbc;
            font-family: Tahoma, Helvetica, Arial;
            text-align: center;
        }
        th {
            background-color: #367fa9;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
    <script type="text/php">
      if (isset($pdf))
        {
          $font = Font_Metrics::get_font("Arial", "bold");
          $pdf->page_text(765, 550, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
        }
    </script>
    <link href="{{elixir('css/fullcalendar.print.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <h2 class="titulo">Sistema de administracion de OlympoGym</h2>
        <p class="subtitulo">Reportes de asistencia <?php echo date("d-m-Y")?></p>

        <?php $i=0;?>
        @foreach($membresia as $membresi)
            <?php $i++?>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos del cliente</h3>
                    <p for=""><b>Dni:</b>{{$membresi->cliente->dni}}</p>
                    <p for=""><b>Nombres:</b>{{$membresi->cliente->nombres}}</p>
                    <p for=""><b>Apellidos:</b>{{$membresi->cliente->apellidos}}</p>
                    <p for=""><b>Direccion:</b>{{$membresi->cliente->direccion}}</p>
                    <p for=""><b>Telefono:</b>{{$membresi->cliente->telefono}}</p>
                    <p for=""><b>Email:</b>{{$membresi->cliente->email}}</p>
                    {{csrf_field()}}
                    <input type="hidden" id="membresia_id" value="{{$id}}">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos de la memebresia</h3>
                    <p for=""><b>Titulo:</b>{{$membresi->promocion->titulo}} {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</p>
                    <p for=""><b>Descripcion:</b>{{$membresi->promocion->detalle}}</p>
                    <p for=""><b>Total:</b>{{$membresi->total}}</p>
                    <p for=""><b>Fecha:</b>{{fecha_peru($membresi->fechaInicio)}} - {{fecha_peru($membresi->fechaFin)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div id='calendar'></div>
                </div>
            </div>
        @endforeach

    </div>
</div>
<script src="{{asset('js/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.js')}}"></script>
<script>
    $(document).ready(function() {
        var evt=[];
        $.ajax({
            url:'/membresia/asistencia-get/'+$('#membresia_id').val(),
            type:'GET',
            dataType:'JSON',
            async:false
        }).done(function(r){
            evt=r;
        });
        $('#calendar').fullCalendar({
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,basicWeek,basicDay'
            },
            eventLimit: true,
            events:evt
        })
    });
</script>
</body>
</html>