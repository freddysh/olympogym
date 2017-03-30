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
            <h3 class="box-title">Reporte membresia</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-lg-9">
                    <form name="frmbuscar" id="frmbuscar" role="form" action="{{route('listar_ingresos_path')}}" method="post" enctype="multipart/form-data">
                        <div id="mensaje"></div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Desde</label>
                                    <input type="date" name="desde" id="desde" class="form-control validation" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Hasta</label>
                                    <input type="date" name="hasta" id="hasta" class="form-control validation" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    {{csrf_field()}}
                                    <button type="submit" name="mostrar" class="btn btn-app bg-blue"><i class="glyphicon glyphicon-search"></i> Buscar Membresias</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-1">
                <form name="frmimprimir" id="frmimprimir" role="form" action="{{route('lista_ingresos_rpt_path')}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div clas="col-lg-2">
                            {{csrf_field()}}
                            <input type="hidden" name="desde" id="desde1" class="form-control validation" required>
                            <input type="hidden" name="hasta" id="hasta1" class="form-control validation" required>
                            <button name="imprimir" type="submit" class="btn btn-app bg-blue">
                                <i class="glyphicon glyphicon-print"></i> Imprimir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="lista_memnbresias">

                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@stop