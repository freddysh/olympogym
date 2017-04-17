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
            <h3 class="box-title">Reporte de cliente</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col s12">
                    <a href="{{route('rpt_cliente_path')}}" class="btn btn-app bg-blue">
                        <i class="glyphicon glyphicon-print"></i> Imprimir
                    </a>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
                @foreach($clientes as $cliente)
                    <?php $i++?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$cliente->dni}}</td>
                        <td>{{$cliente->nombres}}, {{$cliente->apellidos}}</td>
                        <td>{{$cliente->direccion}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>
                            @if($cliente->estado==1)
                                Habilitado
                            @else
                                Deshabilitado
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Dni</th>
                    <th>Nombres</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop