<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router->post('/shipping/calculate', 'ShippingController@calculate');

$router->get('/shipping', 'ShippingController@index');
$router->post('/shipping', 'ShippingController@store');
$router->get('/shipping/{shipping}', 'ShippingController@show');
$router->put('/shipping/{shipping}', 'ShippingController@update');
$router->patch('/shipping/{shipping}', 'ShippingController@update');
$router->post('/shipping/calculate', 'ShippingController@calculate');
$router->get('/shipping/order/{order_id}', 'ShippingController@byOrder');
