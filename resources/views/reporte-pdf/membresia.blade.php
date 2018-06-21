@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Membresia</title>
    <style>
        h3{
            color: #3c8dbc;
        }
        .subtitulo{
            font-size: 20px;
            padding-top: 10px;
            padding-bottom: 5px;
            color: #222d32;
            font-family: Tahoma, Helvetica, Arial;
        }
        .titulo{
            padding: 10px;
            color: #f7f7f7;
            background: #3c8dbc;
            font-family: Tahoma, Helvetica, Arial;
            text-align: center;
        }
        th {
            background-color: #367fa9;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
    <script type="text/php">
      if (isset($pdf))
        {
          $font = Font_Metrics::get_font("Arial", "bold");
          $pdf->page_text(765, 550, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 9, array(0, 0, 0));
        }
    </script>
</head>
<body>
<div class="row">
    @php
    $formato='A';
    @endphp
    @foreach($membresia as $membresi)
        @php
            $formato=$membresi->formato_AB;
        @endphp
    @endforeach
    <div class="col-lg-12">
        <h2 class="titulo">Sistema de administracion de OlympoGym</h2>
        <p class="subtitulo">Reportes de membresia <?php echo date("d-m-Y")?></p>

            <?php $i=0;?>
            @foreach($membresia as $membresi)
                <?php $i++?>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos del cliente</h3>
                    <p for=""><b>Dni:</b>{{$membresi->cliente->dni}}</p>
                    <p for=""><b>Nombres:</b>{{$membresi->cliente->nombres}}</p>
                    <p for=""><b>Apellidos:</b>{{$membresi->cliente->apellidos}}</p>
                    <p for=""><b>Direccion:</b>{{$membresi->cliente->direccion}}</p>
                    <p for=""><b>Telefono:</b>{{$membresi->cliente->telefono}}</p>
                    <p for=""><b>Email:</b>{{$membresi->cliente->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Datos de la memebresia</h3>
                    <p for=""><b>Titulo: </b>{{$membresi->promocion->titulo}} {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</p>
                    <p for=""><b>Descripcion: </b>{{$membresi->promocion->detalle}}</p>
                    <p for=""><b>Total: </b>{{$membresi->total}}</p>
                    <p for=""><b>Fecha: </b>{{fecha_peru($membresi->fechaInicio)}} - {{fecha_peru($membresi->fechaFin)}}</p>
                </div>
            </div>
            <div class="row">
                @if(count($membresi->formato)>0)
                    @foreach($membresi->formato as $formato)
                        {!! $formato->contenido !!}
                    @endforeach
                @else
                    <h3>CONGELAMIENTO</h3>
                    <ul>
                        <li>En caso de los acuerdos de membresia de 3 meses, 6 meses y 12 meses; cancelados al contado, le permiten al
                            cliente el derecho de ausentarse y recuperar los dias no asistidos a Olympo Fitness & Wellness al final de su
                            acuerdo de membresia.
                            <ul>
                                <li>Membresia de 03 meses, por ausencia 10 dias recuperables</li>
                                <li>Membresia de 06 meses, por ausencia 20 dias recuperables</li>
                                <li>Membresia de 12 meses, por ausencia 40 dias recuperables</li>
                            </ul>
                        </li>
                        <li>
                            Olympo Fitness & Wellness evaluara el sustento correspondiente del cliente, para otorgar los días recuperables ofrecidos
                        </li>
                    </ul>
                    <h3>RESPONSABILIDAD</h3>
                    <ul>
                        <li>Olympo Fitness & Wellness, le garantiza al socio el monto de la cuota pactada por todo el periodo elegido.
                        </li>
                        <li>El cliente se responsabiliza por los daños que pudiera causara las instalaciones y/o mobiliario de Olympo Fitness &
                            Wellness como consecuencias de practicas negligenteso usos incorretos de los equipos sin la supervision de un trainer,
                            debidamente comprobados.
                        </li>
                        <li>El cliente libera y exonera a Olympo Fitness & Wellness de cualquier responsabilidad civil y/o penal, por lesiones
                            corporales, daños a la propiedad, homicidio culposo causado por negligencia en la que el socio hubiera incurrido.
                        </li>
                        <li>La empresa no se responsabiliza de perdida o robo de los objetos personales dentro de nnuestras instalaciones.
                        </li>
                        <li>El cliente se responsabiliza por todo menor de 18 años de edad que ingrese a Olympo Fitness & Wellness bajo su custodia.
                        </li>
                        <li>Olympo Fitness & Wellness se reserva el derecho de dar por concluido en cualquier momento el acuerdo de membresia
                            unilateralmente impedir el ingreso del miembro que falte a la mora, a las buenas costumbres, que en forma negligente
                            ocacione daños a las instalaciones y/o de Olympo Fitness & Wellnesso que realice acto que signifique falta de
                            higiene o limpieza.
                        </li>
                        <li>
                            Olympo Fitness & Wellness evaluara el sustento correspondiente del cliente, para otorgar los días recuperables ofrecidos
                        </li>
                    </ul>
                    <h3>RESOLUCION Y DISPOSICIONES FINALES</h3>
                    <ul>
                        <li>Las cantidades pagadas por concepto de matricula, acuerdo de membresia no son reembosables, si el socio
                            decidiera dar termino al contrato de membresia.
                        </li>
                        <li>Olympo Fitness & Wellness modificarar los horarios grupales sin previo aviso.
                        </li>
                    </ul>
                    <h3>OBSERVACIONES DE SALUD</h3>
                    <p>
                        ----------------------------------------------------------------------------------------------------------------------------------
                    </p>
                    <p class="text-right">
                        Cusco.......... de ....................... del 20....
                    </p>
                    <p class="text-right">
                        <b>PLAZA TUPAC AMARU 114 WANCHAQ</b><br>
                        <b>TELF: (084)254798</b>
                    </p>
                    <p class="text-center">
                        -----------------------------------<br>
                        Olympo Fitness & Wellness
                    </p>
                    <p class="text-center">
                        -----------------------------------<br>
                        Cliente
                    </p>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Cuotas</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha a cancelar</th>
                            <th>Monto</th>
                            <th>Fecha cancelada</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;?>
                        @foreach($membresi->cuotas as $cuota)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{fecha_peru($cuota->fechaCancelacion)}}</td>
                                <td>{{$cuota->monto}}</td>
                                @if($cuota->estado==1)
                                    <td>{{fecha_peru($cuota->fechaQCancelo)}}</td>
                                    <td>Pagado</td>
                                @else
                                    <td></td>
                                    <td>Falta pagar</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach

    </div>
</div>
</body>
</html>