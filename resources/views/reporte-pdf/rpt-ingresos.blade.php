<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        .subtitulo{
            font-size: 20px;
            padding-top: 10px;
            padding-bottom: 5px;
            color: #222d32;
            font-family: Tahoma, Helvetica, Arial;
        }
        .subtitulo1{
            font-size: 13px;
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
        <p class="subtitulo">Reportes de ingresos <span class="subtitulo1"><?php echo date("d-m-Y")?></span> </p>
        <p class="subtitulo">Fechas: {{$desde}} hasta {{$hasta}}</p>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th width="520px">Membresia</th>
                <th width="70px">Cuotas</th>
                <th width="90px">fecha</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;?>
            <?php $st=0;?>
            @foreach($ingresos as $ingreso)
                <?php $contador=0;?>
                @foreach($ingreso->cuotas as $cuota)
                    @if($cuota->estado=='1')
                        <?php $contador=1;?>
                    @endif
                @endforeach
                <?php if($contador==1){ $i++?>
                <tr>
                    <td>{{$i}}</td>
                    <td>
                        <p class="text-blue">{{$ingreso->promocion->titulo}} x {{$ingreso->promocion->duracion}} {{$ingreso->promocion->tipoDuracion}}</p>
                        <p>Cliente: {{$ingreso->cliente->dni}} {{$ingreso->cliente->nombres}} {{$ingreso->cliente->apellidos}}</p>
                    </td>
                    <td>
                        @foreach($ingreso->cuotas as $cuota)
                            @if($cuota->estado=='1')
                                <?php $st+=$cuota->monto;?>
                                <p>{{$cuota->monto}}</p>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($ingreso->cuotas as $cuota)
                            @if($cuota->estado=='1')
                                <?php
                                $dated = new \DateTime($cuota->fechaQCancelo);
                                ?>
                                <p><?php echo $dated->format('d-m-Y');?></p>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <?php }?>
            @endforeach
            <td></td>
            <td><b>Total</b></td>
            <td><b><?php echo number_format($st, 2, '.', '');?></b></td>
            <td></td>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>