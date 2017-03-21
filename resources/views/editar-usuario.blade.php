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
            <h3 class="box-title">Nuevo usuario</h3>
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
                            <input type="text" name="contrasena" id="contrasena" class="form-control validation" placeholder="*********" value="{{$user->password}}">
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
                    ?>
                @foreach($privilegios as $privilegio1)
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
                    @if($privilegio1->nombre=='primero')
                        <?php $primero=1; ?>
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
                            <div class="widget-user-header bg-yellow">
                                <h3 class="widget-user-username">Reportes</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Primero <span class="pull-right badge bg-yellow"><input type="checkbox" name="privilegio[]" id="privilegio" value="primero" @if($primero==1)  <?php echo 'checked';?> @endif ></span></a></li>
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