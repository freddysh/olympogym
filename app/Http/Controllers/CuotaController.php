<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Cliente;
use App\Cuota;
use App\Membresia;
use App\Privilegio;
use App\Promocion;
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
    public function pagar(){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('cuota',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio]);
    }
    function guardar(Request $request){
        try {
            $dni =explode(' ',$request->input('dni'));
            $cliente=Cliente::where('dni', $dni[0])->get();
            $fecha = date('Y-m-d');
            $hora = date('H:m:s');
            if(count($dni)>0) {
                $membresia = Membresia::with(['cuotas', 'cliente'])
                    ->where('estado', '1')
                    ->where('cliente_id',$cliente[0]->id)
                    ->get()
                    ->sortByDesc('id');

//                    ->sortByDesc('id');

                if (count($membresia) > 0) {
                    foreach ($membresia->take(1) as $membresi) {
                        $promocion = Promocion::where('id', $membresi->promocion_id)->get();
                        $asistencia = new Asistencia();
                        $asistencia->cliente_id = $membresi->cliente_id;
                        $asistencia->fecha = $fecha;
                        $asistencia->hora = $hora;
                        $asistencia->estado = 1;
                        $asistencia->save();
                        $tipomensaje = '1';
                        $mensaje = '';
                        return view('mensaje.rpt-asistencia', ['membresias' => $membresia, 'promociones' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje]);
                    }
                } else{
                    $tipomensaje='0';
                    $mensaje='Error al registrar la asistencia';
                    return view('mensaje.rpt-asistencia', ['membresias' => $membresia,'promocion'=>'', 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
                }
                return '0';
            }
        }catch(Exception $e){
            $tipomensaje='-1';
            $mensaje=$e;
            return view('mensaje.rpt-asistencia', ['membresias' => $membresia, 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
        }
    }
    function buscar_cuotas(Request $request){
        try {
            $dni =explode(' ',$request->input('dni'));
            $cliente=Cliente::where('dni', $dni[0])->get();
            $fecha = date('Y-m-d');
            $hora = date('H:m:s');
            if(count($dni)>0) {
                $membresia = Membresia::with(['cuotas', 'cliente'])
                    ->where('estado', '1')
                    ->where('cliente_id',$cliente[0]->id)
                    ->get()
                    ->sortByDesc('id');

//                    ->sortByDesc('id');

                if (count($membresia) > 0) {
                    foreach ($membresia->take(1) as $membresi) {
                        $promocion = Promocion::where('id', $membresi->promocion_id)->get();
//                        $asistencia = new Asistencia();
//                        $asistencia->cliente_id = $membresi->cliente_id;
//                        $asistencia->fecha = $fecha;
//                        $asistencia->hora = $hora;
//                        $asistencia->estado = 1;
//                        $asistencia->save();
                        $tipomensaje = '1';
                        $mensaje = '';
                        return view('mensaje.rpt-cuotas', ['membresias' => $membresia, 'promociones' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje]);
                    }
                } else{
                    $tipomensaje='0';
                    $mensaje='Error al registrar la asistencia';
                    return view('mensaje.rpt-cuotas', ['membresias' => $membresia,'promocion'=>'', 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
                }
                return '0';
            }
        }catch(Exception $e){
            $tipomensaje='-1';
            $mensaje=$e;
            return view('mensaje.rpt-cuotas', ['membresias' => $membresia, 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
        }
    }

    public function pagar_cuota_ahora(Request $request){
        $id =$request->input('id');
        $cuota=Cuota::FindOrFail($id);
        $cuota->fechaQCancelo=date('Y-m-d');
        $cuota->estado=1;
        if($cuota->save())
            return 1;
        else
            return 0;

    }
}
