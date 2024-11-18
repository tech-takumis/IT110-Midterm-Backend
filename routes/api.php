<?php

use App\Http\Controllers\TodoController;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route:: get('/user', function (Request $request) {
        return $request->user();
    });

});

Route::apiResource('todos', TodoController::class);

Route::get('/user/{userId}/todos',[TodoController::class,'getUserTask'])->name('user.tasks');
