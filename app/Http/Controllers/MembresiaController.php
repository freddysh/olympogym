<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Congelado;
use App\Membresia;
use App\Cliente;
use App\Cuota;
use App\Privilegio;
use App\Promocion;

use Illuminate\Http\Request;

class MembresiaController extends Controller
{
    //
    public function membresianueva()
    {
        $tipomensaje = '2';
        $mensaje = '';
        $promociones = Promocion::get();
        $cliente = Cliente::get();
        $miembros = count($cliente);
        $membresias = Membresia::get();
        $membresias = count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('nueva-membresia', ['mensaje' => $mensaje, 'promociones' => $promociones, 'tipomensaje' => $tipomensaje, 'miembros' => $miembros, 'membresias' => $membresias,'privilegios'=>$privilegio]);
    }

    public function editarmembresia(Request $request, $id)
    {
        $tipomensaje = '2';
        $mensaje = '';
        $promociones = Promocion::get();
        $cliente = Cliente::get();
        $miembros = count($cliente);
        $membresias = Membresia::get();
        $membresias = count($membresias);
        $membresia = Membresia::with('cliente', 'cuotas', 'promocion')->where('id', $id)->get();
//        dd($membresia);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('editar-membresia', ['membresia' => $membresia, 'promociones' => $promociones, 'mensaje' => $mensaje, 'tipomensaje' => $tipomensaje, 'miembros' => $miembros, 'membresias' => $membresias,'privilegios'=>$privilegio]);

    }

    public function agregar_membresianueva(Request $request)
    {
        try {
            $cliente1 = Cliente::get();
            $miembros1 = count($cliente1);
            $membresias1 = Membresia::get();
            $membresias1 = count($membresias1);

            $dni = explode(' ', $request->input('term'));
            $promocion = explode('_', $request->input('promocion'));
            $fechaInicio = $request->input('fechaInicio');
            $fechaFin = $request->input('fechafin');
            $total = $request->input('total');

            $estado = explode('[]', $request->input('estado'));
            $cuota_fecha = explode('[]', $request->input('cuota_fecha'));
            $cuota_precio = explode('[]', $request->input('cuota_precio'));

            $cliente = Cliente::where('dni', $dni[0])->get();
            $cliente1 = '';
            foreach ($cliente as $cli) {
                $cliente1 = $cli;
            }
            if (count($cliente) > 0) {
                $membresia = new Membresia();
                $membresia->user_id = auth()->guard('admin')->user()->id;
                $membresia->cliente_id = $cliente1->id;
                $membresia->promocion_id = $promocion[0];
                $membresia->fechaInicio = $fechaInicio;
                $membresia->fechaFin = $fechaFin;
                $membresia->total = $total;
                $membresia->estado = '1';
                if ($membresia->save()) {
                    $i = 0;
//                dd($estado);
                    foreach ($estado as $dato) {
                        $cuota = new Cuota();
                        $cuota->membresia_id = $membresia->id;
                        $cuota->user_id = auth()->guard('admin')->user()->id;;
                        $cuota->fechaCancelacion = $cuota_fecha[$i];
                        $cuota->monto = $cuota_precio[$i];
                        $cuota->fechaQCancelo = date("Y-m-d");
                        $cuota->estado = $dato;
                        $cuota->save();
                        $i++;
                    }
                }
                $tipomensaje = '1';
                $mensaje = 'Se guardo la membresia.';
//            $promociones=Promocion::get();
                return $tipomensaje . '_' . $mensaje.'_'.$membresia->id;
//            return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
            } else {
                $tipomensaje = '0';
                $mensaje = 'El cliente no existe.';
//                $promociones=Promocion::get();
                return $tipomensaje . '_' . $mensaje.'_0';
//                return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
            }
        } catch (Exception $e) {
//            return $e;
            $tipomensaje = '-1';
            $mensaje = $e;
//            $promociones=Promocion::get();
            return $tipomensaje . '_' . $mensaje.'_0';
//            return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
        }
    }

    public function editar_membresia(Request $request)
    {
        try {
            $cliente1 = Cliente::get();
            $miembros1 = count($cliente1);
            $membresias1 = Membresia::get();
            $membresias1 = count($membresias1);

            $id = $request->input('id');
            $dni = explode(' ', $request->input('term'));
            $promocion = explode('_', $request->input('promocion'));
            $fechaInicio = $request->input('fechaInicio');
            $fechaFin = $request->input('fechafin');
            $total = $request->input('total');

            $estado = explode('[]', $request->input('estado'));
            $cuota_fecha = explode('[]', $request->input('cuota_fecha'));
            $cuota_precio = explode('[]', $request->input('cuota_precio'));

            $cliente = Cliente::where('dni', $dni[0])->get();
            $cliente1 = '';
            foreach ($cliente as $cli) {
                $cliente1 = $cli;
            }
            if (count($cliente) > 0) {
                $membresia = Membresia::FindOrFail($id);
                $membresia->user_id = auth()->guard('admin')->user()->id;
                $membresia->cliente_id = $cliente1->id;
                $membresia->promocion_id = $promocion[0];
                $membresia->fechaInicio = $fechaInicio;
                $membresia->fechaFin = $fechaFin;
                $membresia->total = $total;
                $membresia->estado = '1';
                if ($membresia->save()) {
                    $i = 0;
//                dd($estado);
                    $antigua_cuota = Cuota::where('membresia_id', $id)->delete();
                    foreach ($estado as $dato) {
                        $cuota = new Cuota();
                        $cuota->membresia_id = $membresia->id;
                        $cuota->user_id = auth()->guard('admin')->user()->id;;
                        $cuota->fechaCancelacion = $cuota_fecha[$i];
                        $cuota->monto = $cuota_precio[$i];
                        $cuota->fechaQCancelo = date("Y-m-d");
                        $cuota->estado = $dato;
                        $cuota->save();
                        $i++;
                    }
                }
                $tipomensaje = '1';
                $mensaje = 'Se edito la membresia.';
//            $promociones=Promocion::get();
                return $tipomensaje . '_' . $mensaje;
//            return view('editar-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
            } else {
                $tipomensaje = '0';
                $mensaje = 'El cliente no existe.';
//                $promociones=Promocion::get();
                return $tipomensaje . '_' . $mensaje;
//                return view('editar-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
            }
        } catch (Exception $e) {
//            return $e;
            $tipomensaje = '-1';
            $mensaje = $e;
//            $promociones=Promocion::get();
            return $tipomensaje . '_' . $mensaje;
//            return view('editar-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
        }


    }

    public function editarcliente(Request $request, $id)
    {
        try {
//            $id=$request->input('id');
            $cliente = Cliente::FindOrFail($id);
            $cliente1 = Cliente::get();
            $miembros1 = count($cliente1);
            $membresias1 = Membresia::get();
            $membresias1 = count($membresias1);
            $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
            return view('editar-cliente', ['cliente' => $cliente, 'tipomensaje' => '2', 'miembros' => $miembros1, 'membresias' => $membresias1,'privilegios'=>$privilegio]);
        } catch (Exception $e) {
            return $e;
        }


    }

    public function listamembresia()
    {
        $membresias = Membresia::get()->sortByDesc('id');
        $cliente1 = Cliente::get();
        $miembros1 = count($cliente1);
        $membresias1 = Membresia::get();
        $membresias1 = count($membresias1);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('lista-membresias', ['membresias2' => $membresias, 'miembros' => $miembros1, 'membresias' => $membresias1,'privilegios'=>$privilegio]);
    }

    public function cambiar_estado_cliente(Request $request)
    {
        $id = $request->input('id');
        $estado = $request->input('estado');
        $cliente = Cliente::findOrFail($id);
        $cliente->estado = $estado;
        $cliente->save();
        return 1;
    }

    public function ingresos()
    {
        $cliente1 = Cliente::get();
        $miembros1 = count($cliente1);
        $membresias1 = Membresia::get();
        $membresias1 = count($membresias1);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('reporte.ingresos-membresia', ['miembros' => $miembros1, 'membresias' => $membresias1,'privilegios'=>$privilegio]);
    }

    public function rpt_contratos()
    {
        $cliente1 = Cliente::get();
//        dd($cliente1);
        $miembros1 = count($cliente1);
        $membresias1 = Membresia::get();
        $membresias1 = count($membresias1);
        $membresias = Membresia::with('cliente', 'promocion', 'asistemacias')->get();
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();
//        dd($privilegio);
        return view('reporte.membresias', ['miembros' => $miembros1, 'membresias' => $membresias1, 'membresiass' => $membresias,'privilegios'=>$privilegio,'promociones'=>$promociones]);
    }

    public function rpt_membresia($id)
    {
        $membresia = Membresia::with('cliente', 'promocion', 'cuotas')->where('id', $id)->get();
        $pdf = \PDF::loadView('reporte-pdf.membresia', ['membresia' => $membresia]);
        return $pdf->download('rpt_membresia' . '_' . $id . '_' . date("d_m_Y") . '.pdf');
    }

    public function rpt_asistencia($id)
    {
        $membresia = Membresia::with('cliente', 'promocion', 'asistemacias')->where('id', $id)->get();
        $pdf = \PDF::loadView('reporte-pdf.asistencia', ['membresia' => $membresia]);
        return $pdf->download('rpt_asistencia' . '_' . $id . '_' . date("d_m_Y") . '.pdf');
    }

    public function lista_ingresos(Request $request)
    {

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $ingresos = Membresia::with(['cliente', 'promocion', 'cuotas' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fechaQCancelo', array($desde, $hasta));
        }])->get();
        return view('reporte-pdf.ingresos', ['ingresos' => $ingresos]);
    }

    public function lista_ingresos_rpt(Request $request)
    {

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $dated = new \DateTime($request->input('desde'));
        $dateh = new \DateTime($request->input('hasta'));
        $ingresos = Membresia::with(['cliente', 'promocion', 'cuotas' => function ($query) use ($desde, $hasta) {
            $query->whereBetween('fechaQCancelo', array($desde, $hasta));
        }])->get();
        $pdf = \PDF::loadView('reporte-pdf.rpt-ingresos', ['ingresos' => $ingresos, 'desde' => $dated->format('d-m-Y'), 'hasta' => $dateh->format('d-m-Y')]);
        return $pdf->download('rpt_ingresos' . '_' . date("d_m_Y") . '.pdf');

    }
    public function borra_cuota(Request $request)
    {
        $cuota=Cuota::where('id',$request->input('id'))->delete();
        if($cuota){
            return 1;
        }
        else{
            return 2;
        }
    }
    public function borar_membresia(Request $request)
    {
        $existe_asistencia=Asistencia::where('membresia_id',$request->input('id'))->get();
        if(count($existe_asistencia)>0){
            return 2;
        }
        else{
            $cuota=Membresia::where('id',$request->input('id'))->delete();
            if($cuota){
                return 1;
            }
            else{
                return 0;
            }
        }
    }
    public function congelar_membresia(){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('congelar',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio]);

    }

    public function congelar_membresia_add(Request $request){
        $id=$request->input('id');
        $desde=$request->input('desde');
        $hasta=$request->input('hasta');
        $congelado=new Congelado();
        $congelado->desde=$desde;
        $congelado->hasta=$hasta;
        $congelado->membresia_id=$id;

        $dias   = (strtotime($desde)-strtotime($hasta))/86400;
        $dias   = abs($dias); $dias = floor($dias); 
        

        if($congelado->save()>0){
            $membresia=Membresia::FindOrFail($id);
            $membresia->estado=2;
            $fecha = date($membresia->fechaFin);
            $nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
            $membresia->fechaFin=$nuevafecha;
            $membresia->save();
            return 1;
        }
        else
            return 0;

    }
    public function congelar_membresia_delete(Request $request){
        $id=$request->input('id');
        $congelado=Congelado::FindOrFail($id);
        if($congelado->delete()>0)
            return 1;
        else
            return 0;

    }
    
    public function ampliar_membresia(){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('ampliar',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio]);
    }
    function buscar_membresia_ampliar(Request $request){
        try {
            $dni =explode(' ',$request->input('dni'));
            $cliente=Cliente::where('dni', $dni[0])->get();
            $fecha = date('Y-m-d');
            $hora = date('H:m:s');
            if(count($dni)>0) {
                $membresia = Membresia::with(['cuotas', 'cliente'])
                    ->where('cliente_id',$cliente[0]->id)
                    ->get()
                    ->sortByDesc('id');

//                    ->sortByDesc('id');
//                dd($membresia);
                if (count($membresia) > 0) {
                    foreach ($membresia->take(1) as $membresi) {
                        if($membresi->estado==1 ||$membresi->estado==2){
                            $promocion = Promocion::where('id', $membresi->promocion_id)->get();
                              $tipomensaje = '1';
                            $mensaje = '';
                            return view('mensaje.rpt-membresia-ampliar', ['membresias' => $membresia, 'promociones' => $promocion, 'fecha' => $fecha, 'hora' => $hora, 'tipomensaje' => $tipomensaje, 'mensaje' => $mensaje,'estado'=>$membresi->estado]);
                        }
//                        else if($membresi->estado==2){
//                            $tipomensaje='0';
//                            $mensaje='no hay una membresia asignada para este cliente';
//                            return view('mensaje.rpt-membresia-ampliar', ['membresias' => $membresia,'promocion'=>'', 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
//                        }
                    }
                } else{
                    $tipomensaje='0';
                    $mensaje='no hay una membresia asignada para este cliente';
                    return view('mensaje.rpt-membresia-ampliar', ['membresias' => $membresia,'promocion'=>'', 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
                }
//                return '0';
            }
        }catch(Exception $e){
            $tipomensaje='-1';
            $mensaje=$e;
            return view('mensaje.rpt-membresia-ampliar', ['membresias' => $membresia, 'fecha' => $fecha, 'hora' => $hora,'tipomensaje'=>$tipomensaje,'mensaje'=>$mensaje]);
        }
    }

    public function ampliar_membresia_add(Request $request){
        $id=$request->input('id');
        $hasta=$request->input('hasta');
        $membresia=Membresia::FindOrFail($id);
        $membresia->fechaFin=$hasta;
        $membresia->estado=1;

        if($membresia->save()>0) {
            $congelados=Congelado::where('membresia_id',$id)->delete();
            return 1;
        }
        else
            return 0;

    }
}
