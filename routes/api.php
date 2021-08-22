<?php

use Illuminate\Http\Request;

Route::get('/oojj/{id}/pedido','OOJJController@byPedido');

Route::get('/producto/{id}/pedido','ProductoController@byPedido');

Route::get('/pedido/{id}/pecosa','PedidoController@byPecosa');

Route::get('/producto/{id}/{id1}/pecosa','PedidoController@byPecosaPedido');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
