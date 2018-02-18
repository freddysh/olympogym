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
            <h3 class="box-title">Ampliar membresia </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        {{--<form role="form" action="{{route('asistencia_cliente_path')}}" method="post">--}}
        <!-- text input -->
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Dni</label>
                        <input type="text" name="term" id="term" class="form-control validation" placeholder="44942054">
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="buscar_membresia_ampliar()" class="btn btn-primary btn-lg">Buscar cliente</button>
                    </div>
                </div>
                <div class="col-lg-8" id="respusta">

                </div>
            </div>

            {{--</form>--}}
        </div>
        <!-- /.box-body -->
    </div>
@stop