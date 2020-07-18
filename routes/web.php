<?php

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
Route::get('coba', function (){
    return \App\Helpers\ReportHelper::ocupancy(1,'2020-07-05');
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

    Route::livewire('/reservation/', 'reservation')->name('reservation');
    Route::livewire('/history/transaction', 'history.transaction')->name('history.transaction');
    Route::livewire('/history/reservation', 'history.reservation')->name('history.reservation');
    Route::livewire('/history/settlement', 'history.settlement')->name('history.settlement');

    Route::livewire('/settlement', 'settlement')->name('settlment');

    Route::livewire('/reservation/create', 'reservation.create')->name('reservation.create');
    Route::livewire('/reservation/search', 'reservation.search')->name('reservation.search');
    Route::livewire('/reservation/report', 'reservation.report')->name('reservation.report');

    /*prints*/
    Route::get('print/ticket/{reservation}','PrintController@ticket')->name('print.ticket');

    Route::get('print/manifest/{schedule}', 'PrintController@manifest')->name('print.manifest');

    Route::get('print/settlement/{settlement}', 'PrintController@settlement')->name('print.settlement');


    /*reports*/
    Route::livewire('/report/income_statement', 'report.income-statement')->name('report.income-statement');
    Route::livewire('/report/settlements', 'report.settlements')->name('report.settlements');
    Route::livewire('/report/ocupancy', 'report.ocupancy')->name('report.ocupancy');

});
