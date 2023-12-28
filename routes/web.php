<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedule-email', [MailController::class, 'scheduleEmail']);
Route::get('/add-email', [MailController::class, 'addSubcribe']);
Route::get('/add-list-mail', [MailController::class, 'addListMail']);
Route::get('/show-list-mail', [MailController::class, 'showListMail']);
Route::get('/api/products', [ProductController::class, 'listProducts']);

