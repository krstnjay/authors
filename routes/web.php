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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/authors',['uses' => 'AuthorsController@getAuthors']);
});

$router->get('/authors', 'AuthorsController@index'); // get all authors records
$router->post('/authors', 'AuthorsController@add'); // create new author record
$router->get('/authors/{id}', 'AuthorsController@show'); // get author by id
$router->put('/authors/{id}', 'AuthorsController@update'); // update author record
$router->patch('/authors/{id}', 'AuthorsController@update'); // update author record
$router->delete('/authors/{id}', 'AuthorsController@delete'); // delete record

// $router->get('/usersjob', 'UserJobController@index');
// $router->get('/usersjob/{id}', 'UserJobController@show');

?>