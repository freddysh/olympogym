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
            <h3 class="box-title">Registro de asistencia</h3>
        </div>
        <div class="box-body">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Dni</label>
                        <input type="text" name="term" id="term" class="form-control validation" placeholder="44942054">
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="mostrar_asistencia()" class="btn btn-primary btn-lg">Mostrar Asistencia</button>
                    </div>
                </div>
                <div class="col-lg-8" id="respusta">
                </div>
            </div>
        </div>
    </div>
@stop