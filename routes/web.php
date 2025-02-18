<?php

use Illuminate\Support\Facades\Route;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirige al login después del logout
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('pacientes', PacienteController::class);
    Route::get('/get-municipios/{departamento_id}', function ($departamento_id) {
        return Municipio::where('departamento_id', $departamento_id)->get();
    });
});