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
    <title>Reporte membresias vencidas o por vencer</title>
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
        <p class="subtitulo">Reportes de membresias vencidas o por vencer | Fecha: {{fecha_peru($fecha_actual)}}</p>
        @php
        $peri=0;
        @endphp
        @if($periodo<0)
            @php
                $peri=' Vencido hace '.$periodo*(-1).' Dias';
            @endphp
        @endif
        @if($periodo==0)
            @php
                $peri=' Hoy';
            @endphp
        @endif
        @if(0<=$periodo&&$periodo<=30)
            @php
                $peri='en '.$periodo.' Dias';
            @endphp
        @endif
        @if($periodo==60)
            @php
                $peri='en '.'2 Meses';
            @endphp
        @endif
        @if($periodo==90)
            @php
                $peri='en '.'3 Meses';
            @endphp
        @endif
        @if($periodo==180)
            @php
                $peri='en '.'6 Meses';
            @endphp
        @endif
        @if($periodo==360)
            @php
                $peri='en '.'12 Meses';
            @endphp
        @endif
        @if($periodo==480)
            @php
                $peri='en '.'16 Meses';
            @endphp
        @endif
        @if($periodo==540)
            @php
                $peri='en '.'18 Meses';
            @endphp
        @endif
        <span class="subtitulo">Se venceran {!! $peri !!} </span>

        <div class="row">
            <div class="col-lg-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="15px">#</th>
                        <th>Cliente</th>
                        <th>Cuenta</th>
                        <th>Periodo</th>
                        <th width="90px">Fecha Inicio</th>
                        <th width="90px">Fecha Fin</th>
                        <th>Tiempo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;?>
                    @foreach($membresia2 as $membresia2_)
                        @if($periodo>=0)
                            @if($fecha_actual<=$membresia2_->fechaFin && $membresia2_->fechaFin <=$fecha)
                                <?php $i++?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$membresia2_->cliente->dni}} {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}
                                        <br> Cel. {{$membresia2_->cliente->telefono}}</td>
                                    <td>
                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                            {{$promo->titulo}}
                                        @endforeach
                                        <p>S/. {{$membresia2_->total}}</p>
                                    </td>
                                    <td>
                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                            {{$promo->duracion}} {{$promo->tipoDuracion}}
                                        @endforeach
                                    </td>
                                    <td>{{fecha_peru($membresia2_->fechaInicio)}}</td>
                                    <td>{{fecha_peru($membresia2_->fechaFin)}}</td>
                                    <td>
                                        @php
                                            $datetime1 = date_create($fecha_actual);
                                            $datetime2 = date_create($membresia2_->fechaFin);
                                            $interval = date_diff($datetime1, $datetime2);
                                        @endphp
                                        @if($interval->format('%R')=='+')
                                            @if($interval->format('%a')==0)
                                                Vence hoy
                                            @else
                                                Vence en {{$interval->format('%a dias')}}
                                            @endif
                                        @else
                                            Pasó {{$interval->format('%a dias')}}
                                        @endif
                                    </td>

                                </tr>
                            @endif
                        @else
                            @if($fecha<=$membresia2_->fechaFin &&$membresia2_->fechaFin<= $fecha_actual)
                                <?php $i++?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$membresia2_->cliente->dni}} {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}
                                        <br> Cel. {{$membresia2_->cliente->telefono}}</td>
                                    <td>
                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                            {{$promo->titulo}}
                                        @endforeach
                                        <p>S/. {{$membresia2_->total}}</p>
                                    </td>
                                    <td>
                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                            {{$promo->duracion}} {{$promo->tipoDuracion}}
                                        @endforeach
                                    </td>
                                    <td>{{fecha_peru($membresia2_->fechaInicio)}}</td>
                                    <td>{{fecha_peru($membresia2_->fechaFin)}}</td>
                                    <td>
                                        @php
                                            $datetime1 = date_create($membresia2_->fechaFin);
                                            $datetime2 = date_create($fecha_actual);
                                            $interval = date_diff($datetime1, $datetime2);
                                        @endphp
                                        Vencio hace {{$interval->format('%a dias')}}
                                    </td>

                                </tr>
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                    {{--<tfoot>--}}
                    {{--<tr>--}}
                        {{--<th>#</th>--}}
                        {{--<th>Cliente</th>--}}
                        {{--<th>Cuenta</th>--}}
                        {{--<th>Fecha Inicio</th>--}}
                        {{--<th>Fecha Fin</th>--}}
                        {{--<th>Tiempo</th>--}}
                    {{--</tr>--}}
                    {{--</tfoot>--}}
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>