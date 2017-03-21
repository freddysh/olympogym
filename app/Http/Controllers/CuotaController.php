<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuotaController extends Controller
{
    //
    public function generar(Request $request)
    {
        $cuotas=$request->input('cuotas');
        $cadena='';
        $cadena.='<table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Fecha de pago</th>
                                <th>Monto</th>
                                <th>Operacion</th>
                            </tr>';
        for ($i=1;$i<=$cuotas;$i++){
            $cadena.='<tr>
                    <td>'.$i.'.</td>
                    <td><input type="hidden" name="estado" id="estado_'.$i.'" value="0"><input type="date" name="cuota_fecha" id="cuota_fecha_'.$i.'" value="'.date("Y-m-d").'" required></td>
                    <td><input type="number" name="cuota_precio" id="cuota_precio_'.$i.'"  required></td>
                    <td><a id="pagar_'.$i.'" type="button" class="btn btn-primary" onclick="pagar_cuota('.$i.')">Pagar ahora</a></td>
                </tr>';
        }

    $cadena.='</table>';
        return $cadena;
    }
}
