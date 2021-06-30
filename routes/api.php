<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

//USER LOGIN and LOGOUT


Route::post('/login', [ApiController::class, 'userLogin']);
Route::post('/logout', [ApiController::class, 'logout'])->middleware('auth:sanctum');

//USER CRUD
Route::post('/register', [ApiController::class, 'userRegister']);
Route::get('/getUsers/{user?}', [ApiController::class, 'getUsers'])->middleware('auth:sanctum');
Route::put('/editUser/{id?}', [ApiController::class, 'editUser'])->middleware('auth:sanctum');
Route::put('/editPassword/{id?}', [ApiController::class, 'editPassword'])->middleware('auth:sanctum');
Route::delete('/deleteuser/{id?}', [ApiController::class, 'deleteUser'])->middleware('auth:sanctum');
Route::get('/getAllUsers/{user?}', [ApiController::class, 'getAllUsersRecords'])->middleware('auth:sanctum');

//ROLES CRUD
Route::post('/createRoles', [ApiController::class, 'createRoles'])->middleware('auth:sanctum');
Route::get('/getRoles/{role?}', [ApiController::class, 'getRole'])->middleware('auth:sanctum');
Route::put('/editRole/{id?}', [ApiController::class, 'editRole'])->middleware('auth:sanctum');
Route::delete('/deleteRole/{id?}', [ApiController::class, 'deleteRole'])->middleware('auth:sanctum');
Route::get('/getAllRoles/{role?}', [ApiController::class, 'getAllRoles'])->middleware('aith:sanctum');