<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\RegisterPage;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomePage::class)->name('home');
Route::get('/login', fn () => redirect(route('home')))->name('login');
Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::get('/auth/denied', [AuthController::class, 'denied'])->name('auth.denied');

Route::get('/register', RegisterPage::class)->middleware('auth')->name('register');
