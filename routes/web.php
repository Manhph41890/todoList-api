<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return '<style>body { overflow: hidden; }</style>
        <pre style="position: absolute;top: 50%;transform: translate(0, -50%);text-align: center;width: 100%;">       
          :::     ::::::::: :::::::::::
    :+: :+:   :+:    :+:    :+:
   +:+   +:+  +:+    +:+    +:+
  +#++:++#++: +#++:++#+     +#+
  +#+     +#+ +#+           +#+
  #+#     #+# #+#           #+#
      ###     ### ###       ###########
    </pre>';
});


// Route::get('auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');

// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
