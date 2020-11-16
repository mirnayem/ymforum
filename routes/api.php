<?php
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReplyController;

Route::apiResources([
    'question' => QuestionController::class,
    'category' => CategoryController::class,
    '/question/{question}/reply' => ReplyController::class,
    ]);
