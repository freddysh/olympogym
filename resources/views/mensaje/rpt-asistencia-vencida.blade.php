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
@if($tipomensaje=='3')
    @foreach($membresias->take(1) as $membresia)
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th><b class="text-20">Cliente encontrado</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr><td colspan="2"><b>Dni: </b><span id="dni_b">{{$membresia->cliente->dni}}</span></td></tr>
                    <tr><td colspan="2"><b>Nombres: </b><span id="nombres_b">{{$membresia->cliente->nombres}}, {{$membresia->cliente->apellidos}}</span></td></tr>
                    <tr><td colspan="2"><b>Telefono: </b><span id="telefono_b">{{$membresia->cliente->telefono}}</span></td></tr>
                    <tr><td colspan="2"><b>Email: </b><span id="email_b">{{$membresia->cliente->email}}</span></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <h3 class="text-center text-rojo">VENCIDO</h3>
                <h3>Asistencia no registrada <span class="text-danger fa-time circle" aria-hidden="true"></span></h3>
                <h4 class="text-blue"><b>Fecha:</b>{{fecha_to_string($fecha)}} {{$hora}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(strtoupper($promocion->modalidad)=='VIAJERO')
                    <p class="text-15">Esta asociado a la promocion <b>VIAJERO | {{$promocion->titulo}}</b> por un precio total de <b>S/. {{$promocion->precio}}</b> por un periodo de <b>{{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
                    <p class="text-orange text-20"><b>Desde: {{fecha_to_string($membresia->fechaInicio)}} hasta {{fecha_to_string($membresia->fechaFin)}}</b></p>
                    <p class="text-primary text-25"><b>Asistencia # {{$nroAsistencias}} de {{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
               @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-striped">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Fecha de pago</th>
                        <th>Monto</th>
                        <th>Operacion</th>
                    </tr>
                    <?php $i=1;?>
                    @foreach($membresia->cuotas as $cuota)
                        <tr>
                            <td>{{$i}}</td>
                            <td><input type="date" name="cuota_fecha" id="cuota_fecha_'.$i.'" value="{{$cuota->fechaCancelacion}}" required disabled></td>
                            <td><input type="number" name="cuota_precio" id="cuota_precio_" value="{{$cuota->monto}}"  required disabled></td>
                            <td>
                                <input type="hidden" name="estado" id="estado_'.$i.'" value="{{$cuota->estado}}">
                                @if($cuota->estado==1)
                                    <a type="button" class="btn btn-success">Pagado</a>
                                @else
                                    <a type="button" class="btn btn-primary" onclick="pagar_cuota_ahora({{$cuota->id}})">Pagar ahora</a>
                                @endif
                            </td>
                        </tr>
                        <?php $i++;?>

                    @endforeach
                </table>
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