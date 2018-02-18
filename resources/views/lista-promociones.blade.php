@extends('partial.default')
@section('miembros')
    {{$miembros}}
@endsection
@section('membresias')
    {{$membresias}}
@endsection
@section('contenido')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de promociones</h3>
            {{csrf_field()}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th>Duracion</th>
                    <th>Periodo</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($promociones as $promocion)
                    <tr id="promo_{{$promocion->id}}">
                        <td>{{$promocion->titulo}}</td>
                        <td>{{$promocion->detalle}}</td>
                        <td>{{$promocion->precio}}</td>
                        <td>{{$promocion->duracion}}</td>
                        <td>{{$promocion->tipoDuracion}}</td>
                        <td id="promocion_{{$promocion->id}}">
                            @if($promocion->estado==1)
                                <a href="#!" onclick="cambiar_estado_pro({{$promocion->id}},0)"><i class="fa fa-fw fa-power-off text-green"></i></a>
                            @else
                                <a href="#!" onclick="cambiar_estado_pro({{$promocion->id}},1)"><i class="fa fa-fw fa-power-off text-red"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('editar_promocion_get_path',$promocion->id)}}"><i class="text-yellow fa fa-edit fa-2x"></i></a>
                            <a onclick="eliminar_promocion({{$promocion->id}})"><i class="text-red glyphicon glyphicon-trash fa-2x"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Titulo</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th>Duracion</th>
                    <th>Periodo</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop