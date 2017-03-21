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
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->dni}}</td>
                        <td>{{$cliente->nombres}}</td>
                        <td>{{$cliente->apellidos}}</td>
                        <td>{{$cliente->direccion}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->email}}</td>
                        <td id="cliente_{{$cliente->id}}">
                            @if($cliente->estado==1)
                                <a href="#!" onclick="cambiar_estado_cli({{$cliente->id}},0)"><i class="fa fa-fw fa-power-off text-green"></i></a>
                            @else
                                <a href="#!" onclick="cambiar_estado_cli({{$cliente->id}},1)"><i class="fa fa-fw fa-power-off text-red"></i></a>
                            @endif
                        </td>
                        <td><a href="{{route('editar_cliente_get_path',$cliente->id)}}"><i class="fa fa-edit"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Operaciones</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop