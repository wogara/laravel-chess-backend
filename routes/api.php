<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChessController;
use App\Http\Controllers\UserController;
Route::get('/message', function () {
    return response()->json(['message' => 'Hello from Laravel API!']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');

Route::get('/moves', [ChessController::class, 'getMoves']);

Route::get('/games', [RoomController::class, 'getGamesByEmail']);

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::post('/create-room', [RoomController::class, 'create']);

Route::post('/move',[ChessController::class, 'storeMove']);
