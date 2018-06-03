<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Protected Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Authenticated user's posts
Route::get('/posts', 'PostController@index');
