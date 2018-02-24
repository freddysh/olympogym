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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Cuenta</th>
                            <th>Periodo</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Tiempo</th>
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
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop