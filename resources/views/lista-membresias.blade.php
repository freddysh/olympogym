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
            <h3 class="box-title">Lista de clientes</h3>
            {{csrf_field()}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>Promocion</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($membresias2 as $membresia)
                    <tr>
                        <td>{{$membresia->cliente->dni}} {{$membresia->cliente->nombres}} {{$membresia->cliente->apellidos}}</td>
                        <td>{{$membresia->user->name}} {{$membresia->user->apellidos}}</td>
                        <td>{{$membresia->promocion->titulo}}</td>
                        <td>{{$membresia->fechaInicio}}</td>
                        <td>{{$membresia->fechaFin}}</td>
                        <td>{{$membresia->total}}</td>
                        <td id="membresia_{{$membresia->id}}">
                            @if($membresia->estado==1)
                                <a href="#!" ><i class="fa fa-fw fa-power-off text-green"> Activo</i></a>
                            @else
                                <a href="#!" ><i class="fa fa-fw fa-power-off text-red"> Vencido</i></a>
                            @endif
                        </td>
                        <td><a href="{{route('editar_membresia_get_path',$membresia->id)}}"><i class="text-yellow fa fa-edit fa-2x"></i></a>
                            <a href="#!"><i class="text-red glyphicon glyphicon-trash fa-2x"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>Promocion</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop