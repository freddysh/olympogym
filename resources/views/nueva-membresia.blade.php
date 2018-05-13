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
            <form name="Membresia" id="Membresia" action="{{route('nueva_membresia1_path')}}" method="post">
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
                    <div class="col-lg-12" id="rpt_busqueda_membresia"></div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Dni</label>
                            <input type="text" name="term" id="term" class="form-control" placeholder="44942054" required="required" onblur="buscar_membresia($('#term').val())">
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
                                @foreach($promociones as $promocion)
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
                        <div class="form-group">
                            <label for="txt_descripcion">Descripcion</label>
                            <textarea class="form-control" name="membresia_formato" id="membresia_formato" rows="5" cols="30">
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
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="cuotas" id="cuotas" value="1">
                    <button type="submit" class="btn btn-primary btn-lg" >Guardar membresia</button>
                    {{--<button type="submit" class="btn btn-primary btn-lg" onclick="Envia_membresia()">Guardar membresia</button>--}}
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script>
        CKEDITOR.replace('membresia_formato',{ height:['850px'] });
    </script>

@stop