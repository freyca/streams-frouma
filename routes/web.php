<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectToStreaming;
use App\Http\Middleware\RegisterEnabled;
use App\Livewire\Login;
use App\Livewire\CreateUser;
use App\Livewire\ResetPassword;
use App\Livewire\RetrievePassword;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', Login::class)->name('landing');

// Password reset routes...
Route::get('recuperar-contrasinal', RetrievePassword::class)->name('retrieve-password');
Route::get('resetear-contrasinal/{token}', ResetPassword::class)->name('password.reset');

Route::get('/crear-usuario', CreateUser::class)->name('create-user')->middleware(RegisterEnabled::class);

Route::get('/streaming', function () {
    return view('pages.streaming');
})
    ->name('streaming')
    ->middleware(Authenticate::class)
    ->withoutMiddleware(RedirectToStreaming::class);
