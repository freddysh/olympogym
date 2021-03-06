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
    @php
    $membre=null;
    @endphp
    @foreach($membresia as $membresi)
        @php
            $membre=$membresi;
        @endphp
    @endforeach
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Editar membresia</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form name="Membresia" id="Membresia" role="form" action="{{route('editar_membresia_path')}}" method="post" enctype="multipart/form-data">
                <div id="mensaje"></div>
                @if($tipomensaje=='-1')
                    <div class="alert alert-danger" role="alert"> <strong>Error!</strong> {{$mensaje}}</div>
                @elseif($tipomensaje=='0')
                    <div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong> {{$mensaje}} </div>
                @elseif($tipomensaje=='1')
                    <div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> {{$mensaje}} </div>
            @endif

            <!-- text input -->
                <?php $id=0;?>
                @foreach($membresia as $membresi)
                        <?php $id=$membresi->id;?>
                        <div class="row">
                            {{--@foreach($membresi->cliente as $cliente)--}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Dni</label>
                                    <input type="text" name="term" id="term" class="form-control" placeholder="44942054" required value="{{$membresi->cliente->dni}} {{$membresi->cliente->nombres}} {{$membresi->cliente->apellidos}}">
                                    {{csrf_field()}}
                                </div>
                            </div>
                            {{--@endforeach--}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Promocion</label>
                                    <select class="form-control" name="promocion" id="promocion" onchange="escojer_promo()" required>
                                            <option value="0">Escoja una promocion</option>
                                            @foreach($promociones as $promo)
                                                @if($promo->id==$membresi->promocion->id)
                                                    <option value="{{$promo->id}}_{{$promo->precio}}_{{$promo->duracion}}_{{$promo->tipoDuracion}}" selected>{{$promo->titulo}} Costo:{{$promo->precio}} por {{$promo->duracion}} {{$promo->tipoDuracion}}</option>
                                                @else
                                                    <option value="{{$promo->id}}_{{$promo->precio}}_{{$promo->duracion}}_{{$promo->tipoDuracion}}">{{$promo->titulo}} Costo:{{$promo->precio}} por {{$promo->duracion}} {{$promo->tipoDuracion}}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Fecha que inicia</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control validation" required value="{{$membresi->fechaInicio}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Fecha que culmina</label>
                            <input type="date" name="fechafin" id="fechafin" class="form-control validation" required  value="{{$membresi->fechaFin}}">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" name="total" id="total" class="form-control validation" min="0" required  value="{{$membresi->total}}">
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
                            <?php $pos=0;?>
                            @foreach($membresi->cuotas as $cuotas)
                                <?php $pos++;?>
                                <tr id="elemento_{{$pos}}">
                                    <td><input type="hidden" id="id_{{$pos}}" value="{{$cuotas->id}}">
                                        <input type="hidden" name="estado[]" id="estado_{{$pos}}" value="{{$cuotas->estado}}"><input type="date" name="cuota_fecha[]" id="cuota_fecha_{{$pos}}" value="{{$cuotas->fechaCancelacion}}" required></td>
                                    <td><input type="number" name="cuota_precio[]" id="cuota_precio_{{$pos}}" value="{{$cuotas->monto}}" required></td>
                                    <td>
                                        @if($cuotas->estado==1)
                                            <a id="pagar_{{$pos}}" type="button" class="btn btn-success">Pagado</a>
                                        @else
                                            <a id="pagar_{{$pos}}" type="button" class="btn btn-primary" onclick="pagar_cuota({{$pos}})">Pagar ahora</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($cuotas->estado==0)
                                            <a href="#!" onclick="borrar_cuota({{$pos}})"><i class="text-red glyphicon glyphicon-trash fa-2x"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
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
                                    <input type="radio" name="formato" value="A" @if($membre->formato_AB=='A') {{'checked="checked"'}} @endif>Formato A
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio text-primary text-15">
                                <label>
                                    <input type="radio" name="formato" value="B" @if($membre->formato_AB=='B') {{'checked="checked"'}} @endif>Formato B
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
                                    <input type="radio" name="medio_pago" value="Pago_efetivo"  @if($membre->forma_pago=='Pago_efetivo') {{'checked="checked"'}} @endif >Pago en efectivo
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="radio text-primary text-15">
                                <label>
                                    <input type="radio" name="medio_pago" value="Debito" @if($membre->forma_pago=='Debito') {{'checked="checked"'}} @endif >Debito
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="box-footer">
                    <input type="hidden" name="cuotas" id="cuotas" value="{{$pos}}">
                    <input type="hidden" name="id" id="id" value="{{$id}}">
                    <button type="submit" class="btn btn-primary btn-lg">Guardar membresia</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script>
        CKEDITOR.replace('membresia_formato',{ height:['850px'] });
    </script>
@stop