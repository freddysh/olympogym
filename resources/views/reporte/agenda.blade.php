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
            <h2 class="box-title">Agenda del {{fecha_to_string($fecha_actual)}}</h2>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <div id='calendar_agenda'></div>
                </div>
            </div>
        </div>
    </div>

@stop