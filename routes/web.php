<?php

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

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('exportExcel', 'ReporteInvController@exportExcel');
Route::get('exportPdf', 'ReporteInvController@exportPdf');

Route::get('exportExcelTran', 'ReporteTranController@exportExcel');

Route::get('exportExcelTransf', 'tranController@exportExcel');
Route::get('exportPdfTransf', 'tranController@exportPdf');

Route::get('exportExcelMov', 'movimientosController@exportExcel');
Route::get('exportPdfMov', 'movimientosController@exportPdf');
Route::get('limpiarMov', 'movimientosController@Limpiar');

Route::get('exportExcelLog', 'ReporteLogController@exportExcel');
Route::get('exportPdfLog', 'ReporteLogController@exportPdf');

Route::get('deleteList/{item}', 'tranController@deleteList');
Route::get('limpiar', 'tranController@Limpiar');

Route::resource('salesPos', 'sales_posController');

Route::resource('chartMasters', 'chart_masterController');

Route::resource('glTrans', 'gl_transController');

Route::resource('grnItems', 'grn_itemsController');

Route::resource('itemCodes', 'item_codesController');

Route::resource('locations', 'locationsController');

Route::resource('locStocks', 'loc_stockController');

Route::resource('stockMasters', 'stock_masterController');

Route::resource('stockMoves', 'stock_movesController');



Route::resource('itemBodegas', 'item_bodegaController');

Route::resource('logs', 'logController');

Route::resource('tipoTransaccions', 'tipo_transaccionController');

Route::resource('usuarioBodegas', 'usuario_bodegaController');

Route::resource('usuarioNormals', 'usuario_normalController');

Route::resource('users', 'userController');



Route::resource('reportss', 'ReporteInvController');

Route::resource('reports', 'ReporteTranController');

Route::get('/tran/{item}/{cantidad}', 'tranController@edit');

Route::resource('tran', 'tranController');



Route::resource('auditTrails', 'audit_trailController');


Route::resource('movimientos', 'movimientosController');

Route::resource('refs', 'refsController');



Route::resource('transacciones', 'TransaccionesController');

Route::resource('RepLog', 'ReporteLogController');

Route::resource('roles', 'rolesController');

Route::resource('userRols', 'user_rolController');