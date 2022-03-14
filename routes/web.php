<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('cannedQuestions', 'QuestionController@getCannedQuestions');
$router->post('storeEvent', 'EventController@store');
$router->post('getAdminLoginEvents', 'AdminController@getAdminLoginEvents');
$router->post('question', 'QuestionController@storeQueAns');
$router->delete('question', 'QuestionController@deleteQue');
$router->put('question', 'QuestionController@updateQue');
$router->post('feedback', 'AudienceFeedbackController@storeFeedback');