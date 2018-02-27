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
</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <h2 class="titulo">Sistema de administracion de OlympoGym</h2>
        <p class="subtitulo">Reportes de membresia <?php echo date("d-m-Y")?></p>

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
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos de la memebresia</h3>
                    <p for=""><b>Titulo: </b>{{$membresi->promocion->titulo}} {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</p>
                    <p for=""><b>Descripcion: </b>{{$membresi->promocion->detalle}}</p>
                    <p for=""><b>Total: </b>{{$membresi->total}}</p>
                    <p for=""><b>Fecha: </b>{{fecha_peru($membresi->fechaInicio)}} - {{fecha_peru($membresi->fechaFin)}}</p>
                </div>
            </div>
            <div class="row">
                    @foreach($membresi->formato as $formato)
                        {!! $formato->contenido !!}
                    @endforeach

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Cuotas</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha a cancelar</th>
                            <th>Monto</th>
                            <th>Fecha cancelada</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($membresi->cuotas as $cuota)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{fecha_peru($cuota->fechaCancelacion)}}</td>
                                <td>{{$cuota->monto}}</td>
                                @if($cuota->estado==1)
                                    <td>{{fecha_peru($cuota->fechaQCancelo)}}</td>
                                    <td>Pagado</td>
                                @else
                                    <td></td>
                                    <td>Falta pagar</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach

    </div>
</div>
</body>
</html>