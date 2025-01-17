<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilesController;
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

Route::group([
  'middleware' => ['api', 'auth:api'],
  'prefix' => 'auth'
], function ($router) {
  Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware('auth:api');
  Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware('auth:api');
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::post('/refresh', [AuthController::class, 'refresh']);
  Route::get('/user-profile', [AuthController::class, 'userProfile']);
  Route::post('/file', [FilesController::class,'store'])->withoutMiddleware('auth:api');;
  Route::get('/file', [FilesController::class,'index'])->withoutMiddleware('auth:api');;
  Route::get('/file/{id}', [FilesController::class,'show'])->withoutMiddleware('auth:api');;
  Route::get('/fileseason', [FilesController::class,'showseason'])->withoutMiddleware('auth:api');;
  Route::get('/filelevel', [FilesController::class,'showlevel'])->withoutMiddleware('auth:api');;
  Route::get('/showfile', [FilesController::class,'showfile'])->withoutMiddleware('auth:api');;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
