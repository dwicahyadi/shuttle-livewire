<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reservation_id');
            $table->unsignedInteger('departure_id');
            $table->string('phone');
            $table->string('name');
            $table->integer('seat');
            $table->unsignedInteger('discount_id')->nullable();
            $table->string('discount_name')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->integer('price')->nullable();
            $table->string('status');
            $table->boolean('isCancel')->nullable();
            $table->unsignedInteger('reservation_by')->nullable();
            $table->dateTime('reservation_at')->nullable();
            $table->unsignedInteger('payment_by')->nullable();
            $table->dateTime('payment_at')->nullable();
            $table->unsignedInteger('settlment_id')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
