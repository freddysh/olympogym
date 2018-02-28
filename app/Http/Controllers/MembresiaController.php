<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Congelado;
use App\Eventos;
use App\FormatoMembresia;
use App\Membresia;
use App\Cliente;
use App\Cuota;
use App\Privilegio;
use App\Promocion;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

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
    public function membresiarenovar()
    {
        $tipomensaje = '2';
        $mensaje = '';
        $promociones = Promocion::get();
        $cliente = Cliente::get();
        $miembros = count($cliente);
        $membresias = Membresia::get();
        $membresias = count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('renovar-membresia', ['mensaje' => $mensaje, 'promociones' => $promociones, 'tipomensaje' => $tipomensaje, 'miembros' => $miembros, 'membresias' => $membresias,'privilegios'=>$privilegio]);
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
//return $request->input('membresia_formato');
            $cliente1 = Cliente::get();
            $miembros1 = count($cliente1);
            $membresias1 = Membresia::get();
            $membresias1 = count($membresias1);

            $dni = explode(' ', $request->input('term'));
            $promocion = explode('_', $request->input('promocion'));
            $fechaInicio = $request->input('fechaInicio');
            $fechaFin = $request->input('fechafin');
            $total = $request->input('total');

            $estado =$request->input('estado');
            $cuota_fecha = $request->input('cuota_fecha');
            $cuota_precio = $request->input('cuota_precio');

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
                    $formato=new FormatoMembresia();
                    $formato->contenido=$request->input('membresia_formato');
                    $formato->membresia_id=$membresia->id;
                    $formato->save();
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
                return redirect()->route('rpt_nueva_membresia_path',['membresia_id'=>$membresia->id,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
            } else {
                $tipomensaje = '0';
                $mensaje = 'El cliente no existe.';
                return redirect()->route('rpt_nueva_membresia_path',['membresia_id'=>0,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);

            }
        } catch (Exception $e) {
            $tipomensaje = '-1';
            $mensaje = $e;
            return redirect()->route('rpt_nueva_membresia_path',['membresia_id'=>0,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
        }
    }
    public function agregar_membresiarenovar(Request $request)
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

            $estado =$request->input('estado');
            $cuota_fecha = $request->input('cuota_fecha');
            $cuota_precio = $request->input('cuota_precio');

            $cliente = Cliente::where('dni', $dni[0])->get();
            $cliente1 = '';
            foreach ($cliente as $cli) {
                $cliente1 = $cli;
            }
            if (count($cliente) > 0) {

                $membresia_standBy=Membresia::where('cliente_id',$cliente1->id)->get();
                foreach ($membresia_standBy as $membresia_standBy_){
                    $temp=Membresia::findOrFail($membresia_standBy_->id);
                    $temp->estado=0;
                    $temp->save();
                }

                $membresia = new Membresia();
                $membresia->user_id = auth()->guard('admin')->user()->id;
                $membresia->cliente_id = $cliente1->id;
                $membresia->promocion_id = $promocion[0];
                $membresia->fechaInicio = $fechaInicio;
                $membresia->fechaFin = $fechaFin;
                $membresia->total = $total;
                $membresia->estado = '1';
                if ($membresia->save()) {
                    $formato=new FormatoMembresia();
                    $formato->contenido=$request->input('membresia_formato');
                    $formato->membresia_id=$membresia->id;
                    $formato->save();
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
                return redirect()->route('rpt_renovar_membresia_path',['membresia_id'=>$membresia->id,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
            } else {
                $tipomensaje = '0';
                $mensaje = 'El cliente no existe.';
                return redirect()->route('rpt_renovar_membresia_path',['membresia_id'=>0,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
            }
        } catch (Exception $e) {
            $tipomensaje = '-1';
            $mensaje = $e;
            return redirect()->route('rpt_renovar_membresia_path',['membresia_id'=>0,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
        }
    }
    public function editar_membresia(Request $request)
    {
        try {
            $formato_id=$request->input('formato_id');
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

            $estado = $request->input('estado');
            $cuota_fecha = $request->input('cuota_fecha');
            $cuota_precio = $request->input('cuota_precio');

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
                    $formato=FormatoMembresia::FindOrFail($formato_id);
                    $formato->contenido=$request->input('membresia_formato');
                    $formato->membresia_id=$membresia->id;
                    $formato->save();
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
                return redirect()->route('rpt_nueva_membresia_path',['membresia_id'=>$membresia->id,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
            } else {
                $tipomensaje = '0';
                $mensaje = 'El cliente no existe.';
                return redirect()->route('rpt_nueva_membresia_path',['membresia_id'=>0,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
            }
        } catch (Exception $e) {
            $tipomensaje = '-1';
            $mensaje = $e;
            return redirect()->route('rpt_nueva_membresia_path',['membresia_id'=>0,'mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje]);
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
        $promociones=Promocion::get();
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('lista-membresias', ['membresias2' => $membresias, 'miembros' => $miembros1, 'membresias' => $membresias1,'privilegios'=>$privilegio,'promociones'=>$promociones]);
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
        return view('reporte.membresias', ['miembros' => $miembros1, 'membresias' => $membresias1, 'membresia2' => $membresias,'privilegios'=>$privilegio,'promociones'=>$promociones]);
    }
    public function asistencia_view($id)
    {
        $promociones=Promocion::get();
        $membresia = Membresia::where('id', $id)->get();

        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('view.asistencia',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,'id'=>$id,'promociones'=>$promociones,'membresia'=>$membresia]);
//
//        return view('reporte.asistencia', ['membresia' => $membresia,'promociones'=>$promociones]);
    }
    public function asistencia_view_get($id)
    {
        $membresia =DB::table('asistencia')
            ->select('id','hora as title','fecha as start','fecha as end')
            ->where('membresia_id',$id)->get()->toArray();

//        $membresia = Membresia::where('id', $id)->get();
//        $arreglo=array();
//        foreach($membresia as $membresia_){
//            foreach($membresia->asistemacias as $asistencia){
//                $arreglo[]=$asistencia->id.'';
//            }
//        }
        return response()->json($membresia);
    }

    public function rpt_membresia($id)
    {
        $membresia = Membresia::with('cliente', 'promocion', 'cuotas')->where('id', $id)->get();
        $pdf = \PDF::loadView('reporte-pdf.membresia', ['membresia' => $membresia]);
        return $pdf->download('rpt_membresia' . '_' . $id . '_' . date("d_m_Y") . '.pdf');
    }

    public function rpt_asistencia($id)
    {
        $promociones=Promocion::get();
        $membresia = Membresia::where('id', $id)->get();
        $asistencia1=Asistencia::where('membresia_id',$id)->get();

        $arrayAsistMes=[];
        foreach($asistencia1 as $memb){
            $fecha=explode('-',$memb->fecha);
            $fecha=$fecha[0].'-'.$fecha[1];
            if(!in_array($fecha,$arrayAsistMes))
                $arrayAsistMes[]=$fecha;
        }
//        dd($arrayAsistMes);
//        return view('reporte-pdf.asistencia', ['membresia' => $membresia,'promociones'=>$promociones,'id'=>$id,'arrayAsistMes'=>$arrayAsistMes,'asistencia1'=>$asistencia1]);
        $pdf = \PDF::loadView('reporte-pdf.asistencia', ['membresia' => $membresia,'promociones'=>$promociones,'id'=>$id,'arrayAsistMes'=>$arrayAsistMes,'asistencia1'=>$asistencia1]);
        $pdf->setPaper('A4', 'landscape');
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
        $membresia=Membresia::FindOrFail($congelado->membresia_id);

        if($congelado->delete()>0){
            $membresia->estado=1;
            $membresia->save();
            return 1;
        }
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
    public function ctas_vencimiento(){
        $periodo=10;
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $dt->addDay($periodo);
        $fecha=$dt->toDateString();
        $membresia2=Membresia::where('estado','>',0)->get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();
        return view('reporte.cuentas',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,
            'membresia2'=>$membresia2,'periodo'=>$periodo,'fecha_actual'=>$fecha_actual,'fecha'=>$fecha,'promociones'=>$promociones]);
    }
    public function membresias_vencimiento(){
        $periodo=10;
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $dt->addDay($periodo);
        $fecha=$dt->toDateString();
        $membresia2=Membresia::get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();
        return view('reporte.membresias-vencimiento',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,
            'membresia2'=>$membresia2,'periodo'=>$periodo,'fecha_actual'=>$fecha_actual,'fecha'=>$fecha,'promociones'=>$promociones]);
    }
    public function lista_cuentas(Request $request){
        $periodo=$request->input('periodo');
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $dt->addDay($periodo);
        $fecha=$dt->toDateString();
        $membresia2=Membresia::where('estado','>',0)->get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();
        return view('reporte.cuentas',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,
            'membresia2'=>$membresia2,'periodo'=>$periodo,'fecha_actual'=>$fecha_actual,'fecha'=>$fecha,'promociones'=>$promociones]);
    }
    public function rpt_cuentas($id)
    {
        $periodo=$id;
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $dt->addDay($periodo);
        $fecha=$dt->toDateString();
        $membresia2=Membresia::where('estado','>',0)->get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();

        $pdf = \PDF::loadView('reporte-pdf.cuentas',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,
            'membresia2'=>$membresia2,'periodo'=>$periodo,'fecha_actual'=>$fecha_actual,'fecha'=>$fecha,'promociones'=>$promociones]);
        return $pdf->download('rpt_cuentas_por_cobrar' . '_' . $id . '_' . date("d_m_Y") . '.pdf');
    }
    public function lista_membresias(Request $request){
        $periodo=$request->input('periodo');
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $dt->addDay($periodo);
        $fecha=$dt->toDateString();
        $membresia2=Membresia::get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();
        return view('reporte.membresias-vencimiento',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,
            'membresia2'=>$membresia2,'periodo'=>$periodo,'fecha_actual'=>$fecha_actual,'fecha'=>$fecha,'promociones'=>$promociones]);
    }
    public function rpt_membresias($id)
    {
        $periodo=$id;
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $dt->addDay($periodo);
        $fecha=$dt->toDateString();
        $membresia2=Membresia::get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        $promociones=Promocion::get();

        $pdf = \PDF::loadView('reporte-pdf.membresias',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,
            'membresia2'=>$membresia2,'periodo'=>$periodo,'fecha_actual'=>$fecha_actual,'fecha'=>$fecha,'promociones'=>$promociones]);
        return $pdf->download('rpt_membresias_por_cobrar' . '_' . $id . '_' . date("d_m_Y") . '.pdf');
    }
    public function agendar_membresia_ajax(Request $request){
        $id=$request->input('id');
        $prom=$request->input('prom_'.$id);
        $titulo=$prom.$request->input('evento_'.$id);
        $fecha=$request->input('fecha_'.$id);
        $hora=$request->input('hora_'.$id);

        $evento=new Eventos();
        $evento->titulo=$titulo;
        $evento->fechaEvento=$fecha;
        $evento->horaEvento=$hora;
        $evento->membresia_id=$id;
        $evento->user_id=auth()->guard('admin')->user()->id;
        $evento->estado=1;
        if($evento->save()>0) {
            return response()->json(1);
        }
        else
            return response()->json(0);

    }
    public function agenda_membresia(){
        $agenda=Eventos::where('estado',1)->get();
        $dt = Carbon::now();
        $dt->subHours(5);
        $fecha_actual=$dt->toDateString();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('reporte.agenda',['miembros'=>$miembros,'membresias'=>$membresias,'privilegios'=>$privilegio,'agenda'=>$agenda,'fecha_actual'=>$fecha_actual]);
    }
    public function agenda_membresia_get(){
        $agenda =DB::table('eventos')
            ->select('id','titulo as title','fechaEvento as start','fechaEvento as end')
            ->where('estado',1)->get()->toArray();
        return $agenda ;
    }
    public function rpt_nueva_membresia($id,$mensaje,$tipomensaje){
        $membresia=null;
        if($id!=0) {
            $membresia = Membresia::FindOrFail($id);
        }
        $promociones=Promocion::get();
        $cliente = Cliente::get();
        $miembros = count($cliente);
        $membresias = Membresia::get();
        $membresias = count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('rpt.rpt-nueva-membresia',['membresia_id'=>$id,'membresi'=>$membresia,'mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje, 'miembros' => $miembros, 'membresias' => $membresias,'privilegios'=>$privilegio]);
    }
    public function rpt_renovar_membresia($id,$mensaje,$tipomensaje){
        $membresia=null;
        if($id!=0) {
            $membresia = Membresia::FindOrFail($id);
        }
        $promociones=Promocion::get();
        $cliente = Cliente::get();
        $miembros = count($cliente);
        $membresias = Membresia::get();
        $membresias = count($membresias);
        $privilegio=Privilegio::where('user_id',auth()->guard('admin')->user()->id)->get();
        return view('rpt.rpt-nueva-membresia',['membresia_id'=>$id,'membresi'=>$membresia,'mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje, 'miembros' => $miembros, 'membresias' => $membresias,'privilegios'=>$privilegio]);
    }

}
