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
$p16='';
$p17='';
$p18='';
$p19='';
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
    @if($privilegio->nombre=='renovar-membresia')
        <?php $p18='1'?>
    @endif
    @if($privilegio->nombre=='agenda-membresias')
        <?php $p19='1'?>
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
    @if($privilegio->nombre=='cta-vencidas')
        <?php $p16='1'?>
    @endif
    @if($privilegio->nombre=='membresias-vencidas')
        <?php $p17='1'?>
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
            {{--@if($p8=='1')--}}
                {{--<li><a href="{{route('nueva_membresia_path')}}"><i class="fa fa-circle-o"></i> Nueva</a></li>--}}
            {{--@endif--}}
            @if($p18=='1')
                <li><a href="{{route('renovar_membresia_path')}}"><i class="fa fa-circle-o"></i> Nueva membresia</a></li>
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
                <li><a href="{{route('rpt_contratos_path')}}"><i class="fa fa-circle-o"></i> Membresias & Asistencia</a></li>
            @endif
            @if($p13=='1')
                <li><a href="{{route('reporte_ingresos_path')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
            @endif
            @if($p16=='1')
                <li><a href="{{route('reporte_cuentas_por_vencer_path')}}"><i class="fa fa-circle-o"></i> Cuentas</a></li>
            @endif
            @if($p17=='1')
                <li><a href="{{route('reporte_membresias_por_vencer_path')}}"><i class="fa fa-circle-o"></i> Membresias por vencer</a></li>
            @endif
            @if($p19=='1')
                <li><a href="{{route('agenda_membresias_path')}}"><i class="fa fa-circle-o"></i> Agenda</a></li>
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