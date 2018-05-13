@php

use Carbon\Carbon;
function mensaje_color($fecha){
$color='';
$dt = Carbon::now();
$dt->subHours(5);
$plazo=15;

    $datetime1 = date_create($fecha);
    $datetime2 = date_create($dt->toDateString());
    $interval = date_diff($datetime2, $datetime1);
    $valor=intval($interval->format('%R%a'));

    if($valor>=0){
        if($valor>=$plazo){
            $color='text-verde';
        }
        else{
            $color='text-info';
        }
    }
    else{
        $color='text-rojo';
    }
    return $color;
}
function mensaje_plazo($fecha){
$dt = Carbon::now();
$dt->subHours(5);
$plazo=15;

    $datetime1 = date_create($fecha);
    $datetime2 = date_create($dt->toDateString());
    $interval = date_diff($datetime2, $datetime1);

    $valor=intval($interval->format('%R%a'));

    if($valor>=0){
        if($valor==0){
            return 'VENCE HOY';
        }
        elseif($valor>=$plazo){
            return 'ACTIVO';
        }
        else{
            return 'POR VENCER le quedan '.$valor.' dias';
        }
    }
    else{
        return 'VENCIDO hace '.explode('-',$valor)[1].' dias';
    }
}
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
@endphp
@if($tipomensaje=='1')
@foreach($membresias->take(1) as $membresia)
    <div class="row">
        <div class="col-lg-4">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr><td colspan="2"><b>Dni: </b><span id="dni_b">{{$membresia->cliente->dni}}</span></td></tr>
                    <tr><td colspan="2"><b>Nombres: </b><span id="nombres_b">{{$membresia->cliente->nombres}}, {{$membresia->cliente->apellidos}}</span></td></tr>
                    <tr><td colspan="2"><b>Telefono: </b><span id="telefono_b">{{$membresia->cliente->telefono}}</span></td></tr>
                    <tr><td colspan="2"><b>Email: </b><span id="email_b">{{$membresia->cliente->email}}</span></td></tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h3 class="text-center {{mensaje_color($membresia->fechaFin)}}">{{mensaje_plazo($membresia->fechaFin)}}</h3>
            <h3>Asistencia registrada <span class="text-green glyphicon glyphicon-ok" aria-hidden="true"></span></h3>
            <h4 class="text-blue"><b>Fecha:</b>{{fecha_to_string($fecha)}} {{$hora}}</h4>
        </div>
        <div class="col-lg-4">
            @if(strtoupper($promocion->modalidad)=='VIAJERO')
                <p class="text-15">Esta asociado a la promocion <b>VIAJERO | {{$promocion->titulo}}</b> por un precio total de <b>S/. {{$promocion->precio}}</b> por un periodo de <b>{{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
                <p class="text-orange text-20"><b>Desde: {{fecha_to_string($membresia->fechaInicio)}} hasta {{fecha_to_string($membresia->fechaFin)}}</b></p>
                <p class="text-primary text-25"><b>Asistencia # {{count($asistencias)}} de {{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
            @else
                <p class="text-15">Esta asociado a la promocion <b>REGULAR | {{$promocion->titulo}}</b> por un precio total de <b>S/. {{$promocion->precio}}</b> por un periodo de <b>{{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
                <p class="text-orange text-20"><b>Desde: {{fecha_to_string($membresia->fechaInicio)}} hasta {{fecha_to_string($membresia->fechaFin)}}</b></p>
            @endif
        </div>
        <div class="col-lg-12 text-center">
            <span class="text-25 bg-success text-center">¡CLIENTE ENCONTRADO!</span><br>
            <span class="text-25 bg-success text-center">Se actualizara los datos con la nueva membresia a crear, si esta deacuerdo proceda</span>
        </div>
    </div>
@endforeach
@elseif($tipomensaje=='0')
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
            <h3>{{$mensaje}} <span class="text-orange glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></h3>
        </div>
    </div>
@elseif($tipomensaje=='-1')
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
            <h3>{{$mensaje}} <span class="text-red glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></h3>
        </div>
    </div>
@endif