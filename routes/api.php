<?php

use App\Http\Controllers\Api\Users\AdminsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json(["user" => $request->user()->load('key.keyable')], 200);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('admins', AdminsController::class);
    Route::post('admins/{admin}/generate-key', [AdminsController::class, 'createKey']);

});



require __DIR__.'/auth.php';
