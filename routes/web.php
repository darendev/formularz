<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularzController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\Plik;
use App\Http\Controllers\DataEditorController;
use App\Http\Controllers\EdycjaController;


Route::get('/', function () {
    return view('welcome');
});


/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

// Dashboard wyswietla tabele z danymi pliku CSV
Route::get('/dashboard', [CsvController::class, 'showCSV'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Wyswietla plik załadowany przez użytkownika
Route::get('plik/{id}', [Plik::class, 'getFile'])->middleware('auth');; 

// Usuwa wybrany wpis razem z plikiem załadowanym przez uzytkownika
Route::get('usun/{id}', [DataEditorController::class, 'removeForm'])->middleware('auth');; 

// znmienia dane wpisu
Route::post('/aktualzacja-wpisu', [DataEditorController::class, 'upade'])->name('aktualzacja-wpisu');





// Wyswietla dane do edycji wybranego wierza pliku CSV
Route::get('edycja/{id}', [EdycjaController::class, 'getRow'])->middleware('auth');; 




//  Zapisuje dane z formularza przesłanego przez użytkowników
Route::post('/zapisz-dane', [FormularzController::class, 'zapiszDane'])->name('zapisz-dane');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
