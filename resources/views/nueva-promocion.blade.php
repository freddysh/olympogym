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
            <h3 class="box-title">Nueva promoción</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{route('nueva_promocion_path')}}" method="post">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Modalidad</label>
                                <select name="modalidad" id="modalidad" class="form-control">
                                    <option value="REGULAR">REGULAR</option>
                                    <option value="VIAJERO">VIAJERO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Titulo</label>
                            <input type="text" name="titulo" id="titulo" class="form-control validation" placeholder="Titulo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Detalle</label>
                            <textarea name="detalle" id="detalle" class="form-control validation"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" id="precio" class="form-control validation" placeholder="Precio">
                        </div>
                    </div>
                   <div class="col-lg-2">
                        <div class="form-group">
                            <label>Duracion</label>
                            <input type="number" name="duracion" id="duracion" class="form-control validation" min="1">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Periodo</label>
                            <select class="form-control" name="periodo" id="periodo">
                                <option value="Dias">Dias</option>
                                <option value="Meses">Meses</option>
                                <option value="Anios">Años</option>
                            </select>
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