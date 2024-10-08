<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [DashboardController::class, 'index']);
Route::post('/email-schedule', [DashboardController::class, 'setEmailSchedule']);

Route::get('/send-mail', [MailController::class, 'sendMail']);
