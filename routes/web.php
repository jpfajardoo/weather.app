<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserLocationController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\WeatherCurrentController;
use App\Http\Controllers\WeatherForecastController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/weather/current');
    }else{
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
});

Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/weather/current', [WeatherCurrentController::class, 'index'])->name('dashboard');
    Route::get('/weather/forecast', [WeatherForecastController::class, 'index'])->name('weatherForecastDay.index');
    Route::get('/user/location', [UserLocationController::class, 'index']);
});

require __DIR__.'/auth.php';
