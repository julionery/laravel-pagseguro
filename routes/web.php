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


// =================================== Rotas da integração com o pag seguro ====================================================

$this->get('pagseguro', 'PagSeguroController@pagseguro')->name('pagseguro');
$this->get('pagseguro-lightbox', 'PagSeguroController@lightbox')->name('pagseguro.lightbox');
$this->post('pagseguro-lightbox', 'PagSeguroController@lightboxCode')->name('pagseguro.lightbox.code');
$this->get('pagseguro-transparente', 'PagSeguroController@transparente')->name('pagseguro.transparente');
$this->post('pagseguro-transparente', 'PagSeguroController@transparenteCode')->name('pagseguro.transparente.code');
$this->get('pagseguro-transparente-cartao', 'PagSeguroController@card')->name('pagseguro.transparente.card');
$this->post('pagseguro-transparente-cartao', 'PagSeguroController@cardTransaction')->name('pagseguro.transparente.transaction');
$this->post('pagseguro-billet', 'PagSeguroController@billet')->name('pagseguro.transparente.billet');

//==============================================================================================================================


Auth::routes();

$this->group(['middleware' =>'auth'], function (){
    /*
     * Routes profile
     */
    Route::get('meu-perfil', 'UserController@profile')->name('profile');
    Route::post('atualizar-perfil', 'UserController@profileUpdate')->name('profile-update');
    Route::get('minha-senha', 'UserController@password')->name('password');
    Route::post('atualizar-senha', 'UserController@passwordUpdate')->name('password.update');
    Route::get('logout', 'UserController@logout')->name('logout');

    /*
     * Routes payments
     */
    Route::get('meio-pagamento', 'StoreController@methodPayment')->middleware('check-qtd-cart')->name('method.payment');

    Route::post('pagseguro-getcode', 'PagSeguroController@transparenteCode') ->name('pagseguro.transparente.code');
    Route::post('pagseguro-payment-billet', 'PagSeguroController@billet') ->name('pagseguro.transparente.billet');

    Route::get('meus-pedidos', 'UserController@myOrders')->name('my.orders');
    Route::get('pedidos/{reference}', 'UserController@detailsOrder')->name('order.details');

});

Route::get('add-cart/{id}', 'CartController@add')->name('add.cart');
Route::get('remove-cart/{id}', 'CartController@remove')->name('remove.cart');

Route::get('/', 'StoreController@index')->name('home');
Route::get('carrinho', 'StoreController@cart')->name('cart');

