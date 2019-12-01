<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function() use($router){
    $router->get('/talks', 'TalkController@index');
    $router->get('/talk/{id}', 'TalkController@show');
    $router->post('/talk', 'TalkController@create');
    $router->put('/talk/{id}', 'TalkController@update');
    $router->delete('/talk/{id}', 'TalkController@destroy');
});

$router->group(['prefix' => 'api'], function() use($router){
    $router->get('/speakers', 'SpeakerController@index');
    $router->get('/speaker/{id}', 'SpeakerController@show');
    $router->post('/speaker', 'SpeakerController@create');
    $router->put('/speaker/{id}', 'SpeakerController@update');
    $router->delete('/speaker/{id}', 'SpeakerController@destroy');
});
