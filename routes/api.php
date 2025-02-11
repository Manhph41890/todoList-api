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
use App\Http\Controllers\TodolistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::resource('todolists', TodolistController::class);
Route::get('todolists', [TodolistController::class, 'index'])->name('todolists.index'); // Danh sách todolist
Route::get('todolists/create', [TodolistController::class, 'create'])->name('todolists.create'); // Form tạo mới
Route::post('todolists', [TodolistController::class, 'store'])->name('todolists.store'); // Lưu todolist mới
Route::get('todolists/{todolist}', [TodolistController::class, 'show'])->name('todolists.show'); // Xem chi tiết
Route::get('todolists/{todolist}/edit', [TodolistController::class, 'edit'])->name('todolists.edit'); // Form chỉnh sửa
Route::put('todolists/{todolist}', [TodolistController::class, 'update'])->name('todolists.update'); // Cập nhật todolist
Route::delete('todolists/{todolist}', [TodolistController::class, 'destroy'])->name('todolists.destroy'); // Xóa todolist
