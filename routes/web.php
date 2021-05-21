<?php

use App\Http\Controllers\IdeasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IdeasController::class, 'index'])->name('/');

Route::get('ideas/{idea:slug}', [IdeasController::class, 'show'])->name('ideas.show');

require __DIR__.'/auth.php';
