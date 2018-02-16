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
@endphp
@if($tipomensaje=='1')
    @foreach($membresias->take(1) as $membresia)
        <h3>Cliente encontrado</h3>
        <div class="row">
            <div class="col-lg-6">
                <table class="table">
                    <tr>
                    <tr><td><b>Dni: </b>{{$membresia->cliente->dni}}</td></tr>
                    <tr><td><b>Nombres: </b>{{$membresia->cliente->nombres}}, {{$membresia->cliente->apellidos}}</td></tr>
                    <tr><td><b>Telefono: </b>{{$membresia->cliente->telefono}}</td></tr>
                    <tr><td><b>Email: </b>{{$membresia->cliente->email}}</td></tr>
                    </tr>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                @foreach($promociones as $promocion)
                    <p class="text-info">Esta asociado a la promocion <b>{{$promocion->titulo}}</b> por un precio total de <b>S/. {{$promocion->precio}}</b> por un periodo de <b>{{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
                    <p class="text-orange"><b>Desde: {{fecha_to_string($membresia->fechaInicio)}} hasta <span id="Membresia_hasta">{{fecha_to_string($membresia->fechaFin)}}</span></b></p>
                @endforeach
            </div>
            @if($estado==1)
                <div class="col-lg-12">
                    <h4 class="text-red text-14">Este cliente no cuenta con su membresia congelada, puede proceder su operacion actual</h4>
                </div>
            @endif
            @if($estado==2)
                <div class="col-lg-12">
                    <h4 class="text-red text-14">Este cliente cuenta con su membresia congelada, una vez que amplie la fecha se descongelara su cuenta</h4>
                </div>
            @endif
        </div>

        {{--<form method="post" action="{{route('congelar_add_path')}}">--}}
        <div class="row">
            <hr>
            <h3 class="text-green">Ampliar</h3>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Hasta</label>
                    <input type="date" name="hasta" id="hasta" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="{{$membresia->id}}">
                    {{csrf_field()}}<br>
                    <button type="submit" class="btn btn-primary" onclick="ampliar_membresia()">Ampliar Mebresia</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="rpt_membresia"></div>
            </div>
        </div>
        {{--</form>--}}
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