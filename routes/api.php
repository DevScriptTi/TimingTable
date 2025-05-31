<?php

use App\Http\Controllers\Api\Main\GroupsController;
use App\Http\Controllers\Api\Main\SectionsController;
use App\Http\Controllers\Api\Users\AdminsController;
use App\Http\Controllers\Api\Users\StudentsController;
use App\Http\Controllers\Api\Users\TeachersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json(["user" => $request->user()->load('key.keyable')], 200);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('admins', AdminsController::class);
    Route::post('admins/{admin}/generate-key', [AdminsController::class, 'createKey']);

    Route::apiResource('teachers', TeachersController::class);
    Route::post('teachers/{teacher}/generate-key', [TeachersController::class, 'createKey']);
    Route::get('teachers/{teacher}/time-table', [TeachersController::class, 'timeTable']);

    Route::apiResource('students', StudentsController::class);
    Route::post('students/{student}/generate-key', [StudentsController::class, 'createKey']);
    Route::get('students/{student}/time-table', [StudentsController::class, 'timeTable']);

    Route::apiResource('groups', GroupsController::class);
    Route::get('groups/{group}/time-table', [GroupsController::class, 'timeTable']);
    Route::get('groups/{group}/valid-classes', [GroupsController::class, 'validClasses']);
    Route::post('groups/{group}/reserve-class-rome', [GroupsController::class, 'reserveClassRome']);
    Route::get('group-days/{group}' , [GroupsController::class, 'days']);
    Route::get('group/student' , [GroupsController::class, 'students']);
    Route::get('group/teacher' , [GroupsController::class, 'teacher']);


    Route::apiResource('sections', SectionsController::class);
    Route::get('sections/{section}/time-table', [SectionsController::class, 'timeTable']);
    Route::post('sections/{section}/valid-classes', [SectionsController::class, 'validClasses']);
    Route::post('sections/{section}/reserve-class-rome', [SectionsController::class, 'reserveClassRome']);
    Route::delete('lessens/{lessen}', [SectionsController::class, 'deleteLessen']);

    Route::get('days/{section}' , [SectionsController::class, 'days']);
    Route::get('teachersAll' , [SectionsController::class, 'teachers']);
    Route::get('modulesAll' , [SectionsController::class, 'modules']);
});



require __DIR__ . '/auth.php';
