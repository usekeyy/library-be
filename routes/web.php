<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MenuController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::post('api/login', [ApiController::class, 'login']);

Route::middleware('auth:api')->group(function () {
});
// Route::group(['as' => 'api.', 'prefix' => 'api', 'middleware' => 'auth'], function () {
//     Route::get('/book', ['as' => 'index', 'uses' => 'BookControllerr@index']);
//     Route::get('/book/{id}', ['as' => 'show', 'uses' => 'BookControllerr@show']);
// });
Route::get('api/book', [BookController::class, 'index']);
Route::get('api/book/{id}', [BookController::class, 'show']);
Route::post('api/book', [BookController::class, 'store']);
Route::put('api/book/{id}', [BookController::class, 'update']);
Route::delete('api/book/{id}', [BookController::class, 'destroy']);
Route::get('api/generate/book', [BookController::class, 'generateDokumen']);
Route::get('api/logout', [ApiController::class, 'logout']);

Route::get('api/genre', [GenreController::class, 'index']);


// $router->group(["prefix" => "api"], function () use ($router) {
//     $router->post('/login', ['uses' => 'ApiController@login', 'as' => 'User Login']);
// });
