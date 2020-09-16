<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_reports', function (Blueprint $table) {
            $table->id();
            $table->string('departure_code')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('reservation_code')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('departure_city')->nullable();
            $table->string('departure_point')->nullable();
            $table->string('arrival_city')->nullable();
            $table->string('arrival_point')->nullable();
            $table->string('discount_name')->nullable();
            $table->string('discount_amount')->nullable();
            $table->integer('price')->nullable();
            $table->integer('seat')->nullable();
            $table->string('status')->nullable();
            $table->string('reservation_by')->nullable();
            $table->string('payment_by')->nullable();
            $table->integer('settlement_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_reports');
    }
}
