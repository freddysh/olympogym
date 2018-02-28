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
                <div id="mensaje">
                    @if($tipomensaje=='-1')
                    <div class="alert alert-danger" role="alert"> <strong>Error!</strong>{{$mensaje}}</div>
                    @elseif($tipomensaje=='0')
                    <div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong>{{$mensaje}}</div>
                    @elseif($tipomensaje=='1')
                    <div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> {{$mensaje}}<a href="{{route('rpt_membresia_path',$membresia_id)}}" class="text-white"><i class="glyphicon glyphicon-print"></i></a></div>
                    @endif
                </div>

            <!-- text input -->
                <?php $id=0;?>
                @if($membresia_id!=0)
                    <?php $id=$membresi->id;?>
                    <div class="row">
                        {{--@foreach($membresi->cliente as $cliente)--}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Cliente</label>
                                <p>{{$membresi->cliente->dni}} {{$membresi->cliente->nombres}} {{$membresi->cliente->apellidos}}</p>

                            </div>
                        </div>
                        {{--@endforeach--}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Promocion</label>
                                <p>
                                    @foreach($promociones as $promo)
                                        @if($promo->id==$membresi->promocion->id)
                                            {{$promo->titulo}} costo: {{$promo->precio}} por {{$promo->duracion}} {{$promo->tipoDuracion}}
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha que inicia</label>
                                <p>{{$membresi->fechaInicio}}</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Fecha que culmina</label>
                                <p>{{$membresi->fechaFin}}</p>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Total</label>
                                <p>{{$membresi->total}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($membresi->formato as $formato)
                            <div class="col-lg-12">
                                {!! $formato->contenido !!}
                            </div>
                        @endforeach
                        <div class="col-lg-12">
                            <h3>Cuotas</h3>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Fecha de pago</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody id="lista_cuotas">
                                <?php $pos=0;?>
                                @foreach($membresi->cuotas as $cuotas)
                                    <?php $pos++;?>
                                    <tr id="elemento_{{$pos}}">
                                        <td>{{$cuotas->fechaCancelacion}}</td>
                                        <td>{{$cuotas->monto}}</td>
                                        <td>
                                            @if($cuotas->estado==1)
                                                <a type="button" class="btn btn-success" onclick="pagar_cuota({{$pos}})">Pagado</a>
                                            @else
                                                <a type="button" class="btn btn-warning" onclick="pagar_cuota({{$pos}})">Pendiente</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endif
                <div class="box-footer">
                    {{--<input type="hidden" name="cuotas" id="cuotas" value="{{$pos}}">--}}
                    {{--<button type="button" class="hide btn btn-primary btn-lg" onclick="editar_membresia({{$id}})">Guardar membresia</button>--}}
                    {{--<button type="button" class="hide btn btn-success btn-lg" onclick="imprimir_membresia()">Impimir</button>--}}
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>

@stop