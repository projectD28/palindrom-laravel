<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PalindromController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [LanguageController::class, 'Index']);
Route::get('/language', [LanguageController::class, 'Language']);
Route::get('/languages', [LanguageController::class, 'IndexLanguage']);
Route::get('/get_languages/{id}', [LanguageController::class, 'GetLanguage']);
Route::post('/create', [LanguageController::class, 'Created']);
Route::put('/update/{id}', [LanguageController::class, 'Updated']);
Route::delete('/delete/{id}', [LanguageController::class, 'Deleted']);

Route::get('/palindrome', [PalindromController::class, 'Palindrome']);

Route::fallback(function () {
    return response()->json(["error" => "Method not allowed"], 404);
});
