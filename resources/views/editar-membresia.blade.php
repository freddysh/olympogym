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
                    @if(count($membresi->formato)>0)
                        @foreach($membresi->formato as $formato)
                            <div class="col-lg-12">
                                <textarea name="membresia_formato" id="membresia_formato" >
                                    {!! $formato->contenido !!}
                                </textarea>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <textarea name="membresia_formato" id="membresia_formato" >
                                <h3>CONGELAMIENTO</h3>
                                <ul>
                                    <li>En caso de los acuerdos de membresia de 3 meses, 6 meses y 12 meses; cancelados al contado, le permiten al
                                        cliente el derecho de ausentarse y recuperar los dias no asistidos a Olympo Fitness & Wellness al final de su
                                        acuerdo de membresia.
                                        <ul>
                                            <li>Membresia de 03 meses, por ausencia 10 dias recuperables</li>
                                            <li>Membresia de 06 meses, por ausencia 20 dias recuperables</li>
                                            <li>Membresia de 12 meses, por ausencia 40 dias recuperables</li>
                                        </ul>
                                    </li>
                                    <li>
                                        Olympo Fitness & Wellness evaluara el sustento correspondiente del cliente, para otorgar los días recuperables ofrecidos
                                    </li>
                                </ul>
                                <h3>RESPONSABILIDAD</h3>
                                <ul>
                                    <li>Olympo Fitness & Wellness, le garantiza al socio el monto de la cuota pactada por todo el periodo elegido.
                                    </li>
                                    <li>El cliente se responsabiliza por los daños que pudiera causara las instalaciones y/o mobiliario de Olympo Fitness &
                                        Wellness como consecuencias de practicas negligenteso usos incorretos de los equipos sin la supervision de un trainer,
                                        debidamente comprobados.
                                    </li>
                                    <li>El cliente libera y exonera a Olympo Fitness & Wellness de cualquier responsabilidad civil y/o penal, por lesiones
                                        corporales, daños a la propiedad, homicidio culposo causado por negligencia en la que el socio hubiera incurrido.
                                    </li>
                                    <li>La empresa no se responsabiliza de perdida o robo de los objetos personales dentro de nnuestras instalaciones.
                                    </li>
                                    <li>El cliente se responsabiliza por todo menor de 18 años de edad que ingrese a Olympo Fitness & Wellness bajo su custodia.
                                    </li>
                                    <li>Olympo Fitness & Wellness se reserva el derecho de dar por concluido en cualquier momento el acuerdo de membresia
                                        unilateralmente impedir el ingreso del miembro que falte a la mora, a las buenas costumbres, que en forma negligente
                                        ocacione daños a las instalaciones y/o de Olympo Fitness & Wellnesso que realice acto que signifique falta de
                                        higiene o limpieza.
                                    </li>
                                    <li>
                                        Olympo Fitness & Wellness evaluara el sustento correspondiente del cliente, para otorgar los días recuperables ofrecidos
                                    </li>
                                </ul>
                                <h3>RESOLUCION Y DISPOSICIONES FINALES</h3>
                                <ul>
                                    <li>Las cantidades pagadas por concepto de matricula, acuerdo de membresia no son reembosables, si el socio
                                        decidiera dar termino al contrato de membresia.
                                    </li>
                                    <li>Olympo Fitness & Wellness modificarar los horarios grupales sin previo aviso.
                                    </li>
                                </ul>
                                <h3>OBSERVACIONES DE SALUD</h3>
                                <p>
                                    ----------------------------------------------------------------------------------------------------------------------------------
                                </p>
                                <p class="text-right">
                                    Cusco.......... de ....................... del 20....
                                </p>
                                <p class="text-right">
                                    <b>PLAZA TUPAC AMARU 114 WANCHAQ</b><br>
                                    <b>TELF: (084)254798</b>
                                </p>
                                <p class="text-center">
                                    -----------------------------------<br>
                                    Olympo Fitness & Wellness
                                </p>
                                <p class="text-center">
                                    -----------------------------------<br>
                                    Cliente
                                </p>
                            </textarea>
                        </div>
                    @endif
                </div>
                @endforeach
                <div class="box-footer">
                    <input type="hidden" name="cuotas" id="cuotas" value="{{$pos}}">
                    <input type="hidden" name="id" id="id" value="{{$id}}">

                @foreach($membresi->formato as $formato)
                    <input type="hidden" name="formato_id" id="formato_id" value="{{$formato->id}}">
                    @endforeach
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