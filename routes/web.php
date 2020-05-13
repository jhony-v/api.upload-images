<?php


$router->group(['prefix' => 'api/v1'], function() use ($router) {
    $router->post('/upload', 'ApiController@upload');
});


