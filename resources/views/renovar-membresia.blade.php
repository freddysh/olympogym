@extends('partial.default')
@section('miembros')
    {{$miembros}}
@endsection
@section('membresias')
    {{$membresias}}
@endsection
@section('archivos-js')
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('contenido')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Nueva membresia</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form name="Membresia" id="Membresia" action="{{route('renovar_membresia_path')}}" method="post" enctype="multipart/form-data">
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
                    <div id="cliente_encontrado" class="col-lg-12">

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Dni</label>
                            <input type="text" name="term" id="term" class="form-control ui-autocomplete-input" placeholder="44942054" required="required" onblur="buscar_membresia_existentes($('#term').val())" autocomplete="off">
                            {{csrf_field()}}
                        </div>
                        <div class="" id="datos_cliente">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Promocion</label>
                            <select class="form-control" name="promocion" id="promocion" onchange="escojer_promo()" required>
                                <option value="0">Escoja una promocion</option>
                                @foreach($promociones->where('estado','1') as $promocion)
                                    <option value="{{$promocion->id}}_{{$promocion->precio}}_{{$promocion->duracion}}_{{$promocion->tipoDuracion}}">[{{$promocion->modalidad}}] | {{$promocion->titulo}} Costo:{{$promocion->precio}} por {{$promocion->duracion}} {{$promocion->tipoDuracion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Fecha que inicia</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control validation" required onchange="calcular_fecha_venc()">
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

                    <div class="col-lg-12">
                        <h3>Cuotas</h3>
                        <a type="button" class="btn btn-primary " onclick="agregar_cuota()"><i class="glyphicon glyphicon-plus"></i> Cuotas</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Fecha de pago</th>
                                <th>Monto</th>
                                <th>Operacion</th>
                            </tr>
                            </thead>
                            <tbody id="lista_cuotas">
                                <tr id="elemento_1">
                                    <td><input type="hidden" name="estado[]" id="estado_1" value="0"><input type="date" name="cuota_fecha[]" id="cuota_fecha_1" value="{{date("Y-m-d")}}" required></td>
                                    <td><input type="number" name="cuota_precio[]" id="cuota_precio_1"  required></td>
                                    <td><a id="pagar_1" type="button" class="btn btn-primary" onclick="pagar_cuota(1)">Pagar ahora</a></td>
                                    <td><a href="#!" onclick="borrar_cuota(1)"><i class="text-red glyphicon glyphicon-trash fa-2x"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="txt_descripcion">Formato</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio text-primary text-15">
                                <label>
                                    <input type="radio" name="formato" value="A" checked="checked">Formato A
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio text-primary text-15">
                                <label>
                                    <input type="radio" name="formato" value="B">Formato B
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="txt_descripcion">Medio de pago</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio text-primary text-15">
                                <label>
                                    <input type="radio" name="medio_pago" value="Pago_efetivo" checked="checked">Pago en efectivo
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio text-primary text-15">
                                <label>
                                    <input type="radio" name="medio_pago" value="Debito">Debito
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="cuotas" id="cuotas" value="1">
                    <button type="submit" class="btn btn-primary btn-lg">Renovar membresia</button>

                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script>

        CKEDITOR.replace('membresia_formato',{ height:['850px'] });
    </script>
@stop