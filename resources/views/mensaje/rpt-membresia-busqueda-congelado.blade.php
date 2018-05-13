@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@if($tipomensaje=='2')
    @foreach($membresias->take(1) as $membresia)
        <h3>Cliente encontrado</h3>
        <div class="row">
            <div class="col-lg-4">
                <table class="table">
                    <tr>
                    <tr><td><b>Dni: </b>{{$membresia->cliente->dni}}</td></tr>
                    <tr><td><b>Nombres: </b>{{$membresia->cliente->nombres}}, {{$membresia->cliente->apellidos}}</td></tr>
                    <tr><td><b>Telefono: </b>{{$membresia->cliente->telefono}}</td></tr>
                    <tr><td><b>Email: </b>{{$membresia->cliente->email}}</td></tr>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4">
                <h3>La cuenta esta congelada <span class="text-red glyphicon glyphicon-exclamation-sign" aria-hidden="hrue"></span></h3>
                @foreach($congelado as $conge)
                    @foreach($conge->congelados as $con)
                        <h4 class="text-blue"><b>Desde: </b>{{fecha_peru($con->desde)}} hasta {{fecha_peru($con->hasta)}}</h4>
                        <h4 class="text-red"><b>No se podra registrar la asistencia hasta pasar la fecha o anular el congelamiento</b></h4>
                        <a class="text-20 bg-aviso" href="{{route('congelar_path')}}"> clic aqui para anular el congelamiento</a>
                    @endforeach
                @endforeach
            </div>
            <div class="col-lg-4">
                @foreach($promociones as $promocion)
                    <p class="text-info">Esta asociado a la promocion <b>{{$promocion->titulo}}</b> por un precio total de <b>S/. {{$promocion->precio}}</b> por un periodo de <b>{{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
                    <p class="text-orange"><b>Desde: {{fecha_peru($membresia->fechaInicio)}} hasta {{fecha_peru($membresia->fechaFin)}}</b></p>
                @endforeach
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