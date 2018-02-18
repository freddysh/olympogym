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
            <form action="{{route('lista_cuentas_path')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-2">
                        <div class="input-group">
                            <label>Periodo</label>
                            <select class="form-control" placeholder="Recipient's username" name="periodo">
                                <option value="10" @if($periodo==10) {{'selected'}}@endif>10 Dias</option>
                                <option value="15" @if($periodo==15) {{'selected'}}@endif>15 Dias</option>
                                <option value="20" @if($periodo==20) {{'selected'}}@endif>20 Dias</option>
                                <option value="30" @if($periodo==30) {{'selected'}}@endif>30 Dias</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 margin-top-20">
                        <button type="submit" class="btn btn-success btn-lg">Mostrar Cuentas</button>
                        <a href="{{route('rpt-cuentas_path',$periodo)}}" class="btn btn-primary  btn-lg">
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
                            <th>Fecha Contrato</th>
                            <th>Fecha a cancelar</th>
                            <th>Total</th>
                            <th>Deuda a pagar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($membresia2 as $membresia2_)
                            @foreach($membresia2_->cuotas->where('estado',0)->take(1) as $cuota)
                                @if($fecha_actual<=$cuota->fechaCancelacion && $cuota->fechaCancelacion <=$fecha)
                                    <?php $i++?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$membresia2_->cliente->dni}} {{$membresia2_->cliente->nombres}} {{$membresia2_->cliente->apellidos}}
                                            <br> Cel. {{$membresia2_->cliente->telefono}}</td>
                                        <td>
                                            @foreach($promociones->where('id',$membresia2_->promocion_id) as $promo )
                                            {{$promo->titulo}}
                                            @endforeach
                                        </td>
                                        <td>Desde: {{fecha_peru($membresia2_->fechaInicio)}} - Hasta {{fecha_peru($membresia2_->fechaFin)}}</td>
                                        <td>{{fecha_peru($cuota->fechaCancelacion)}}</td>
                                        <td>{{$membresia2_->total}}</td>
                                        <td>{{$cuota->monto}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Estado</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop