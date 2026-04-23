<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Exports\EmailSchedulesExport;
use Maatwebsite\Excel\Facades\Excel;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('index.schedule');
});

Route::get('/schedule', [ScheduleController::class, 'index'])->name('index.schedule');
Route::post('/import-schedule', [ScheduleController::class, 'importClients'])->name('import-schedule');
Route::post('/email-schedule', [ScheduleController::class, 'setEmailSchedule']);

Route::get('/send-mail', [MailController::class, 'sendMail']);

Route::get('/history', [HistoryController::class, 'index'])->name('index.history');

Route::get('/email-template', [MailController::class, 'editEmail']);
Route::post('/email-template', [MailController::class, 'updateEmail']);
Route::post('/email-test', [MailController::class, 'testEmail']);
Route::get('/export-email-schedules', function () {
    return Excel::download(new EmailSchedulesExport, 'email_schedules.xlsx');
});