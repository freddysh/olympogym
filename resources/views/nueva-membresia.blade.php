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
            <h3 class="box-title">Nueva membresia</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form name="Membresia" id="Membresia" role="form" action="" method="post" enctype="multipart/form-data">
                <div id="mensaje"></div>
                @if($tipomensaje=='-1')
                    <div class="alert alert-danger" role="alert"> <strong>Error!</strong> {{$mensaje}}</div>
                @elseif($tipomensaje=='0')
                    <div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong> {{$mensaje}} </div>
                @elseif($tipomensaje=='1')
                    <div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> {{$mensaje}} </div>
                @endif

            <!-- text input -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Dni</label>
                            <input type="text" name="term" id="term" class="form-control" placeholder="44942054" required>
                            {{csrf_field()}}
                        </div>
                        <div class="" id="datos_cliente">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Promocion</label>
                            <select class="form-control" name="promocion" id="promocion" onchange="escojer_promo()" required>
                                <option value="0" disabled>Escoja una promocion</option>
                                @foreach($promociones as $promocion)
                                    <option value="{{$promocion->id}}_{{$promocion->precio}}_{{$promocion->duracion}}_{{$promocion->tipoDuracion}}">{{$promocion->titulo}} Costo:{{$promocion->precio}} por {{$promocion->duracion}} {{$promocion->tipoDuracion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Fecha que inicia</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control validation" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Fecha que culmina</label>
                            <input type="date" name="fechafin" id="fechafin" class="form-control validation" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" name="total" id="total" class="form-control validation" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Numero de cuotas</label>
                            <select class="form-control" name="cuotas" id="cuotas" required>
                                <option value="0" disabled>Escoja </option>
                                <option value="1" >1 Cuota</option>
                                <option value="2" >2 Cuotas</option>
                                <option value="3" >3 Cuotas</option>
                                <option value="4" >4 Cuotas</option>
                                <option value="5" >5 Cuotas</option>
                                <option value="6" >6 Cuotas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <a type="button" class="btn btn-primary " onclick="Generar_cuota()">Generar cuotas</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6" id="lista_cuotas">

                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary btn-lg" onclick="Envia_membresia()">Guardar membresia</button>
                    <button type="button" class="btn btn-success btn-lg" onclick="imprimir_membresia()">Impimir</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>

@stop