<?php

namespace App\Http\Controllers;

use App\Membresia;
use App\Cliente;
use App\Cuota;
use App\Promocion;

use Illuminate\Http\Request;

class MembresiaController extends Controller
{
    //
    public function membresianueva( ){
        $tipomensaje='2';
        $mensaje='';
        $promociones=Promocion::get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
    }
    public function agregar_membresianueva(Request $request){
        try{
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);

            $dni=explode(' ',$request->input('term'));
            $promocion=explode('_',$request->input('promocion'));
            $fechaInicio=$request->input('fechaInicio');
            $fechaFin=$request->input('fechafin');
            $total=$request->input('total');

            $estado=explode('[]',$request->input('estado'));
            $cuota_fecha=explode('[]',$request->input('cuota_fecha'));
            $cuota_precio=explode('[]',$request->input('cuota_precio'));

            $cliente=Cliente::where('dni',$dni[0])->get();
            $cliente1='';
            foreach ($cliente as $cli){
                $cliente1= $cli;
            }
            if(count($cliente)>0){
            $membresia=new Membresia();
            $membresia->user_id=auth()->guard('admin')->user()->id;
            $membresia->cliente_id=$cliente1->id;
            $membresia->promocion_id=$promocion[0];
            $membresia->fechaInicio=$fechaInicio;
            $membresia->fechaFin=$fechaFin;
            $membresia->total=$total;
            $membresia->estado='1';
            if($membresia->save()){
                $i=0;
//                dd($estado);
               foreach ($estado as $dato){
                   $cuota=new Cuota();
                   $cuota->membresia_id=$membresia->id;
                   $cuota->user_id=auth()->guard('admin')->user()->id;;
                   $cuota->fechaCancelacion=$cuota_fecha[$i];
                   $cuota->monto=$cuota_precio[$i];
                   $cuota->fechaQCancelo=date("Y-m-d");
                   $cuota->estado=$dato;
                   $cuota->save();
                   $i++;
               }
            }
            $tipomensaje='1';
            $mensaje='Se guardo la membresia.';
//            $promociones=Promocion::get();
            return $tipomensaje.'_'.$mensaje;
//            return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
            }
            else{
                $tipomensaje='0';
                $mensaje='El cliente no existe.';
//                $promociones=Promocion::get();
                return $tipomensaje.'_'.$mensaje;
//                return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
            }
        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
//            $promociones=Promocion::get();
            return $tipomensaje.'_'.$mensaje;
//            return view('nueva-membresia',['mensaje'=>$mensaje,'promociones'=>$promociones,'tipomensaje'=>$tipomensaje]);
        }
    }
    public function editar_cliente(Request $request){
        try{
            $id=$request->input('id');
            $dni=$request->input('dni');
            $nombres=$request->input('nombres');
            $apellidos=$request->input('apellidos');
            $direccion=$request->input('direccion');
            $telefono=$request->input('telefono');
            $email=$request->input('email');
            $contrasena=$request->input('contrasena');

            $cliente=Cliente::FindOrFail($id);
            $cliente->dni=$dni;
            $cliente->nombres=$nombres;
            $cliente->apellidos=$apellidos;
            $cliente->direccion=$direccion;
            $cliente->telefono=$telefono;
            $cliente->email=$email;
            $cliente->estado='1';
            $cliente->password=$contrasena;
            $cliente->save();

            $clientes=Cliente::get();
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('lista-clientes',['clientes'=>$clientes,'miembros'=>$miembros1,'membresias'=>$membresias1]);

        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('editar-cliente',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros1,'membresias'=>$membresias1]);
        }


    }
    public function editarcliente(Request $request,$id){
        try{
//            $id=$request->input('id');
            $cliente=Cliente::FindOrFail($id);
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('editar-cliente',['cliente'=>$cliente,'tipomensaje'=>'2','miembros'=>$miembros1,'membresias'=>$membresias1]);
        }
        catch(Exception $e){
            return $e;
        }


    }

    public function listamembresia(){
        $membresias=Membresia::get()->sortByDesc('id');
        $cliente1=Cliente::get();
        $miembros1=count($cliente1);
        $membresias1=Membresia::get();
        $membresias1=count($membresias1);
        return view('lista-membresias',['membresias2'=>$membresias,'miembros'=>$miembros1,'membresias'=>$membresias1]);
    }
    public function cambiar_estado_cliente(Request $request){
        $id=$request->input('id');
        $estado=$request->input('estado');
        $cliente=Cliente::findOrFail($id);
        $cliente->estado=$estado;
        $cliente->save();
        return 1;
    }
    public function ingresos(){
        $cliente1=Cliente::get();
        $miembros1=count($cliente1);
        $membresias1=Membresia::get();
        $membresias1=count($membresias1);
        return view('reporte.ingresos-membresia',['miembros'=>$miembros1,'membresias'=>$membresias1]);
    }

}
