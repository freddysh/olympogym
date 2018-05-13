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
    Route::post('/buscar_cuotas', [
        'uses' => 'CuotaController@buscar_cuotas',
        'as' => 'buscar_cuotas_path',
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
    Route::get('nueva/membresia', [
        'uses' => 'MembresiaController@membresiarenovar',
        'as' => 'renovar_membresia_path',
    ]);
    Route::post('nueva/membresia', [
        'uses' => 'MembresiaController@agregar_membresiarenovar',
        'as' => 'renovar_membresia_path',
    ]);
    Route::post('/nueva_membresia', [
        'uses' => 'MembresiaController@agregar_membresianueva',
        'as' => 'nueva_membresia1_path',
    ]);
    Route::post('/renovar_membresia', [
        'uses' => 'MembresiaController@agregar_membresiarenovar',
        'as' => 'renovar_membresia1_path',
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
    Route::get('pagar-cuota', [
        'uses' => 'CuotaController@pagar',
        'as' => 'pagar_cuota_path',
    ]);
    Route::post('/pagar_cuota_ahora', [
        'uses' => 'CuotaController@pagar_cuota_ahora',
        'as' => 'pagar_cuota_ahora_path',
    ]);
    Route::get('reporte-clientes', [
        'uses' => 'ClienteController@reporte_cliente',
        'as' => 'reporte_clientes_path',
    ]);
    Route::get('rpt-clientes', [
        'uses' => 'ClienteController@rpt_cliente',
        'as' => 'rpt_cliente_path',
    ]);

    Route::get('asistencia-clientes', [
        'uses' => 'AsistenciaController@reporte_asistencia',
        'as' => 'reporte_asistencia_path',
    ]);
    Route::get('/asistencia_clientes', [
        'uses' => 'AsistenciaController@mostrar_asistencia',
        'as' => 'reporte_asistencia_path',
    ]);
    Route::get('/rpt_clientes', [
        'uses' => 'ClienteController@rpt_cliente',
        'as' => 'rpt_cliente_path',
    ]);
    Route::get('rpt-contratos', [
        'uses' => 'MembresiaController@rpt_contratos',
        'as' => 'rpt_contratos_path',
    ]);
    Route::get('rpt_membresia/{id}', [
        'uses' => 'MembresiaController@rpt_membresia',
        'as' => 'rpt_membresia_path',
    ]);
    Route::get('rpt_asistencia/{id}', [
        'uses' => 'MembresiaController@rpt_asistencia',
        'as' => 'rpt_asistencia_path',
    ]);
    Route::get('membresia/asistencia/{id}', [
        'uses' => 'MembresiaController@asistencia_view',
        'as' => 'asistencia_view_path',
    ]);
    Route::get('membresia/asistencia-get/{id}', [
        'uses' => 'MembresiaController@asistencia_view_get',
        'as' => 'asistencia_view_get_path',
    ]);
    Route::get('rpt-ingresos', [
        'uses' => 'MembresiaController@ingresos',
        'as' => 'reporte_ingresos_path',
    ]);
    Route::get('rpt-ctas-vencimiento', [
        'uses' => 'MembresiaController@ctas_vencimiento',
        'as' => 'reporte_cuentas_por_vencer_path',
    ]);
    Route::post('rpt-ingresos', [
        'uses' => 'MembresiaController@lista_ingresos',
        'as' => 'listar_ingresos_path',
    ]);
    Route::post('ingresos-rpt', [
        'uses' => 'MembresiaController@lista_ingresos_rpt',
        'as' => 'lista_ingresos_rpt_path',
    ]);
    Route::post('editar_membresia_borrar_cuota', [
        'uses' => 'MembresiaController@borra_cuota',
        'as' => 'editar_membresia_borrar_cuota_path',
    ]);
    Route::post('/borar_promocion', [
        'uses' => 'PromocionController@borar_promocion',
        'as' => 'borar_promocion_path',
    ]);
    Route::post('/borar_membresia', [
        'uses' => 'MembresiaController@borar_membresia',
        'as' => 'borar_membresia_path',
    ]);

    Route::get('/congelar_membresia', [
        'uses' => 'MembresiaController@congelar_membresia',
        'as' => 'congelar_path',
    ]);
    Route::post('/buscar_cuotas_congelar', [
        'uses' => 'CuotaController@buscar_cuotas_congelar',
        'as' => 'buscar_cuotas_congelar_path',
    ]);
    Route::post('/congelar_add', [
        'uses' => 'MembresiaController@congelar_membresia_add',
        'as' => 'congelar_add_path',
    ]);
    Route::post('/congelar_delete', [
        'uses' => 'MembresiaController@congelar_membresia_delete',
        'as' => 'descongelar_add_path',
    ]);
    Route::get('/ampliar_membresia', [
        'uses' => 'MembresiaController@ampliar_membresia',
        'as' => 'ampliar_path',
    ]);
    Route::post('/buscar_membresia_ampliar', [
        'uses' => 'MembresiaController@buscar_membresia_ampliar',
        'as' => 'buscar_membresia_ampliar_path',
    ]);
    Route::post('/ampliar_add', [
        'uses' => 'MembresiaController@ampliar_membresia_add',
        'as' => 'ampliar_add_path',
    ]);

    Route::post('/editar-cliente', [
        'uses' => 'ClienteController@editar_cliente_ajax',
        'as' => 'editar_cliente_ajax_path',
    ]);
    Route::post('/lista-cuentas', [
        'uses' => 'MembresiaController@lista_cuentas',
        'as' => 'lista_cuentas_path',
    ]);
    Route::get('rpt-cuentas/{id}', [
        'uses' => 'MembresiaController@rpt_cuentas',
        'as' => 'rpt-cuentas_path',
    ]);
    Route::get('rpt-membresias-vencimiento', [
        'uses' => 'MembresiaController@membresias_vencimiento',
        'as' => 'reporte_membresias_por_vencer_path',
    ]);
    Route::post('/lista-membresias', [
        'uses' => 'MembresiaController@lista_membresias',
        'as' => 'reporte_membresias_por_vencer2_path',
    ]);
    Route::get('rpt-membresias/{id}', [
        'uses' => 'MembresiaController@rpt_membresias',
        'as' => 'rpt-membresias_path',
    ]);
    Route::post('/agendar_membresia', [
        'uses' => 'MembresiaController@agendar_membresia_ajax',
        'as' => 'agendar_membresia_ajax_path',
    ]);
    Route::get('agenda', [
        'uses' => 'MembresiaController@agenda_membresia',
        'as' => 'agenda_membresias_path',
    ]);
    Route::get('agenda/membresia', [
        'uses' => 'MembresiaController@agenda_membresia_get',
        'as' => 'agenda_membresia_path',
    ]);
    Route::get('rpt-nueva-membresia/{id}/{id2}/{id3}', [
        'uses' => 'MembresiaController@rpt_nueva_membresia',
        'as' => 'rpt_nueva_membresia_path',
    ]);
    Route::get('rpt-renovar-membresia/{id}/{id2}/{id3}', [
        'uses' => 'MembresiaController@rpt_renovar_membresia',
        'as' => 'rpt_renovar_membresia_path',
    ]);
    Route::post('nueva-membresia/buscar_membresia_existentes',[
        'uses' => 'MembresiaController@buscar_membresia',
        'as' => 'buscar_membresia_path',
    ]);
});
/*-- Fin Metodos para logeo de usuarios del sistema*/

