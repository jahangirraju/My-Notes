<?php

use App\Http\Controllers\EmailsController;
use App\Http\Controllers\MyNotesController;
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



Route::get('', [MyNotesController::class, 'index'])->name('notes.index');
Route::post('/notes', [MyNotesController::class, 'store'])->name('notes.store');
Route::get('/edit/{id}', [MyNotesController::class, 'edit'])->name('notes.edit');
Route::post('/edit/{id}', [MyNotesController::class, 'update'])->name('notes.update');
Route::delete('/delete/{id}', [MyNotesController::class, 'delete'])->name('notes.delete');