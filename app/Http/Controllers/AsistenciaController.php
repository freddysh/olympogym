<?php

namespace App\Http\Controllers;

use App\Congelado;
use App\Privilegio;
use Illuminate\Http\Request;
use App\Asistencia;
use App\Cliente;
use App\Membresia;
use App\Promocion;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    //
    function mostrar(){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('asistencia',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio]);
    }
    function guardar(Request $request){
        try {
            $dni =explode(' ',$request->input('dni'));
            $cliente=Cliente::where('dni', $dni[0])->get();
            $dt = Carbon::now();
//            $fecha = date('Y-m-d');
//            $hora = date('H:i:s');
            $dt->subHours(5);
            $fecha=$dt->toDateString();
            $hora=$dt->toTimeString();
//            dd($dt->toTimeString());

            if(count($dni)>0) {

                $membresia = Membresia::with(['cuotas', 'cliente'])
                    ->where('cliente_id',$cliente[0]->id)
                    ->get()
                    ->sortByDesc('id');

//                    ->sortByDesc('id');

                if (count($membresia) > 0) {
                    foreach ($membresia->take(1) as $membresi) {
                        if($membresi->estado==1){
                            $promocion = Promocion::FindOrFail($membresi->promocion_id);
                            if(strtoupper($promocion->modalidad)=='VIAJERO'){
                                $asistencias=Asistencia::where('membresia_id',$membresi->id)->get();
                                $nroAsistencias=count($asistencias);
                                if($nroAsistencias<=$promocion->duracion){
                                    $asistencia = new Asistencia();
                                    $asistencia->cliente_id = $membresi->cliente_id;
                                    $asistencia->fecha = $fecha;
                                    $asistencia->hora = $hora;
                                    $asistencia->estado = 1;
                                    $asistencia->membresia_id = $membresi->id;
                                    $asistencia->save();
                                    $tipomensaje = '1';
                                    $mensaje = '';
                                    $asistencias = Asistencia::where('membresia_id', $membresi->id)->get();
                                    return view('mensaje.rpt-asistencia', ['membresias' => $membresia, 'promocion' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje, 'asistencias' => $asistencias]);
                                }
                                else{
                                    $tipomensaje = '3';
                                    $mensaje = '';
                                    $asistencias = Asistencia::where('membresia_id', $membresi->id)->get();
                                    return view('mensaje.rpt-asistencia-vencida', ['membresias' => $membresia, 'promocion' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje, 'asistencias' => $asistencias,'nroAsistencias'=>$nroAsistencias]);
                                }
                            }
                            else {
                                $asistencia = new Asistencia();
                                $asistencia->cliente_id = $membresi->cliente_id;
                                $asistencia->fecha = $fecha;
                                $asistencia->hora = $hora;
                                $asistencia->estado = 1;
                                $asistencia->membresia_id = $membresi->id;
                                $asistencia->save();
                                $tipomensaje = '1';
                                $mensaje = '';
                                $asistencias = Asistencia::where('membresia_id', $membresi->id)->get();
                                return view('mensaje.rpt-asistencia', ['membresias' => $membresia, 'promocion' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje, 'asistencias' => $asistencias]);
                            }
                        }
                        elseif($membresi->estado==2){
                            $hoy=date("Y-m-d");
                            $congelado=Membresia::with(['congelados'=>function($query) use ($hoy) {
                                $query->where('desde', '<=', $hoy)
                                    ->where('hasta', '>=', $hoy);
                            }])->get();
                            $promocion = Promocion::FindOrFail($membresi->promocion_id);
                            if(count($congelado)>0){
                                $tipomensaje = '2';
                                $mensaje = 'El cliente con dni:  tiene su membresia congelada';
                            return view('mensaje.rpt-asistencia-congelado', ['congelado'=>$congelado,'membresias' => $membresia, 'promocion' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje]);
                            }
                            else{
                                $promocion = Promocion::where('id', $membresi->promocion_id)->get();
                                $asistencia = new Asistencia();
                                $asistencia->cliente_id = $membresi->cliente_id;
                                $asistencia->fecha = $fecha;
                                $asistencia->hora = $hora;
                                $asistencia->estado = 1;
                                $asistencia->membresia_id = $membresi->id;
                                $asistencia->save();
                                $tipomensaje = '1';
                                $mensaje = '';
                                return view('mensaje.rpt-asistencia', ['membresias' => $membresia, 'promocion' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje]);
                                }
                        }
                    }
                } else{
                    $tipomensaje='0';
                    $mensaje='Error al registrar la asistencia';
                    return view('mensaje.rpt-asistencia', ['membresias' => $membresia,'promocion'=>'', 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
                }
                 //   return '0';
            }
        }catch(Exception $e){
                $tipomensaje='-1';
                $mensaje=$e;
            return view('mensaje.rpt-asistencia', ['membresias' => $membresia, 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
        }
    }
    public function reporte_asistencia()
    {
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('asistencia',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio]);
    }
    public function mostrar_asistencia(Request $request)
    {
        $dni =explode(' ',$request->input('dni'));
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);

        $cli=Cliente::FindOrFail($dni[0]);
        $membresia=Membresia::where('cliente_id',$cli->id)->get();
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('asistencia',['miembros'=>$miembros,'membresias'=>$membresias,'membresia'=>$membresia,'privilegios'=>$privilegio]);
    }

}
