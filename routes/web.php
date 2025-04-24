<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('history', [App\Http\Controllers\EmailController::class, 'history'])->name('history');
Route::delete('message/{id}', [App\Http\Controllers\EmailController::class, 'deleteMessage'])->name('message.delete');
Route:get('message/{id}', [App\Http\Controllers\EmailController::class, 'showMessage'])->name('message.show');
