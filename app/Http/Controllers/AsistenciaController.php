<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistencia;
use App\Cliente;
use App\Membresia;
use App\Promocion;

class AsistenciaController extends Controller
{
    //
    function mostrar(){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        return view('asistencia',['miembros'=>$miembros,'membresias'=>$membresias]);
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
}
