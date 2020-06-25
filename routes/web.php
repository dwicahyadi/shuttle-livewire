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
Auth::routes();

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

    Route::livewire('/settlement', 'settlement')->name('settlment');

    Route::livewire('/reservation/create', 'reservation.create')->name('reservation.create');
    Route::livewire('/reservation/search', 'reservation.search')->name('reservation.search');
    Route::livewire('/reservation/report', 'reservation.report')->name('reservation.report');

    /*prints*/
    Route::get('print/ticket/{reservation}','PrintController@ticket')->name('print.ticket');

    Route::get('print/manifest/{schedule}',function (\App\Models\Schedule $schedule){
        return view('prints.manifest', ['schedule'=>$schedule]);
    })->name('print.manifest');

    Route::get('job', function(){

        $payload['phone'] = '087779537772';
        $payload['message'] = '087779537772';

        dispatch(new \App\Jobs\SendSms($payload));

        dd('done');
    });

});
