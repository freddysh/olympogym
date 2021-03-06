@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@if($tipomensaje=='1')
    @foreach($membresias->take(1) as $membresia)
        <h3>Cliente encontrado</h3>
        <div class="row">
            <div class="col-lg-6">
                <table class="table">
                    <tr>
                    <tr><td><b>Dni: </b>{{$membresia->cliente->dni}}</td></tr>
                    <tr><td><b>Nombres: </b>{{$membresia->cliente->nombres}}, {{$membresia->cliente->apellidos}}</td></tr>
                    <tr><td><b>Telefono: </b>{{$membresia->cliente->telefono}}</td></tr>
                    <tr><td><b>Email: </b>{{$membresia->cliente->email}}</td></tr>
                    </tr>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                @foreach($promociones as $promocion)
                    <p class="text-info">Esta asociado a la promocion <b>{{$promocion->titulo}}</b> por un precio total de <b>S/. {{$promocion->precio}}</b> por un periodo de <b>{{$promocion->duracion}} {{$promocion->tipoDuracion}}</b></p>
                    <p class="text-orange"><b>Desde: {{fecha_peru($membresia->fechaInicio)}} hasta {{fecha_peru($membresia->fechaFin)}}</b></p>
                @endforeach
            </div>
        </div>
        <h3>Congelamientos realizados</h3>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-striped">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Desde</th>
                        <th>hasta</th>
                        <th>Observacion</th>
                    </tr>
                    <?php $i=1;?>
                    @foreach($congelados as $congelado)
                        <tr id="Congelado_{{$congelado->id}}">
                            <td>{{$i}}</td>
                            <td><input type="date" name="cuota_fecha" id="cuota_fecha_'.$i.'" value="{{$congelado->desde}}" required disabled></td>
                            <td><input type="date" name="cuota_fecha" id="cuota_fecha_'.$i.'" value="{{$congelado->hasta}}" required disabled></td>
                            <td>
                                <a type="button" class="btn btn-primary" id="descongelar_{{$congelado->id}}" onclick="descongelar({{$congelado->id}})">Descongelar</a>    
                            </td>
                        </tr>
                        <?php $i++;?>

                    @endforeach
                </table>
            </div>
        </div>
        <div class="row hide">
            <div class="col-lg-6">
                <table class="table table-striped">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Fecha de pago</th>
                        <th>Monto</th>
                        <th>Observacion</th>
                    </tr>
                    <?php $i=1;?>
                    @foreach($membresia->cuotas as $cuota)
                        <tr>
                            <td>{{$i}}</td>
                            <td><input type="date" name="cuota_fecha" id="cuota_fecha_'.$i.'" value="{{$cuota->fechaCancelacion}}" required disabled></td>
                            <td><input type="number" name="cuota_precio" id="cuota_precio_" value="{{$cuota->monto}}"  required disabled></td>
                            <td>
                                <input type="hidden" name="estado" id="estado_'.$i.'" value="{{$cuota->estado}}">
                                @if($cuota->estado==1)
                                    <a type="button" class="btn btn-success">Pagado</a>
                                @else
                                    <a type="button" class="btn btn-primary"  id="pagar_{{$cuota->id}}">Falta pagar1</a>
                                @endif
                            </td>
                        </tr>
                        <?php $i++;?>

                    @endforeach
                </table>
            </div>
        </div>

    {{--<form method="post" action="{{route('congelar_add_path')}}">--}}
        <div class="row">
            <hr>
            <h3 class="text-green">Congelar</h3>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Desde</label>
                    <input type="date" name="desde" id="desde" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Hasta</label>
                    <input type="date" name="hasta" id="hasta" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="{{$membresia->id}}">
                    {{csrf_field()}}<br>
                    <button type="submit" class="btn btn-primary" onclick="congelar_membresia()">Congelar Mebresia</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="rpt_membresia"></div>
            </div>
        </div>
    {{--</form>--}}
    @endforeach
@elseif($tipomensaje=='0')
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
            <h3>{{$mensaje}} <span class="text-orange glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></h3>
        </div>
    </div>
@elseif($tipomensaje=='-1')
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
            <h3>{{$mensaje}} <span class="text-red glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span></h3>
        </div>
    </div>
@endif
