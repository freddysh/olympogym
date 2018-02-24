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
            <h3 class="box-title">Lista de usuarios</h3>
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
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->dni}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->apellidos}}</td>
                        <td>{{$usuario->telefono}}</td>
                        <td>{{$usuario->email}}</td>
                        <td id="usuario_{{$usuario->id}}">
                            @if($usuario->estado==1)
                                <a class="btn btn-success" href="#!" onclick="cambiar_estado({{$usuario->id}},0)"><i class="fa fa-fw fa-power-off"></i></a>
                                @else
                                <a class="btn btn-danger" href="#!" onclick="cambiar_estado({{$usuario->id}},1)"><i class="fa fa-fw fa-power-off"></i></a>
                            @endif
                        </td>
                        <td>{{$usuario->tipoPersonal}}</td>
                        <td><a class="btn btn-warning" href="{{route('editar_usuario_get_path',$usuario->id)}}"><i class="fa fa-edit"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Operaciones</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop