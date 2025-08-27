<?php

use App\Models\Country;
use App\Models\Denomination;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//registration
Route::get('/register', function () {
    $denominations = Denomination::orderBy('name')->get();
    $countries = Country::orderBy('name')->get();

    return view('auth.register', [
        'denominations' => $denominations,
        'countries' => $countries,
    ]);
})->name('register');
