@php
    function fecha_to_string($fecha){
            $dia='';
            $mes='';
            $anio='';
            $fecha=explode('-',$fecha);
            $dia=$fecha[2];
            switch ($fecha[1]){
            case '01':
                $mes='Enero';
                break;
                case '02':
                $mes='Febrero';
                break;
                case '03':
                $mes='Marzo';
                break;
                case '04':
                $mes='Abril';
                break;
                case '05':
                $mes='Mayo';
                break;
                case '06':
                $mes='Junio';
                break;
                case '07':
                $mes='Julio';
                break;
                case '08':
                $mes='Agosto';
                break;
                case '09':
                $mes='Septiembre';
                break;
                case '10':
                $mes='Octubre';
                break;
                case '11':
                $mes='Noviembre';
                break;
                case '12':
                $mes='Diciembre';
                break;
            }
            $anio=$fecha[0];
            return $dia.' de '.$mes.' del '.$anio;
        }
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }

    function GetCalendario($fecha1,$Asiarray){
    # definimos los valores iniciales para nuestro calendario
    $fecha= new DateTime($fecha1.'-01');
    $month=$fecha->format("n");
    $year=$fecha->format("Y");
    $diaActual=$fecha->format("j");
    # Obtenemos el dia de la semana del primer dia
    # Devuelve 0 para domingo, 6 para sabado
    $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
    # Obtenemos el ultimo dia del mes
    $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

    $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


    $Calend='<table class="calendario">'.
        '<tr><th colspan="7" class="tituloca">'.$meses[$month].' '.$year.'</th></tr>'.
        '<tr>'.
            '<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>'.
            '<th>Vie</th><th>Sab</th><th>Dom</th>'.
        '</tr>'.
        '<tr bgcolor="silver">';
            $last_cell=$diaSemana+$ultimoDiaMes;
            // hacemos un bucle hasta 42, que es el máximo de valores que puede
            // haber... 6 columnas de 7 dias
            for($i=1;$i<=42;$i++)
            {
                if($i==$diaSemana)
                {
                    // determinamos en que dia empieza
                    $day=1;
                }
                if($i<$diaSemana || $i>=$last_cell)
                {
                    // celca vacia
                    $Calend.='<td class="vacio"></td>';
                }else{
                    // mostramos el dia
                    if(array_key_exists($day,$Asiarray))
                        $Calend.='<td class="hoy">'.$day.'<br><b>Asistio</b><br>'.$Asiarray[$day].'</td>';
                    else
                        $Calend.='<td class="no_asistio">'.$day.'<br><b>No<br>Asistio</b></td>';
                    $day++;
                }
                // cuando llega al final de la semana, iniciamos una columna nueva
                if($i%7==0)
                {
                    $Calend.='</tr><tr>';
                }
            }

        $Calend.='</tr>
        </table>';
        return $Calend;
    }
    function exists_asistencia($dia,$mes,$anio){
    $existe='';
    foreach($asistencia1 as $asis){
        if($asis->fecha==$anio.'-'.$mes.'-'.$dia){
            $existe=$asis->hora;
        }
    }
    return $existe;
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

        .calendario {
            font-family:Arial;
            font-size:12px;
            border: 1px solid #cdcdcd;
            text-align: center;
        }
        .calendario .tituloca {
            font-size: 15px;
            text-align:center;
            padding:1px 5px;
            background:#003366;
            color:#fff;
            font-weight:bold;
        }
        .calendario th {
            background:#006699;
            color:#fff;
            width:50px;
            text-align: center;
        }
        .calendario td {
            text-align:center;
            /*padding:2px 2px;*/
            background-color: rgba(255, 255, 255, 0.13);
            /*border: 1px solid #dbdbdb;*/
        }
        .calendario .hoy {
            width: 50px;
            height: 35px;
            background-color: #0d85ec52;
        }
        .calendario .no_asistio {
            width: 50px;
            height: 35px;
            background-color: #eaeaea;
        }
        .calendario .titulo {
            text-align: center;
            font-size: 15px;
        }
        .calendario .vacio {
            width: 0px;
            height: 0px;
        }
        .contenedor-fila-dato{
            width: 390px;
            height: auto;
            float: left;
        }
        .padre{
            text-align: center !important;
            margin: 0px;
            padding: 0px;
            width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <h2 class="titulo">Sistema de administracion de OlympoGym</h2>
        <p class="subtitulo">Reportes de asistencia <?php echo date("d-m-Y")?></p>

        <?php $i=0;?>
        @php
            $membresi=null;
        @endphp
        @foreach($membresia as $membresi_)
            @php
                $membresi=$membresi_;
            @endphp
        @endforeach
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos del cliente</h3>
                    <p for=""><b>Dni: </b>{{$membresi->cliente->dni}}</p>
                    <p for=""><b>Nombres: </b>{{$membresi->cliente->nombres}}</p>
                    <p for=""><b>Apellidos: </b>{{$membresi->cliente->apellidos}}</p>
                    <p for=""><b>Direccion: </b>{{$membresi->cliente->direccion}}</p>
                    <p for=""><b>Telefono: </b>{{$membresi->cliente->telefono}}</p>
                    <p for=""><b>Email: </b>{{$membresi->cliente->email}}</p>
                    {{csrf_field()}}
                    <input type="hidden" id="membresia_id" value="{{$id}}">
                </div>
                <div class="col-lg-6">
                    <h3>Datos de la membresia</h3>
                    <p for=""><b>Modalidad: </b>{{$membresi->promocion->modalidad}}</p>
                    <p for=""><b>Titulo: </b>{{$membresi->promocion->titulo}} {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</p>
                    <p for=""><b>Descripcion: </b>{{$membresi->promocion->detalle}}</p>
                    <p for=""><b>Total: </b>{{$membresi->total}}</p>
                    <p for=""><b>Fecha: </b>Desde: {{fecha_peru($membresi->fechaInicio)}} - Hasta: {{fecha_peru($membresi->fechaFin)}}</p>
                    <h3>Calendario de asistencia</h3>
                </div>
            </div>
    </div>
</div>

@if(strtoupper($membresi->promocion->modalidad))
    <table>
        <tr>
            <th>#</th>
            <th>FECHA</th>
            <th>HORA</th>
        </tr>
        @php
            $nro=0;
        @endphp
        @foreach($membresi->asistemacias as $asistencia)
            @php
                $nro++;
            @endphp
            <tr>
                <td>{{$nro}}</td>
                <td>{{fecha_to_string($asistencia->fecha)}}</td>
                <td>{{$asistencia->hora}}</td>
            </tr>
        @endforeach
    </table>
@else
    <div>
        <table>
    <tr>
    @php
    $i=0;
    @endphp
    @foreach($arrayAsistMes as $data)
        @php
            $i++;
            $fechaMes=explode('-',$data);
            $asistArray=[];
        @endphp
        @foreach($asistencia1 as $asist)
            @php
                $fechaAsistencia=explode('-',$asist->fecha);
                $dia=$fechaAsistencia[2];
                switch ($dia){
                case '01':
                    $dia=1;
                    break;
                case '02':
                    $dia=2;
                    break;
                case '03':
                    $dia=3;
                    break;
                case '04':
                    $dia=4;
                    break;
                case '05':
                    $dia=5;
                    break;
                case '06':
                    $dia=6;
                    break;
                case '07':
                    $dia=7;
                    break;
                case '08':
                    $dia=8;
                    break;
                case '09':
                    $dia=9;
                    break;
                }
            @endphp
            @if($fechaAsistencia[0]==$fechaMes[0] && $fechaAsistencia[1]==$fechaMes[1] )
                @php
                    $asistArray[$dia]=$asist->hora;
                @endphp
            @endif
        @endforeach
        <td style="vertical-align: top">
        {!! GetCalendario($data,$asistArray) !!}
        </td>
        @if(($i%2)==0)
        </tr><tr>
        @endif
    @endforeach
    </table>
    </div>
@endif
</body>
</html>