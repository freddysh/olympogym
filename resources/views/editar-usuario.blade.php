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
            <h3 class="box-title">Editar usuario</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{route('editar_usuario_path')}}" method="post">
                @if($tipomensaje=='-1')
                    <div class="alert alert-danger" role="alert"> <strong>Error!</strong> {{$mensaje}}</div>
                @elseif($tipomensaje=='0')
                    <div class="alert alert-warning" role="alert"> <strong>Advertencia!</strong> {{$mensaje}} </div>
                @elseif($tipomensaje=='1')
                    <div class="alert alert-success" role="alert"> <strong>Bien hecho!</strong> {{$mensaje}} </div>
                @endif
            <!-- text input -->
                {{csrf_field()}}
                {{--@foreach($users as $user)--}}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Dni</label>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="text" name="dni" id="dni" class="form-control validation" placeholder="44942054" value="{{$user->dni}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control validation" placeholder="Juan Carlos" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control validation" placeholder="Valdivia Perez"  value="{{$user->apellidos}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control validation" placeholder="974324889"  value="{{$user->telefono}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control validation" placeholder="email@example.com"  value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Rol</label>
                            <select class="form-control" name="rol" id="rol">
                                <option value="Administrador" @if($user->tipoPersonal=='Administrador') {{'selected'}} @endif >Administrador</option>
                                <option value="Recepcion" @if($user->tipoPersonal=='Recepcion') {{'selected'}} @endif >Recepcion</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="text" name="contrasena" id="contrasena" class="form-control validation" placeholder="*********" value="{{$user->password2}}">
                        </div>
                    </div>
                </div>
                    {{--@endforeach--}}
                    <?php
                    $nuevo_usuario=0;
                    $lista_usuario=0;
                    $nuevo_cliente=0;
                    $lista_cliente=0;
                    $asistencia=0;
                    $nueva_promocion=0;
                    $lista_promocion=0;
                    $nueva_membresia=0;
                    $lista_membresia=0;
                    $primero=0;
                    $segundo=0;
                    $tercero=0;
                    $pagar_cuota=0;
                    $congelar=0;
                    $ampliaciones=0;


                    ?>
                @foreach($privilegios1 as $privilegio1)
                    @if($privilegio1->nombre=='nuevo-usuario')
                        <?php $nuevo_usuario=1; ?>
                    @endif
                    @if($privilegio1->nombre=='lista-usuario')
                        <?php $lista_usuario=1; ?>
                    @endif
                    @if($privilegio1->nombre=='nuevo-cliente')
                        <?php $nuevo_cliente=1; ?>
                    @endif
                    @if($privilegio1->nombre=='lista-cliente')
                        <?php $lista_cliente=1; ?>
                    @endif
                    @if($privilegio1->nombre=='asistencia')
                        <?php $asistencia=1; ?>
                    @endif
                    @if($privilegio1->nombre=='nueva-promocion')
                        <?php $nueva_promocion=1; ?>
                    @endif
                    @if($privilegio1->nombre=='lista-promocion')
                        <?php $lista_promocion=1; ?>
                    @endif
                    @if($privilegio1->nombre=='nueva-membresia')
                        <?php $nueva_membresia=1; ?>
                    @endif
                    @if($privilegio1->nombre=='lista-membresia')
                        <?php $lista_membresia=1; ?>
                    @endif
                    @if($privilegio1->nombre=='pagar-cuota')
                        <?php $pagar_cuota=1; ?>
                    @endif
                    @if($privilegio1->nombre=='r-clientes')
                        <?php $primero=1; ?>
                    @endif
                    @if($privilegio1->nombre=='r-membresias')
                        <?php $segundo=1; ?>
                    @endif
                    @if($privilegio1->nombre=='r-ingresos')
                        <?php $tercero=1; ?>
                    @endif
                    @if($privilegio1->nombre=='congelar')
                        <?php $congelar=1; ?>
                    @endif
                    @if($privilegio1->nombre=='ampliaciones')
                        <?php $ampliaciones=1; ?>
                    @endif
                @endforeach
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-blue">
                                <h3 class="widget-user-username">Usuario</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Nuevo <span class="pull-right badge bg-blue"><input type="checkbox" name="privilegio[]" id="privilegio1" value="nuevo-usuario" @if($nuevo_usuario==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Lista de usuarios <span class="pull-right badge bg-blue"><input type="checkbox" name="privilegio[]" id="privilegio" value="lista-usuario" @if($lista_usuario==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-orange">
                                <h3 class="widget-user-username">Cliente</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Nuevo <span class="pull-right badge bg-orange"><input type="checkbox" name="privilegio[]" id="privilegio" value="nuevo-cliente" @if($nuevo_cliente==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Lista de clientes <span class="pull-right badge bg-orange"><input type="checkbox" name="privilegio[]" id="privilegio" value="lista-cliente" @if($lista_cliente==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-aqua">
                                <h3 class="widget-user-username">Asistencia</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Asistencia <span class="pull-right badge bg-aqua"><input type="checkbox" name="privilegio[]" id="privilegio" value="asistencia" @if($asistencia==1) <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-red">
                                <h3 class="widget-user-username">Promocion</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Nueva <span class="pull-right badge bg-red"><input type="checkbox" name="privilegio[]" id="privilegio" value="nueva-promocion" @if($nueva_promocion==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Lista de promociones <span class="pull-right badge bg-red"><input type="checkbox" name="privilegio[]" id="privilegio" value="lista-promocion" @if($lista_promocion==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-green">
                                <h3 class="widget-user-username">Membresia</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Nuevo <span class="pull-right badge bg-green"><input type="checkbox" name="privilegio[]" id="privilegio" value="nueva-membresia" @if($nueva_membresia==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Lista de membresias <span class="pull-right badge bg-green"><input type="checkbox" name="privilegio[]" id="privilegio" value="lista-membresia" @if($lista_membresia==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-green">
                                <h3 class="widget-user-username">Cuotas</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Pagar cuota <span class="pull-right badge bg-green"><input type="checkbox" name="privilegio[]" id="privilegio" value="pagar-cuota" @if($pagar_cuota==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-yellow">
                                <h3 class="widget-user-username">Reportes</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Clientes <span class="pull-right badge bg-yellow"><input type="checkbox" name="privilegio[]" id="privilegio" value="r-clientes" @if($primero==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Membresias <span class="pull-right badge bg-yellow"><input type="checkbox" name="privilegio[]" id="privilegio" value="r-membresias" @if($segundo==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Ingresos <span class="pull-right badge bg-yellow"><input type="checkbox" name="privilegio[]" id="privilegio" value="r-ingresos" @if($tercero==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-blue">
                                <h3 class="widget-user-username">Herramientas</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Congelar <span class="pull-right badge bg-blue"><input type="checkbox" name="privilegio[]" id="privilegio" value="congelar" @if($congelar==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                    <li><a href="#">Ampliaciones <span class="pull-right badge bg-blue"><input type="checkbox" name="privilegio[]" id="privilegio" value="ampliaciones" @if($ampliaciones==1)  <?php echo 'checked';?> @endif ></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop