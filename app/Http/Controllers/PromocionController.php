<?php

namespace App\Http\Controllers;

use App\Promocion;
use App\Cliente;
use App\Membresia;
use Illuminate\Http\Request;


class PromocionController extends Controller
{
    //
    public function promocionnuevo( ){
        $tipomensaje='2';
        $mensaje='';
        $cliente1=Cliente::get();
        $miembros1=count($cliente1);
        $membresias1=Membresia::get();
        $membresias1=count($membresias1);
        return view('nueva-promocion',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros1,'membresias'=>$membresias1]);
    }
    public function agregar_promocionnueva(Request $request){
        try{
            $titulo=$request->input('titulo');
            $detalle=$request->input('detalle');
            $precio=$request->input('precio');
            $duracion=$request->input('duracion');
            $periodo=$request->input('periodo');

            $promocion=new Promocion();
            $promocion->titulo=$titulo;
            $promocion->detalle=$detalle;
            $promocion->precio=$precio;
            $promocion->duracion=$duracion;
            $promocion->tipoDuracion=$periodo;
            $promocion->estado='1';

            if($promocion->save()){
                $tipomensaje='1';
                $mensaje='Se guardaron los datos de la promocion.';
                $cliente1=Cliente::get();
                $miembros1=count($cliente1);
                $membresias1=Membresia::get();
                $membresias1=count($membresias1);
                return view('nueva-promocion',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros1,'membresias'=>$membresias1]);
            }
            else{
                $tipomensaje='0';
                $mensaje='Error al guardar los datos de la promocion.';
                $cliente1=Cliente::get();
                $miembros1=count($cliente1);
                $membresias1=Membresia::get();
                $membresias1=count($membresias1);
                return view('nueva-promocion',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros1,'membresias'=>$membresias1]);
            }
        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('nueva-promocion',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros1,'membresias'=>$membresias1]);
        }
    }
    public function editar_promocion(Request $request){
        try{
            $id=$request->input('id');
            $titulo=$request->input('titulo');
            $detalle=$request->input('detalle');
            $precio=$request->input('precio');
            $duracion=$request->input('duracion');
            $periodo=$request->input('periodo');


            $promocion=Promocion::FindOrFail($id);
            $promocion->titulo=$titulo;
            $promocion->detalle=$detalle;
            $promocion->precio=$precio;
            $promocion->duracion=$duracion;
            $promocion->tipoDuracion=$periodo;
            $promocion->estado='1';
            $promocion->save();

            $promociones=Promocion::get();
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('nueva-promociones',['promociones'=>$promociones,'miembros'=>$miembros1,'membresias'=>$membresias1]);


        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('nueva-promocion',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros1,'membresias'=>$membresias1]);

        }


    }
    public function editarpromocion(Request $request,$id){
        try{
            $promocion=Promocion::FindOrFail($id);
            $cliente1=Cliente::get();
            $miembros1=count($cliente1);
            $membresias1=Membresia::get();
            $membresias1=count($membresias1);
            return view('nueva-promocion',['promocion'=>$promocion,'tipomensaje'=>'2','miembros'=>$miembros1,'membresias'=>$membresias1]);
        }
        catch(Exception $e){
            return $e;
        }


    }

    public function listapromocion(){
        $promociones=Promocion::get();
        $cliente1=Cliente::get();
        $miembros1=count($cliente1);
        $membresias1=Membresia::get();
        $membresias1=count($membresias1);
        return view('lista-promociones',['promociones'=>$promociones,'tipomensaje'=>'2','miembros'=>$miembros1,'membresias'=>$membresias1]);

    }
    public function cambiar_estado_promocion(Request $request){
        $id=$request->input('id');
        $estado=$request->input('estado');
        $promocion=Promocion::findOrFail($id);
        $promocion->estado=$estado;
        $promocion->save();
        return 1;
    }
}
