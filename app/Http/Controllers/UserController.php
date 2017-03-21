<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use App\Privilegio;
use App\Membresia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        return view('login');
    }
    public function inicio(){
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        return view('asistencia',['miembros'=>$miembros,'membresias'=>$membresias]);
    }
    public function nuevousuario( ){
        $tipomensaje='2';
        $mensaje='';
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        return view('nuevo-usuario',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
    }
    public function agregar_nuevousuario(Request $request){
        try{
            $dni=$request->input('dni');
            $nombres=$request->input('nombres');
            $apellidos=$request->input('apellidos');
            $telefono=$request->input('telefono');
            $email=$request->input('email');
            $contrasena=$request->input('contrasena');
            $rol=$request->input('rol');
            $privilegio=$request->input('privilegio');

            $buscar=User::where('dni',$dni)->where('email',$email)->get();
            if(count($buscar)==0){
                $user=new User();
                $user->dni=$dni;
                $user->name=$nombres;
                $user->apellidos=$apellidos;
                $user->telefono=$telefono;
                $user->email=$email;
                $user->estado='1';
                $user->tipoPersonal=$rol;
                $user->password=$contrasena;
                $user->save();
//                dd($privilegio);
                foreach ($privilegio as $item){
                    $Privilegio=new Privilegio();
                    $Privilegio->user_id=$user->id;
                    $Privilegio->nombre=$item;
                    $Privilegio->estado='1';
                    $Privilegio->save();
                }
                $tipomensaje='1';
                $mensaje='Se guardaron los datos del usuario.';
                $cliente=Cliente::get();
                $miembros=count($cliente);
                $membresias=Membresia::get();
                $membresias=count($membresias);
                return view('nuevo-usuario',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);

            }
            else{
                $tipomensaje='0';
                $mensaje='El usuario ya existe.';
                $cliente=Cliente::get();
                $miembros=count($cliente);
                $membresias=Membresia::get();
                $membresias=count($membresias);
                return view('nuevo-usuario',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);

            }
        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            $cliente=Cliente::get();
            $miembros=count($cliente);
            $membresias=Membresia::get();
            $membresias=count($membresias);
            return view('nuevo-usuario',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);

        }
    }
    public function editar_usuario(Request $request){
        try{
            $id=$request->input('id');
            $dni=$request->input('dni');
            $nombres=$request->input('nombres');
            $apellidos=$request->input('apellidos');
            $telefono=$request->input('telefono');
            $email=$request->input('email');
            $contrasena=$request->input('contrasena');
            $rol=$request->input('rol');
            $privilegio=$request->input('privilegio');

            $user=User::FindOrFail($id);
            $user->dni=$dni;
            $user->name=$nombres;
            $user->apellidos=$apellidos;
            $user->telefono=$telefono;
            $user->email=$email;
            $user->estado='1';
            $user->tipoPersonal=$rol;
            $user->password=$contrasena;
            $user->save();
            $anterior_privilegio=Privilegio::where('user_id',$id)->get();
            foreach ($anterior_privilegio as $item){
                $item->delete();
            }
//                dd($privilegio);
            if(count($privilegio)>0){
                foreach ($privilegio as $item){
                    $Privilegio=new Privilegio();
                    $Privilegio->user_id=$user->id;
                    $Privilegio->nombre=$item;
                    $Privilegio->estado='1';
                    $Privilegio->save();
                }
            }
            $usuarios=User::get();
            $cliente=Cliente::get();
            $miembros=count($cliente);
            $membresias=Membresia::get();
            $membresias=count($membresias);
            return view('nuevo-usuario',['usuarios'=>$usuarios,'miembros'=>$miembros,'membresias'=>$membresias]);

        }
        catch(Exception $e){
//            return $e;
            $tipomensaje='-1';
            $mensaje=$e;
            $cliente=Cliente::get();
            $miembros=count($cliente);
            $membresias=Membresia::get();
            $membresias=count($membresias);
            return view('editar-usuario',['mensaje'=>$mensaje,'tipomensaje'=>$tipomensaje,'miembros'=>$miembros,'membresias'=>$membresias]);
        }


    }
    public function editarusuario(Request $request,$id){
        try{
//            $id=$request->input('id');
            $user=User::FindOrFail($id);
            $privilegio=Privilegio::where('user_id',$id)->get();
//            dd($privilegio);
            $cliente=Cliente::get();
            $miembros=count($cliente);
            $membresias=Membresia::get();
            $membresias=count($membresias);
            return view('editar-usuario',['user'=>$user,'privilegios'=>$privilegio,'tipomensaje'=>'2','miembros'=>$miembros,'membresias'=>$membresias]);
        }
        catch(Exception $e){
           return $e;
        }


    }

    public function listausuario(){
        $usuarios=User::get();
        $cliente=Cliente::get();
        $miembros=count($cliente);
        $membresias=Membresia::get();
        $membresias=count($membresias);
        return view('lista-usuarios',['usuarios'=>$usuarios,'miembros'=>$miembros,'membresias'=>$membresias]);
    }
    public function cambiar_estado_usuario(Request $request){
        $id=$request->input('id');
        $estado=$request->input('estado');
        $usuarios=User::findOrFail($id);
        $usuarios->estado=$estado;
        $usuarios->save();
        return 1;
    }



}
