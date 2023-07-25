<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('user/store',['as' => 'user/store', 'uses' => 'userController@store']);
Route::put('users',['as' => 'users/update', 'uses' => 'userController@update']);

Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
//Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
