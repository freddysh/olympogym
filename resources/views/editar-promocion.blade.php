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
            <h3 class="box-title">Editar promoción</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{route('editar_promocion_path')}}" method="post">
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
                            <label>Titulo</label>
                            <input type="text" name="titulo" id="titulo" class="form-control validation" placeholder="Titulo" value="{{$promocion->titulo}}">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$promocion->id}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Detalle</label>
                            <textarea name="detalle" id="detalle" class="form-control validation">{{$promocion->detalle}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" id="precio" class="form-control validation" placeholder="Precio"  value="{{$promocion->precio}}">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Duracion</label>
                            <input type="number" name="duracion" id="duracion" class="form-control validation" min="1"  value="{{$promocion->duracion}}">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Rol</label>
                            <select class="form-control" name="periodo" id="periodo">
                                <option value="Dias" @if($promocion->tipoDuracion=='Dias') <?php echo 'selected';?> @endif>Dias</option>
                                <option value="Meses" @if($promocion->tipoDuracion=='Meses') <?php echo 'selected';?> @endif>Meses</option>
                                <option value="Anios" @if($promocion->tipoDuracion=='Anios') <?php echo 'selected';?> @endif>Años</option>
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