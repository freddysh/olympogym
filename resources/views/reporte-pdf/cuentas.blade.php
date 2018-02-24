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
    <title>Reporte cuentas por cobrar</title>
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
        <p class="subtitulo">Reportes de cuentas por cobrar <?php echo date("d-m-Y")?></p>
        <div class="row">
            <div class="col-lg-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Cuenta</th>
                        <th>Fecha Contrato</th>
                        <th>Fecha a cancelar</th>
                        <th>Total</th>
                        <th>Deuda a pagar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;?>
                    @foreach($membresia2 as $membresia2_)
                        @foreach($membresia2_->cuotas->where('estado',0)->take(1) as $cuota)
                            @if($fecha_actual<=$cuota->fechaCancelacion && $cuota->fechaCancelacion <=$fecha)
                                <?php $i++?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$membresia2_->cliente->dni}} {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}
                                        <br> Cel. {{$membresia2_->cliente->telefono}}</td>
                                    <td>
                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                            {{$promo->titulo}}
                                        @endforeach
                                    </td>
                                    <td>Desde: {{fecha_peru($membresia2_->fechaInicio)}} - Hasta {{fecha_peru($membresia2_->fechaFin)}}</td>
                                    <td>{{fecha_peru($cuota->fechaCancelacion)}}</td>
                                    <td>{{$membresia2_->total}}</td>
                                    <td>{{$cuota->monto}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Cuenta</th>
                        <th>Fecha Contrato</th>
                        <th>Fecha a cancelar</th>
                        <th>Total</th>
                        <th>Deuda a pagar</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>