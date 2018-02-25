@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
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
            <h3 class="box-title">Lista de cuentas por vencer</h3>
        </div>
        <div class="box-body">
            <form action="{{route('reporte_membresias_por_vencer2_path')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <label>Mostrar los que se venceran en</label>
                            <select class="form-control" placeholder="Recipient's username" name="periodo">
                                {{--<option value="-1" @if($periodo==-1) {{'selected'}}@endif>Vencidos</option>--}}

                                <option value="0" @if($periodo==0) {{'selected'}}@endif>Hoy</option>
                                <option value="10" @if($periodo==10) {{'selected'}}@endif>Venceran en 10 Dias</option>
                                <option value="15" @if($periodo==15) {{'selected'}}@endif>Venceran en 15 Dias</option>
                                <option value="20" @if($periodo==20) {{'selected'}}@endif>Venceran en 20 Dias</option>
                                <option value="30" @if($periodo==30) {{'selected'}}@endif>Venceran en 30 Dias</option>
                                <option value="60" @if($periodo==60) {{'selected'}}@endif>Venceran en 2 Meces</option>
                                <option value="90" @if($periodo==90) {{'selected'}}@endif>Venceran en 3 Meces</option>
                                <option value="180" @if($periodo==180) {{'selected'}}@endif>Venceran en 6 Meces</option>
                                <option value="-10" @if($periodo==-10) {{'selected'}}@endif>Vencieron hace 10 Dias</option>
                                <option value="-15" @if($periodo==-15) {{'selected'}}@endif>Vencieron hace 15 Dias</option>
                                <option value="-20" @if($periodo==-20) {{'selected'}}@endif>Vencieron hace 20 Dias</option>
                                <option value="-30" @if($periodo==-30) {{'selected'}}@endif>Vencieron hace 30 Dias</option>
                                <option value="-60" @if($periodo==-60) {{'selected'}}@endif>Vencieron hace 2 Meces</option>
                                <option value="-90" @if($periodo==-90) {{'selected'}}@endif>Vencieron hace 3 Meces</option>
                                <option value="-180" @if($periodo==-180) {{'selected'}}@endif>Vencieron hace 6 Meces</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 margin-top-20">
                        <button type="submit" class="btn btn-success btn-lg">Mostrar Membresias</button>
                        <a href="{{route('rpt-membresias_path',$periodo)}}" class="btn btn-primary  btn-lg">
                            <i class="glyphicon glyphicon-print"></i>
                        </a>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <table id="example1" class="table table-bordered table-striped table-responsive table-condensed">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Cuenta</th>
                            <th>Periodo</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Tiempo</th>
                            <th>Operaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($membresia2 as $membresia2_)
                            @if($periodo>=0)
                                @if($fecha_actual<=$membresia2_->fechaFin && $membresia2_->fechaFin <=$fecha)
                                    <?php $i++?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$membresia2_->cliente->dni}} {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}
                                            <br> Cel. {{$membresia2_->cliente->telefono}}</td>
                                        <td>
                                            @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                                {{$promo->titulo}}
                                            @endforeach
                                            <p>S/. {{$membresia2_->total}}</p>
                                        </td>
                                        <td>
                                            @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                                {{$promo->duracion}} {{$promo->tipoDuracion}}
                                            @endforeach
                                        </td>
                                        <td>{{fecha_peru($membresia2_->fechaInicio)}}</td>
                                        <td>{{fecha_peru($membresia2_->fechaFin)}}</td>
                                        <td>
                                            @php
                                                $datetime1 = date_create($fecha_actual);
                                                $datetime2 = date_create($membresia2_->fechaFin);
                                                $interval = date_diff($datetime1, $datetime2);
                                            @endphp
                                            @if($interval->format('%R')=='+')
                                                @if($interval->format('%a')==0)
                                                    Vence hoy
                                                @else
                                                    Vence en {{$interval->format('%a dias')}}
                                                @endif
                                            @else
                                                Pasó {{$interval->format('%a dias')}}
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{$membresia2_->id}}">Agendar</button>
                                            <div class="modal fade" id="myModal_{{$membresia2_->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form id="agendar_membresia_ajax_path_{{$membresia2_->id}}" action="{{route('agendar_membresia_ajax_path')}}" method="post">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Agregar a la agenda</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 text-center">
                                                                        @php
                                                                            $prom='';
                                                                        @endphp
                                                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                                                            <b class="text-primary text-20">{{$promo->duracion}} {{$promo->tipoDuracion}}</b>
                                                                            @php
                                                                                $prom='['.$promo->titulo.' | '.$promo->duracion.' | '.$promo->tipoDuracion;
                                                                            @endphp
                                                                        @endforeach | <b class="text-primary text-20">{{fecha_peru($membresia2_->fechaInicio)}} - {{fecha_peru($membresia2_->fechaFin)}}</b>
                                                                        @php
                                                                            $prom.=' | '.fecha_peru($membresia2_->fechaInicio).' - '.fecha_peru($membresia2_->fechaFin).'] ';
                                                                        @endphp
                                                                    </div>
                                                                    <div class="col-lg-12 text-center">
                                                                        <b class="txt-naranjado text-15">DNI: {{$membresia2_->cliente->dni}}</b> | <b class="txt-naranjado text-15">Cliente: {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}</b> | <b class="txt-naranjado text-15">Cel.: {{$membresia2_->cliente->telefono}}</b>
                                                                        @php
                                                                            $prom.='[DNI: '.$membresia2_->cliente->dni.' | Cliente: '.$membresia2_->cliente->nombres.' '.$membresia2_->cliente->apellidos.' | Cel.: '.$membresia2_->cliente->telefono.'] ';
                                                                        @endphp
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="input-group">
                                                                            <label>Descripcion</label>
                                                                            <textarea name="evento" id="evento_{{$membresia2_->id}}" class="editorcito form-control" cols="75" rows="5" required>
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-group">
                                                                            <label>Fecha</label>
                                                                            <input type="date" name="fecha" id="fecha_{{$membresia2_->id}}" class="form-control validation" value="{{date("Y-m-d")}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2 hide">
                                                                        <div class="input-group">
                                                                            <label>Hora</label>
                                                                            <input type="text" name="hora" id="hora_{{$membresia2_->id}}" class="form-control validation" placeholder="09:30" value="09:30" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p class="text-15" id="result_{{$membresia2_->id}}"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="prom" value="{{$prom}}">
                                                                <input type="hidden" name="id" value="{{$membresia2_->id}}">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary" onclick="agendar_membresia_ajax({{$membresia2_->id}})">Guardar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @else
                                @if($fecha<=$membresia2_->fechaFin &&$membresia2_->fechaFin <$fecha_actual)
                                    <?php $i++?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$membresia2_->cliente->dni}} {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}
                                            <br> Cel. {{$membresia2_->cliente->telefono}}</td>
                                        <td>
                                            @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                                {{$promo->titulo}}
                                            @endforeach
                                            <p>S/. {{$membresia2_->total}}</p>
                                        </td>
                                        <td>
                                            @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                                {{$promo->duracion}} {{$promo->tipoDuracion}}
                                            @endforeach
                                        </td>
                                        <td>{{fecha_peru($membresia2_->fechaInicio)}}</td>
                                        <td>{{fecha_peru($membresia2_->fechaFin)}}</td>
                                        <td>
                                            @php
                                                $datetime1 = date_create($membresia2_->fechaFin);
                                                $datetime2 = date_create($fecha_actual);
                                                $interval = date_diff($datetime1, $datetime2);
                                            @endphp
                                            Vencio hace {{$interval->format('%a dias')}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{$membresia2_->id}}">Agendar</button>
                                            <div class="modal fade" id="myModal_{{$membresia2_->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form id="agendar_membresia_ajax_path_{{$membresia2_->id}}" action="{{route('agendar_membresia_ajax_path')}}" method="post">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Agregar a la agenda</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 text-center">
                                                                        @php
                                                                            $prom='';
                                                                        @endphp
                                                                        @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                                                            <b class="text-primary text-20">{{$promo->duracion}} {{$promo->tipoDuracion}}</b>
                                                                            @php
                                                                                $prom='['.$promo->titulo.' | '.$promo->duracion.' | '.$promo->tipoDuracion;
                                                                            @endphp
                                                                        @endforeach | <b class="text-primary text-20">{{fecha_peru($membresia2_->fechaInicio)}} - {{fecha_peru($membresia2_->fechaFin)}}</b>
                                                                        @php
                                                                            $prom.=' | '.fecha_peru($membresia2_->fechaInicio).' - '.fecha_peru($membresia2_->fechaFin).'] ';
                                                                        @endphp
                                                                    </div>
                                                                    <div class="col-lg-12 text-center">
                                                                        <b class="txt-naranjado text-15">DNI: {{$membresia2_->cliente->dni}}</b> | <b class="txt-naranjado text-15">Cliente: {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}</b> | <b class="txt-naranjado text-15">Cel.: {{$membresia2_->cliente->telefono}}</b>
                                                                        @php
                                                                            $prom.='[DNI: '.$membresia2_->cliente->dni.' | Cliente: '.$membresia2_->cliente->nombres.' '.$membresia2_->cliente->apellidos.' | Cel.: '.$membresia2_->cliente->telefono.'] ';
                                                                        @endphp
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="input-group">
                                                                            <label>Descripcion</label>
                                                                            <textarea name="evento_{{$membresia2_->id}}" id="evento_{{$membresia2_->id}}" class="editorcito form-control" cols="75" rows="5" required>
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-group">
                                                                            <label>Fecha</label>
                                                                            <input type="date" name="fecha_{{$membresia2_->id}}" id="fecha_{{$membresia2_->id}}" class="form-control validation" value="{{date("Y-m-d")}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2 hide">
                                                                        <div class="input-group">
                                                                            <label>Hora</label>
                                                                            <input type="text" name="hora_{{$membresia2_->id}}" id="hora_{{$membresia2_->id}}" class="form-control validation" placeholder="09:30" value="09:30" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p class="text-15" id="result_{{$membresia2_->id}}"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="prom_{{$membresia2_->id}}" value="{{$prom}}">
                                                                <input type="hidden" name="id" value="{{$membresia2_->id}}">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary" onclick="agendar_membresia_ajax({{$membresia2_->id}})">Guardar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Cuenta</th>
                            <th>Tiempo</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Periodo</th>
                            <th>Operaciones</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop