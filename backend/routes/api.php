<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CampaignController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('registrationUser', [UserController::class, 'registrationUser']);
Route::post('/authenticate', [LoginController::class, 'authenticate']);

Route::post('/subscribers', [SubscriberController::class, 'store']);
Route::get('/subscribers', [SubscriberController::class, 'index']);

Route::post('/newsletters', [NewsletterController::class, 'store']);
Route::get('/newsletters', [NewsletterController::class, 'index']);
Route::put('/newsletters/{id}', [NewsletterController::class, 'update']);
Route::delete('/newsletters/{id}', [NewsletterController::class, 'destroy']);

Route::post('/campaigns', [CampaignController::class, 'store']);
Route::post('/campaigns/send/{id}', [CampaignController::class, 'send']);
Route::get('/campaigns/{id}/stats', [CampaignController::class, 'stats']);
