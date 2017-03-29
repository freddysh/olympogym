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
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos de la memebresia</h3>
                    <p for=""><b>Titulo:</b>{{$membresi->promocion->titulo}} {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</p>
                    <p for=""><b>Descripcion:</b>{{$membresi->promocion->detalle}}</p>
                    <p for=""><b>Total:</b>{{$membresi->total}}</p>
                    <p for=""><b>Fecha:</b>{{$membresi->fechaInicio}} - {{$membresi->fechaFin}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Asistencias</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha llegada</th>
                            <th>Hora llegada</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($membresi->asistemacias as $asistencia)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$asistencia->fecha}}</td>
                                <td>{{$asistencia->hora}}</td>
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