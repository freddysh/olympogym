@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
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
            <h3 class="box-title">Reporte de membresias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Membresia</th>
                    <th>Desde - hasta</th>
                    <th>Asistencia</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
                @foreach($membresiass as $membresia)
                    <?php $i++?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$membresia->cliente->dni}} {{$membresia->cliente->nombres}} {{$membresia->cliente->apellidos}}</td>
                        <td>
                            <div class="col-lg-10">
                            @foreach($promociones->where('id',$membresia->promocion_id) as $promo)
                                    {{$promo->titulo}}
                            @endforeach
                            </div>
                            <div class="col-lg-1 right"><a href="{{route('rpt_membresia_path',$membresia->id)}}" class=" text-blue">
                                    <i class="glyphicon glyphicon-print fa-2x"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{fecha_peru($membresia->fechaInicio)}} - {{fecha_peru($membresia->fechaFin)}}</td>
                        <td>
                            <a href="{{route('asistencia_view_path',$membresia->id)}}" class="text-success">
                                <i class="fa fa-eye fa-2x"></i>
                            </a>
                            <a href="{{route('rpt_asistencia_path',$membresia->id)}}" class="text-blue">
                                <i class="glyphicon glyphicon-print  fa-2x"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Membresia</th>
                    <th>Desde a hasta</th>
                    <th>Asistencia</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop