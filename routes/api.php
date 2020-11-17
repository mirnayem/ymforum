<?php
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AuthController;

Route::apiResources([
    'question' => QuestionController::class,
    'category' => CategoryController::class,
    '/question/{question}/reply' => ReplyController::class,
    ]);


Route::post('/like/{reply}', [LikeController::class , 'likeIt']);
Route::delete('/like/{reply}', [LikeController::class , 'unlikeIt']);



Route::post('login', [AuthController::class , 'login']);

Route::post('signup', [AuthController::class , 'signup']);

Route::post('logout', [AuthController::class , 'logout']);

Route::post('refresh', [AuthController::class , 'refresh']);

Route::post('me', [AuthController::class , 'me']);

Route::post('payload', [AuthController::class , 'payload']);