<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IndexingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //$table->unsignedBigInteger('customer_id')->change();
            $table->index('customer_id');
            //$table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::table('tickets', function (Blueprint $table) {
            //$table->unsignedBigInteger('reservation_id')->change();
            $table->index('reservation_id');
            //$table->foreign('reservation_id')->references('id')->on('reservations');
            //$table->unsignedBigInteger('departure_id')->change();
            $table->index('departure_id');
            //$table->foreign('departure_id')->references('id')->on('departures');
            //$table->unsignedBigInteger('settlement_id')->change();
            $table->index('settlement_id');
            //$table->foreign('settlement_id')->references('id')->on('settlements');
            //$table->unsignedBigInteger('reservation_by')->change();
            $table->index('reservation_by');
            //$table->foreign('reservation_by')->references('id')->on('users');
            //$table->unsignedBigInteger('payment_by')->change();
            $table->index('payment_by');
            //$table->foreign('payment_by')->references('id')->on('users');
        });

        Schema::table('schedules', function (Blueprint $table) {
            //$table->unsignedBigInteger('driver_id')->change();
            $table->index('driver_id');
            //$table->foreign('driver_id')->references('id')->on('drivers');
            //$table->unsignedBigInteger('car_id')->change();
            $table->index('car_id');
            //$table->foreign('car_id')->references('id')->on('cars');
        });

        Schema::table('departures', function (Blueprint $table) {
            //$table->unsignedBigInteger('schedule_id')->change();
            $table->index('schedule_id');
            //$table->foreign('schedule_id')->references('id')->on('schedules');
            //$table->unsignedBigInteger('departure_point_id')->change();
            $table->index('departure_point_id');
            //$table->foreign('departure_point_id')->references('id')->on('points');
            //$table->unsignedBigInteger('arrival_point_id')->change();
            $table->index('arrival_point_id');
            //$table->foreign('arrival_point_id')->references('id')->on('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

    }
}
