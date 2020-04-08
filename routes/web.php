<?php

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->post('/upload', 'ApiController@upload');

});


