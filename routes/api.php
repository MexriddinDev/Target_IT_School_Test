<?php

use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Admin\CourseController;
use App\Http\Controllers\API\Admin\LevelController;
use App\Http\Controllers\API\Admin\OptionController;
use App\Http\Controllers\API\Admin\QuestionController;
use App\Http\Controllers\API\Admin\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/admins', AdminController::class);
Route::apiResource('/courses', CourseController::class);
Route::apiResource('/levels', LevelController::class);
Route::apiResource('/tests',  TestController::class);
Route::apiResource('/questions', QuestionController::class);
Route::apiResource('/options', OptionController::class);
