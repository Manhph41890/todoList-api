<?php

// use Dingo\Api\Routing\Router;
// use Illuminate\Support\Facades\File;

// /** @var Router $api */
// $api = app(Router::class);
// $api->version('v1', ['middleware' => ['api']], function ($api) {
//     foreach (File::allFiles(__DIR__ . '/api/v1') as $routeFile) {
//         require $routeFile->getPathname();
//     }
// });

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TitletaskController;
use App\Http\Controllers\TodolistController;
use App\Models\titletask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::resource('todolists', TodolistController::class);
Route::get('todolists', [TodolistController::class, 'index'])->name('todolists.index'); // Danh sách todolist
Route::post('todolists', [TodolistController::class, 'store'])->name('todolists.store'); // Lưu todolist mới
Route::get('todolists/{todolist}', [TodolistController::class, 'show'])->name('todolists.show'); // Xem chi tiết
Route::put('todolists/{todolist}', [TodolistController::class, 'update'])->name('todolists.update'); // Cập nhật todolist
Route::delete('todolists/{todolist}', [TodolistController::class, 'destroy'])->name('todolists.destroy'); // Xóa todolist

// Route::resource('titletask', TodolistController::class);
Route::get('titletask', [TitletaskController::class, 'index'])->name('titletask.index'); // Danh sách titletask
Route::post('titletask', [TitletaskController::class, 'store'])->name('titletask.store'); // Lưu titletask mới
Route::get('titletask/{titletask}', [TitletaskController::class, 'show'])->name('titletask.show'); // Xem chi tiết
Route::put('titletask/{titletask}', [TitletaskController::class, 'update'])->name('titletask.update'); // Cập nhật titletask
Route::delete('titletask/{titletask}', [TitletaskController::class, 'destroy'])->name('titletask.destroy'); // Xóa titletask

// Route::get('auth/google/redirect', [GoogleController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
//     return response()->json([
//         'user' => $request->user()
//     ]);
// });

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});
Route::middleware(['web'])->group(function () {
    Route::get('auth/google/redirect', [GoogleController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});
