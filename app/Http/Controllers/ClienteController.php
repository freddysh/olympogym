<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Membresia;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    public function clientenuevo( ){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        $tipomensaje='2';
        $mensaje='';
        return view('nuevo-cliente',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
    }
    public function agregar_clientenuevo(Request $request){
        try{
            $cliente=Cliente::get();
            $miembros=count($cliente);
            $membresias=Membresia::get();
            $membresias=count($membresias);

            $dni=$request->input('dni');
            $nombres=$request->input('nombres');
            $apellidos=$request->input('apellidos');
            $direccion=$request->input('direccion');
            $telefono=$request->input('telefono');
            $email=$request->input('email');
            $contrasena=$request->input('contrasena');

            $buscar=Cliente::where('dni',$dni)->where('email',$email)->get();
            if(count($buscar)==0){
                $cliente=new Cliente();
                $cliente->dni=$dni;
                $cliente->nombres=$nombres;
                $cliente->apellidos=$apellidos;
                $cliente->direccion=$direccion;
                $cliente->telefono=$telefono;
                $cliente->email=$email;
                $cliente->estado='1';
                $cliente->password=$contrasena;
                $cliente->save();
//
                $tipomensaje='1';
                $mensaje='Se guardaron los datos del cliente.';
                return view('nuevo-cliente',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
            }
            else{
                $tipomensaje='0';
                $mensaje='El cliente ya existe.';
                return view('nuevo-cliente',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
            }
        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            return view('nuevo-cliente',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
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
            $cliente=Cliente::get();
            $miembros=count($cliente);
            $membresias=Membresia::get();
            $membresias=count($membresias);
            return view('lista-clientes',['clientes'=>$clientes,'miembros'=>$miembros,'membresias'=>$membresias]);

        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            return view('editar-cliente',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
        }


    }
    public function editarcliente(Request $request,$id){
        try{
            $cliente1=Cliente::get();
            $miembros=count($cliente1);
            $membresias=Membresia::get();
            $membresias=count($membresias);
//            $id=$request->input('id');
            $cliente=Cliente::FindOrFail($id);
            return view('editar-cliente',['cliente'=>$cliente,'tipomensaje'=>'2','miembros'=>$miembros,'membresias'=>$membresias]);
        }
        catch(Exception $e){
            return $e;
        }


    }

    public function listacliente(){
        $clientes=Cliente::get();
        $cliente1=Cliente::get();
        $miembros=count($cliente1);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        return view('lista-clientes',['clientes'=>$clientes,'miembros'=>$miembros,'membresias'=>$membresias]);
    }
    public function cambiar_estado_cliente(Request $request){
        $id=$request->input('id');
        $estado=$request->input('estado');
        $cliente=Cliente::findOrFail($id);
        $cliente->estado=$estado;
        $cliente->save();
        return 1;
    }
    public function autocompletedni(Request $request){
        if($request->ajax()){
            $dni = $request->get('term');

            $results = [];

            $cliente=Cliente::where('dni','like','%'.$dni.'%')
                            ->orWhere('nombres','like','%'.$dni.'%')
                            ->orWhere('apellidos','like','%'.$dni.'%')
                            ->get();

            foreach ($cliente as $query)
            {
                $results[] = [ 'id' => $query->id, 'value' => $query->dni.' '.$query->nombres.' '.$query->apellidos ];
            }
            return response()->json($results);
        }
    }
}