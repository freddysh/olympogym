@extends('partial.default')
@section('menu')
    <?php
    $p1='';
    $p2='';
    $p3='';
    $p4='';
    $p5='';
    $p6='';
    $p7='';
    $p8='';
    $p9='';
    $p10='';
    $p11='';
    $p12='';
    $p13='';
    $p14='';
    $p15='';

    ?>
    @foreach($privilegios as $privilegio)
        @if($privilegio->nombre=='nuevo-usuario')
            <?php $p1='1'?>
        @endif
        @if($privilegio->nombre=='lista-usuario')
            <?php $p2='1'?>
        @endif
        @if($privilegio->nombre=='nuevo-cliente')
            <?php $p3='1'?>
        @endif
        @if($privilegio->nombre=='lista-cliente')
            <?php $p4='1'?>
        @endif
        @if($privilegio->nombre=='asistencia')
            <?php $p5='1'?>
        @endif
        @if($privilegio->nombre=='nueva-promocion')
            <?php $p6='1'?>
        @endif
        @if($privilegio->nombre=='lista-promocion')
            <?php $p7='1'?>
        @endif
        @if($privilegio->nombre=='nueva-membresia')
            <?php $p8='1'?>
        @endif
        @if($privilegio->nombre=='lista-membresia')
            <?php $p9='1'?>
        @endif
        @if($privilegio->nombre=='pagar-cuota')
            <?php $p10='1'?>
        @endif
        @if($privilegio->nombre=='r-clientes')
            <?php $p11='1'?>
        @endif
        @if($privilegio->nombre=='r-membresias')
            <?php $p12='1'?>
        @endif
        @if($privilegio->nombre=='r-ingresos')
            <?php $p13='1'?>
        @endif
        @if($privilegio->nombre=='congelar')
            <?php $p14='1'?>
        @endif
        @if($privilegio->nombre=='ampliaciones')
            <?php $p15='1'?>
        @endif
    @endforeach
    <ul class="sidebar-menu">
        <li class="header">MENU DE NAVEGACION</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Usuario</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p1=='1')
                    <li><a href="{{route('nuevo_usuario_path')}}"><i class="fa fa-user-plus"></i> Nuevo</a></li>
                @endif
                @if($p2=='1')
                    <li><a href="{{route('lista_usuario_path')}}"><i class="fa fa-users"></i> Lista de usuarios</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Cliente</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p3=='1')
                    <li><a href="{{route('nuevo_cliente_path')}}"><i class="fa fa-user-plus"></i> Nuevo</a></li>
                @endif
                @if($p4=='1')
                    <li><a href="{{route('lista_cliente_path')}}"><i class="fa fa-users"></i> Lista de clientes</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Asistencia</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p5=='1')
                    <li><a href="{{route('asistencia_path')}}"><i class="fa fa-circle-o"></i> Asistencia</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Promociones</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p6=='1')
                    <li><a href="{{route('nueva_promocion_path')}}"><i class="fa fa-circle-o"></i> Nueva</a></li>
                @endif
                @if($p7=='1')
                    <li><a href="{{route('lista_promocion_path')}}"><i class="fa fa-circle-o"></i> Lista de promociones</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Membresia</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p8=='1')
                    <li><a href="{{route('nueva_membresia_path')}}"><i class="fa fa-circle-o"></i> Nueva</a></li>
                @endif
                @if($p9=='1')
                    <li><a href="{{route('lista_membresia_path')}}"><i class="fa fa-circle-o"></i> Lista de membresias</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Cuotas</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p10=='1')
                    <li><a href="{{route('pagar_cuota_path')}}"><i class="fa fa-circle-o"></i> Pagar cuota</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Reportes</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p11=='1')
                    <li><a href="{{route('reporte_clientes_path')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                @endif
                @if($p12=='1')
                    <li><a href="{{route('rpt_contratos_path')}}"><i class="fa fa-circle-o"></i> Membresias</a></li>
                @endif
                @if($p13=='1')
                    <li><a href="{{route('reporte_ingresos_path')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                @endif
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Herramientas</span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu">
                @if($p14=='1')
                    <li><a href="{{route('congelar_path')}}"><i class="fa fa-circle-o"></i> Congelar</a></li>
                @endif
                @if($p15=='1')
                    <li><a href="{{route('ampliar_path')}}"><i class="fa fa-circle-o"></i> Ampliar</a></li>
                @endif
            </ul>
        </li>
    </ul>
@endsection
@section('miembros')
    {{$miembros}}
@endsection
@section('membresias')
    {{$membresias}}
@endsection
@section('contenido')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Reporte de membresias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Membresia</th>
                    <th>Desde - hasta</th>
                    <th>Asistencia</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0;?>
                @foreach($membresiass as $membresia)
                    <?php $i++?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$membresia->cliente->dni}} {{$membresia->cliente->nombres}} {{$membresia->cliente->apellidos}}</td>
                        <td>
                            <div class="col-lg-10">
                            @foreach($promociones->where('id',$membresia->promocion_id) as $promo)
                                    {{$promo->titulo}}
                            @endforeach
                            </div>
                            <div class="col-lg-1 right"><a href="{{route('rpt_membresia_path',$membresia->id)}}" class=" text-blue">
                                    <i class="glyphicon glyphicon-print"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{$membresia->fechaInicio}} - {{$membresia->fechaFin}}</td>
                        <td>
                            <a href="{{route('rpt_asistencia_path',$membresia->id)}}" class="text-blue">
                                <i class="glyphicon glyphicon-print"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Membresia</th>
                    <th>Desde a hasta</th>
                    <th>Asistencia</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop