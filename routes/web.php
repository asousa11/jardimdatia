<?php

use Illuminate\Support\Facades\Route;

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

Route ::get('/admin', function () {
    return view('home');
});

Route::resource('/clientes','ClienteController');
Route::get('/searchCliente', 'ClienteController@searchClient');
Route::resource('/vendas','VendaController');
Route::get('/searchVenda', 'VendaController@searchVenda');
Route::resource('/produtos','ProdutoController');
Route::get('/searchProduto/{venda}', 'ProdutoController@searchProduto');
Route::get('/searchProduto/{venda}/{ramo}', 'ProdutoController@searchProdutoRamoPersonalizado')->name('searchProdutoRamoPersonalizado');


Route::get('/vendas/{venda}/addProduto','VendaController@showProdutos')->name('mostrar');
Route::post('/vendas/{venda}/{produto}', 'VendaController@adicionarVendaProduto')->name('vendaadicionarproduto');

Route::get('/vendas/{venda}/resumosemcartao','VendaController@resumoVendaSemCartao');
Route::get('/vendas/{venda}/resumocomcartao','VendaController@resumoVendaComCartao');

Route::get('/vendas/{venda}/finalizarsemcartao', 'VendaController@finalizarVendaSemCartao')->name('finalizarVendaSemCartao');
Route::get('/vendas/{venda}/finalizarcomcartao', 'VendaController@finalizarVendaComCartao')->name('finalizarVendaComPontos');
Route::delete('/vendas/{venda}/{vendaproduto}/eliminarvendaproduto', 'VendaController@eliminarVendaProduto')->name('eliminarVendaProduto');
Route::post('/vendas/{venda}/{produto}', 'VendaController@adicionarVendaProduto')->name('vendaadicionarproduto');

//Ramo Personalizado
Route::get('/vendas/{venda}/ramopersonalizado','VendaController@createRamoPersonalizado')->name('createRamoPersonalizado');
Route::get('/vendas/{venda}/ramopersonalizado/{ramo}','VendaController@showRamoPersonalizado')->name('showRamoPersonalizado');
Route::post('/ramopersonalizado/{ramo}/{produto}', 'VendaController@adicionarArtigoRamo')->name('adicionarArtigoRamo');
Route::delete('/ramopersonalizado/{venda}/{ramo}/eliminar', 'VendaController@eliminarRamoPersonalizado')->name('eliminarRamoPersonalizado');
Route::delete('/ramopersonalizado/{venda}/{ramo}/{artigoramo}/eliminarArtigoRamo', 'VendaController@eliminarArtigoRamo')->name('eliminarArtigoRamo');
Route::get('/vendas/{venda}/resumoramopersonalizado/{ramo}','VendaController@resumoRamoPersonalizado')->name('resumoRamoPersonalizado');
Route::get('/vendas/{venda}/{ramo}finalizarramopersonalizado', 'VendaController@finalizarRamoPersonalizado')->name('finalizarRamoPersonalizado');



Route::get('/home','HomeController@index');

Route::get('/newsletter', 'NewsletterController@setup');




Route::get('/premios', 'PremioController@editar');
Route::put('/premios', 'PremioController@update');

Route::get('/jogo', 'JogoController@autenticar')->name('jogo');
Route::post('/jogo/verification', 'JogoController@verificarAut');
Route::get('/jogo/{contribuinte}/{resultado}', 'JogoController@updatePontos');
Route::get('/jogo/quiz', 'JogoController@jogar');

