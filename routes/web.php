<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    return redirect(\route('reservation'));
});

Route::get('/myReservation/{reservationId}', function ($reservationId) {
    $reservation = \App\Models\Reservation::find($reservationId);
    return view('reservation_detail',['reservation'=>$reservation]);
})->name('cust.view');

Route::get('/s/{reservationId}', function ($reservationId) {
    $reservation = \App\Models\Reservation::find($reservationId);
    return view('reservation_detail',['reservation'=>$reservation]);
})->name('cust.view');

Auth::routes();

Route::get('pivot', function (){
   return view('pivot', ['data'=>\App\Helpers\ReportHelper::omzet(1,7,2020)]);
});
Route::get('coba/{id}', function ($id){
    $schedule = \App\Models\Schedule::with('departures')->find($id);
    return $schedule;
});

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::livewire('/dashboard', 'dashboard')->name('dashboard');

    Route::livewire('/profile', 'profile')->name('profile');
    Route::livewire('/setting', 'setting')->name('setting');
    Route::livewire('/setting/user', 'setting.user')->name('setting.user');
    Route::livewire('/setting/role', 'setting.role')->name('setting.role');

    Route::livewire('/city', 'city')->name('city');
    Route::livewire('/point', 'point')->name('point');
    Route::livewire('/car', 'car')->name('car');
    Route::livewire('/driver', 'driver')->name('driver');
    Route::livewire('/discount', 'discount')->name('discount');

    Route::livewire('/schedule/create', 'schedule.create')->name('schedule.create');
    Route::livewire('/schedule/manage', 'schedule.manage')->name('schedule.manage');

    Route::livewire('/schedule/create2', 'schedule.create2')->name('schedule.create2');
    Route::livewire('/schedule/upload', 'schedule.upload')->name('schedule.upload');

    Route::livewire('/reservation/', 'reservation')->name('reservation');
    Route::livewire('/history/transaction', 'history.transaction')->name('history.transaction');
    Route::livewire('/history/reservation', 'history.reservation')->name('history.reservation');
    Route::livewire('/history/settlement', 'history.settlement')->name('history.settlement');

    Route::livewire('/settlement', 'settlement')->name('settlment');

    Route::livewire('/reservation/transfer_monitor', 'transfer-payment-monitor')->name('reservation.transfer_monitor');

    /*prints*/
    Route::get('print/ticket/{reservationId}','PrintController@ticket')->name('print.ticket');

    Route::get('print/manifest/{schedule}', 'PrintController@manifest')->name('print.manifest');

    Route::get('print/settlement/{settlement}', 'PrintController@settlement')->name('print.settlement');


    /*reports*/
    Route::livewire('/report/income_statement', 'report.income-statement')->name('report.income-statement');
    Route::livewire('/report/settlements', 'report.settlements')->name('report.settlements');
    Route::livewire('/report/ocupancy', 'report.ocupancy')->name('report.ocupancy');

});
