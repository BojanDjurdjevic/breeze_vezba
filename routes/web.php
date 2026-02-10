<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckAdmin;
use App\Models\City;
use App\Models\CityWeatherModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cities = City::all();
    return view('welcome', compact('cities'));
});

Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->group(function () {
    Route::get('/cities', [CityController::class, 'index'])->name('admin.cities');
    Route::post('/cities', [CityController::class, 'create'])->name('add-city');
    Route::post('/update-city', [CityController::class, 'update'])->name('admin-update');
    Route::delete('/remove-city/{city}', [CityController::class, 'delete'])->name('admin.remove');

    Route::get('/forecasts', [ForecastController::class, 'index'])->name('all-forecasts');
    Route::post('/create-forecast', [ForecastController::class, 'create'])->name('create-forecast');
});

Route::get('/myforecasts', [ForecastController::class, 'search'])->name('city-forecast');
Route::get('/forecast/{city:name}', [ForecastController::class, 'fiveDays']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
