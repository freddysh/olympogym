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
@extends('partial.default')
@section('miembros')
    {{$miembros}}
@endsection
@section('membresias')
    {{$membresias}}
@endsection
@section('contenido')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h2 class="box-title">Registro de asistencia</h2>
        </div>
        <div class="box-body">
            {{csrf_field()}}
            <input type="hidden" id="membresia_id" value="{{$id}}">
            <div class="row">
                <div class="col-lg-6">
                    @foreach($membresia as $membresi)
                        <div class="row">
                            <div class="col-lg-12">
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
                            <div class="col-lg-12">
                                <h3>Datos de la memebresia</h3>
                                <p for=""><b>Titulo:</b>{{$membresi->promocion->titulo}} {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</p>
                                <p for=""><b>Descripcion:</b>{{$membresi->promocion->detalle}}</p>
                                <p for=""><b>Total:</b>{{$membresi->total}}</p>
                                <p for=""><b>Fecha:</b>{{fecha_to_string($membresi->fechaInicio)}} - {{fecha_to_string($membresi->fechaFin)}}</p>
                            </div>
                        </div>
                    @endforeach
                    {{--<a href="{{route('imprimir_asistencia')}}" class="btn btn-lg btn-warning">Imprimir Asistencia</a>--}}
                </div>
                <div class="col-lg-6">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

@stop