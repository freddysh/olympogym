@php

    function fecha_peru($fecha){
        $fecha=explode('-',$fecha);
        return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
    $membresi=null;
@endphp
@foreach($membresia as $mem)
@php
    $membresi=$mem;
@endphp
@endforeach
        <!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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
        table{
            font-family: DejaVu Sans;
            font-size: 10px;
            /*border: 1px solid #123543;*/
        }
        th {
            background-color: #367fa9;
            color: white;
        }
        tr>td{
            /*border: 1px solid #123543;*/
        }
        .titulo-seccion{
            background: #9a9a9a6b;
            font-weight: bold;
            border-radius: 2px;
            font-size: 11px;
        }
        .titulo-seccion1{
            background: #9a9a9a6b;
            font-weight: bold;
            border: 1px solid #9a9a9a6b;
            border-radius: 5px;
            font-size: 17px;
        }
        .precio{
            border: 1px solid #0c0c0c;
            border-radius: 5px;
            width: 80px;
            background: #ffffff;
            text-align: center;
            font-weight: bold;
        }
        .derecha{
            text-align: right;
        }
        .izquierda{
            text-align: left;
        }
        .centro{
            text-align: center;
        }
        .marca-agua{
            background:url("{{route('imagenes_path', ['filename' => 'fondo-olympo3.png'])}}") no-repeat center center;
            /*background-size: 20% 20%;*/
        }
    </style>
    <script type="text/php">
      if (isset($pdf))
        {
          $font = Font_Metrics::get_font("Arial", "bold");
          {{--$pdf->page_text(765, 550, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 2, array(0, 0, 0));--}}
        }
    </script>
</head>
<body>
<table width="740px">
    <tr>
        <td width="30%"></td>
        <td width="40%"><b class="titulo-seccion1">ACUERDO DE MEMBRESIA</b></td>
        <td width="30%">
            <picture>
                <img
                        src="{{route('imagenes_path', ['filename' => 'logo-olympo.png'])}}"  width="75" height="60">
            </picture>
        </td>
    </tr>
</table>
<table width="740px" class="marca-agua">
    <tr>
        <td colspan="3"><b class="titulo-seccion">DATOS DEL CLIENTE:</b></td>
    </tr>
    <tr>
        <td colspan="3">
            <table width="100%">
                <tr>
                    <td width="15%">Nombres:</td>
                    <td colspan="3">{{$membresi->cliente->nombres}}</td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td colspan="3">{{$membresi->cliente->apellidos}}</td>
                </tr>
                <tr>
                    <td>DNI:</td>
                    <td>{{$membresi->cliente->dni}}</td>
                    <td>Celular:</td>
                    <td>{{$membresi->cliente->telefono}}</td>
                </tr>
                <tr>
                    <td>Domicilio:</td>
                    <td>{{$membresi->cliente->direccion}}</td>
                    <td width="10%">Distrito:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td colspan="3">{{$membresi->cliente->email}}</td>
                </tr>
                <tr>
                    <td>Redes sociales:</td>
                    <td colspan="3">
                        <table>
                            <tr>
                                <td>
                                    <picture>
                                        <img
                                                src="{{route('imagenes_path', ['filename' => 'Facebook-icon.png'])}}"  width="20" height="20">
                                    </picture>
                                    -----------------------------------------
                                </td>
                                <td>
                                    <picture>
                                        <img
                                                src="{{route('imagenes_path', ['filename' => 'instagram-icon.png'])}}"  width="20" height="20">
                                    </picture>
                                    -----------------------------------------
                                </td>
                                <td>
                                    <picture>
                                        <img
                                                src="{{route('imagenes_path', ['filename' => 'twiter-icon.png'])}}"  width="20" height="20">
                                    </picture>
                                    -----------------------------------------
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3"><b class="titulo-seccion">TIPO DE ACUERDO</b></td>
    </tr>
    <tr>
        <td width="33%">Plazo del Acuerdo : {{$membresi->promocion->duracion}} {{$membresi->promocion->tipoDuracion}}</td>
        <td width="33%">Matricula S/.:</td>
        <td width="33%">Costo total de la Membresia S/.: {{$membresi->total}}</td>
    </tr>
    <tr>
        <td>Fecha de inicio : {{fecha_peru($membresi->fechaInicio)}}</td>
        <td>Fecha de expiracion: {{fecha_peru($membresi->fechaFin)}}</td>
    </tr>
    <tr>
        <td colspan="3">Cantidad pagada al momento de su inscripción:(Llenar en caso de haber un saldo pendiente por cancelar) </td>
    </tr>
    @php
        $total=0;
        $acuenta=0;
    @endphp
    @foreach($membresi->cuotas as $cuota)
        @if($cuota->estado==1)
            @php
                $acuenta+=$cuota->monto;
            @endphp
        @endif
        @php
            $total+=$cuota->monto;
        @endphp
    @endforeach
    <tr>
        <td>
            <table>
                <tr><td>A CUENTA S/.:</td><td><div class="precio">{{$acuenta}}</div></td></tr>
            </table>
        </td>
        <td>
            <table>
                <tr><td>SALDO S/.:</td><td><div class="precio">{{($total-$acuenta)}}</div></td></tr>
            </table>
        </td>
        <td>
            <table>
                <tr><td>TOTAL S/.:</td><td><div class="precio">{{$total}}</div></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3"><b class="titulo-seccion">FORMAS DE PAGO O MEDIOS DE PAGO</b></td>
    </tr>
    <tr>
        <td>
            <b>
                @if($membresi->forma_pago=='Pago_efetivo')
                    <input type="radio" name="pago" checked="checked"> Pago en efectivo
                @else
                    <input type="radio" name="pago"> Pago en efectivo
                @endif
            </b>
        </td>
        <td>
            <b>
                @if($membresi->forma_pago=='Debito')
                    <input type="radio" name="pago" checked="checked">Debito
                @else
                    <input type="radio" name="pago">Debito
                @endif
            </b>
        </td>
    </tr>
    <tr>
        <td colspan="3"><b class="titulo-seccion">CONGELAMIENTO</b></td>
    </tr>
    <tr>
        <td colspan="3">
            <ul>
                <li>En caso de los acuerdos de membresia de 3 meses, 6 meses y 12 meses; cancelados al contado, le permiten al
                    cliente el derecho de ausentarse y recuperar los dias no asistidos a Olympo Fitness & Wellness al final de su
                    acuerdo de membresia.
                    <ul>
                        <li>a) Membresia de 03 meses, por ausencia 10 dias recuperables</li>
                        <li>b) Membresia de 06 meses, por ausencia 20 dias recuperables</li>
                        <li>c) Membresia de 12 meses, por ausencia 40 dias recuperables</li>
                    </ul>
                </li>
                <li>
                    Olympo Fitness & Wellness evaluara el sustento correspondiente del cliente, para otorgar los días recuperables ofrecidos
                </li>
            </ul>
        </td>
    </tr>
    <tr><td colspan="3"><b class="titulo-seccion">RESPONSABILIDADES</b></td></tr>
    <tr>
        <td colspan="3">
            <ul>
                <li>Olympo Fitness & Wellness, le garantiza al socio el monto de la cuota pactada por todo el periodo elegido.
                </li>
                <li>El cliente se responsabiliza por los daños que pudiera causar a las instalaciones y/o mobiliario de Olympo Fitness &
                    Wellness como consecuencias de practicas negligentes o usos incorretos de los equipos sin la supervision de un instructor,
                    debidamente comprobados.
                </li>
                <li>El cliente libera y exonera a Olympo Fitness & Wellness de cualquier responsabilidad civil y/o penal, por lesiones
                    corporales, daños a la propiedad, homicidio culposo causado por negligencia en la que el cliente hubiera incurrido.
                </li>
                <li>La empresa no se responsabiliza de pérdida o robo de los objetos personales dentro de nuestras instalaciones.
                </li>
                <li>El cliente se responsabiliza por todo menor de 18 años de edad que ingrese a Olympo Fitness & Wellness bajo su custodia.
                </li>
                <li>Olympo Fitness & Wellness se reserva el derecho de dar por concluido en cualquier momento el acuerdo de membresia
                    unilateralmente impedir el ingreso del miembro que falte a la mora, a las buenas costumbres, que en forma negligente
                    ocacione daños a las instalaciones y/o de Olympo Fitness & Wellness o que realice acto que signifique falta de
                    higiene, limpieza o agresión a otro cliente.
                </li>
                <li>
                    Olympo Fitness & Wellness evaluara el sustento correspondiente del cliente, para otorgar los días recuperables ofrecidos
                </li>
            </ul>
        </td>
    </tr>
    <tr><td colspan="3"><b class="titulo-seccion">RESOLUCION Y DISPOSICIONES FINALES</b></td></tr>
    <tr>
        <td colspan="3">
            <ul>
                <li>Las cantidades pagadas por concepto de matricula, acuerdo de membresia no son reembosables, si el cliente
                    decidiera dar término al contrato de membresia.
                </li>
                <li>Olympo Fitness & Wellness modificará los programas y horarios grupales sin previo aviso.
                </li>
                <li>Olympo Fitness & Wellness cambiará instructores semipersonales, instructores personales, profesores de clases grupales sin previo aviso.
                </li>
            </ul>
        </td>
    </tr>
    <tr><td colspan="3"><b class="titulo-seccion">OBSERVACIONES DE SALUD</b></td></tr>
    <tr><td colspan="3">{{$membresi->cliente->observaciones_salud}}</td></tr>
    @php
        use \Carbon\Carbon;
        $dt = Carbon::parse($membresi->created_at);
        $dt->subHours(5);
        $mes=$dt->month;
    @endphp
    <tr><td colspan="3"></td></tr>
    <tr><td colspan="3"></td></tr>
    <tr>
        <td colspan="3" class="derecha">Cusco, {{$dt->day}} de
            @if($mes=='1')
                {{'ENERO'}}
            @endif
            @if($mes=='2')
                {{'FEBRERO'}}
            @endif
            @if($mes=='3')
                {{'MARZO'}}
            @endif
            @if($mes=='4')
                {{'ABRIL'}}
            @endif
            @if($mes=='5')
                {{'MAYO'}}
            @endif
            @if($mes=='6')
                {{'JUNIO'}}
            @endif
            @if($mes=='7')
                {{'JULIO'}}
            @endif
            @if($mes=='8')
                {{'AGOSTO'}}
            @endif
            @if($mes=='9')
                {{'SEPTIEMBRE'}}
            @endif
            @if($mes=='10')
                {{'OCTUBRE'}}
            @endif
            @if($mes=='11')
                {{'NOVIEMBRE'}}
            @endif
            @if($mes=='12')
                {{'DICIEMBRE'}}
            @endif
            del {{$dt->year}}</td></tr>
    <tr>
        <td colspan="3" class="derecha"><b>PLAZA TUPAC AMARU 114 - WANCHAQ</b></td>
    </tr>
    <tr>
        <td colspan="3" class="derecha"><b>TELF. 254798</b></td>
    </tr>
    <tr>
        <td class="centro">
            ----------------------------------<br>
            Olympo Fitness & Wellness
        </td>
        <td class="centro">
            ----------------------------------<br>
            Cliente
        </td>
    </tr>
</table>
</body>
</html>