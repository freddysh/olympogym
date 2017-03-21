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
            <form name="Membresia" id="Membresia" role="form" action="" method="post" enctype="multipart/form-data">
                <div id="mensaje"></div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Desde</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control validation" required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Hasta</label>
                            <input type="date" name="fechafin" id="fechafin" class="form-control validation" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <a type="button" class="btn btn-primary " onclick="Generar_cuota()">Buscar Membresias</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12" id="lista_memnbresias">

                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-success btn-lg" onclick="imprimir_membresia()">Impimir</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>

@stop