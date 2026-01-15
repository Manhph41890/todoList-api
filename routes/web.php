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
    return '<style>
        body { background-color: #0d1117; color: #58a6ff; overflow: hidden; margin: 0; font-family: monospace; }
    </style>
    <pre style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-weight: bold; line-height: 1.2; white-space: pre;">
::::     ::::      :::     ::::    ::: :::     :::      :::::::::  ::::::::::: :::       :::           :::     ::::::::: :::::::::::
+:+:+: :+:+:+    :+: :+:   :+:+:   :+: :+:     :+:      :+:    :+: :+:         :+:       :+:         :+: :+:   :+:    :+:    :+:    
+:+ +:+:+ +:+   +:+   +:+  :+:+:+  +:+ +:+     +:+      +:+    +:+ +:+          +:+     +:+         +:+   +:+  +:+    +:+    +:+    
+#+  +:+  +#+  +#++:++#++: +#+ +:+ +#+ +#++:++#++:      +#+    +:+ +#++:++#      +#+   +#+         +#++:++#++: +#++:++#+     +#+    
+#+       +#+  +#+     +#+ +#+  +:+:+# +#+     +#+      +#+    +:+ +#+            +#+ +#+          +#+     +#+ +#+           +#+    
#+#       #+#  #+#     #+# #+#   #+#+# #+#     #+#      #+#    +:+ #+#             #+#+#           #+#     +#+ #+#           +#+    
###       ###  ###     ### ###    #### ###     ###      #########  ###########      ###            ###     ### ###       ###########
    </pre>';
});


// Route::get('auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');

// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
