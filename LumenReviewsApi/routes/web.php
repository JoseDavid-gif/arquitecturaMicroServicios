<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router->get('/reviews', 'ReviewController@index');
$router->post('/reviews', 'ReviewController@store');
$router->get('/reviews/{review}', 'ReviewController@show');
$router->put('/reviews/{review}', 'ReviewController@update');
$router->patch('/reviews/{review}', 'ReviewController@update');
$router->delete('/reviews/{review}', 'ReviewController@destroy');
