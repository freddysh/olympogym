<?php
use App\Cliente;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*-- Inicio Metodos para logeo de usuarios del sistema*/
Route::get('/', [
    'uses' => 'UserController@index',
    'as' => 'login_path',
]);
Route::post('login', [
    'uses' => 'UserAuthController@store',
    'as' => 'user_auth_store_path',
]);
Route::get('logout', [
    'uses' => 'UserAuthController@destroy',
    'as' => 'logout_patch',
]);
Route::group(['middleware'=>'admin'],function(){
    Route::any('admin', [
        'uses' => 'UserController@inicio',
        'as' => 'admin_path',
    ]);
    Route::get('nuevo-usuario', [
        'uses' => 'UserController@nuevousuario',
        'as' => 'nuevo_usuario_path',
    ]);
    Route::post('nuevo-usuario', [
        'uses' => 'UserController@agregar_nuevousuario',
        'as' => 'nuevo_usuario_path',
    ]);
    Route::get('lista-usuario', [
        'uses' => 'UserController@listausuario',
        'as' => 'lista_usuario_path',
    ]);
    Route::get('editar-usuario/{id}', [
        'uses' => 'UserController@editarusuario',
        'as' => 'editar_usuario_get_path',
    ]);
    Route::post('editar-usuario', [
        'uses' => 'UserController@editar_usuario',
        'as' => 'editar_usuario_path',
    ]);
    Route::post('/cambiar_estado_usuario', [
        'uses' => 'UserController@cambiar_estado_usuario',
        'as' => 'cambiar_estado_usuario_path',
    ]);

    Route::get('nuevo-cliente', [
        'uses' => 'ClienteController@clientenuevo',
        'as' => 'nuevo_cliente_path',
    ]);
    Route::post('nuevo-cliente', [
        'uses' => 'ClienteController@agregar_clientenuevo',
        'as' => 'nuevo_cliente_path',
    ]);
    Route::get('editar-cliente/{id}', [
        'uses' => 'ClienteController@editarcliente',
        'as' => 'editar_cliente_get_path',
    ]);
    Route::post('editar-cliente', [
        'uses' => 'ClienteController@editar_cliente',
        'as' => 'editar_cliente_path',
    ]);
    Route::post('/cambiar_estado_cliente', [
        'uses' => 'ClienteController@cambiar_estado_cliente',
        'as' => 'cambiar_estado_cliente_path',
    ]);
    Route::get('lista-cliente', [
        'uses' => 'ClienteController@listacliente',
        'as' => 'lista_cliente_path',
    ]);
    Route::get('asistencia', [
        'uses' => 'AsistenciaController@mostrar',
        'as' => 'asistencia_path',
    ]);
    Route::post('/asistencia', [
        'uses' => 'AsistenciaController@guardar',
        'as' => 'asistencia_cliente_path',
    ]);

    Route::get('nueva-promocion', [
        'uses' => 'PromocionController@promocionnuevo',
        'as' => 'nueva_promocion_path',
    ]);
    Route::post('nueva-promocion', [
        'uses' => 'PromocionController@agregar_promocionnueva',
        'as' => 'nueva_promocion_path',
    ]);
    Route::get('editar-promocion/{id}', [
        'uses' => 'PromocionController@editarpromocion',
        'as' => 'editar_promocion_get_path',
    ]);
    Route::post('editar-promocion', [
        'uses' => 'PromocionController@editar_promocion',
        'as' => 'editar_promocion_path',
    ]);
    Route::post('/cambiar_estado_promocion', [
        'uses' => 'PromocionController@cambiar_estado_promocion',
        'as' => 'cambiar_estado_promocion',
    ]);
    Route::get('lista-promocion', [
        'uses' => 'PromocionController@listapromocion',
        'as' => 'lista_promocion_path',
    ]);

    Route::get('nueva-membresia', [
        'uses' => 'MembresiaController@membresianueva',
        'as' => 'nueva_membresia_path',
    ]);
    Route::post('nueva-membresia', [
        'uses' => 'MembresiaController@agregar_membresianueva',
        'as' => 'nueva_membresia_path',
    ]);
    Route::post('/nueva_membresia', [
        'uses' => 'MembresiaController@agregar_membresianueva',
        'as' => 'nueva_membresia1_path',
    ]);

    Route::get('editar-membresia/{id}', [
        'uses' => 'MembresiaController@editarmembresia',
        'as' => 'editar_membresia_get_path',
    ]);
    Route::post('/editar_membresia', [
        'uses' => 'MembresiaController@editar_membresia',
        'as' => 'editar_membresia_path',
    ]);
    Route::post('/cambiar_estado_membresia', [
        'uses' => 'MembresiaController@cambiar_estado_membresia',
        'as' => 'cambiar_estado_membresia',
    ]);
    Route::get('lista-membresia', [
        'uses' => 'MembresiaController@listamembresia',
        'as' => 'lista_membresia_path',
    ]);
    Route::get('buscar-cliente', [
        'uses' => 'ClienteController@autocompletedni',
        'as' => 'buscar_cliente_path',
    ]);
    Route::post('/generar_cuotas', [
        'uses' => 'CuotaController@generar',
        'as' => 'generar_cuotas_path',
    ]);
    Route::get('ingresos-membresia', [
        'uses' => 'MembresiaController@ingresos',
        'as' => 'ingresos_membresia_path',
    ]);


});
/*-- Fin Metodos para logeo de usuarios del sistema*/

