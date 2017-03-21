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
            <h3 class="box-title">Nuevo cliente</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{route('nuevo_cliente_path')}}" method="post">
                @if($tipomensaje=='-1')
                    <div class="alert alert-danger" role="alert"> <strong>Error!</strong> {{$mensaje}}</div>
                @elseif($tipomensaje=='0')
                    <div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong> {{$mensaje}} </div>
                @elseif($tipomensaje=='1')
                    <div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> {{$mensaje}} </div>
                @endif

            <!-- text input -->
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Dni</label>
                            <input type="text" name="dni" id="dni" class="form-control validation" placeholder="44942054">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control validation" placeholder="Juan Carlos">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control validation" placeholder="Valdivia Perez">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control validation" placeholder="Av. Los alamos">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control validation" placeholder="974324889">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control validation" placeholder="email@example.com">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="text" name="contrasena" id="contrasena" class="form-control validation" placeholder="44942043">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop