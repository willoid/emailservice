<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/send-email', [EmailController::class, 'sendMail'])->name('send.email');
Route::get('history', [App\Http\Controllers\EmailController::class, 'history'])->name('message.history');
Route::delete('message/{id}', [App\Http\Controllers\EmailController::class, 'deleteMessage'])->name('message.delete');
Route::get('message/{id}', [App\Http\Controllers\EmailController::class, 'showMessage'])->name('message.show');
