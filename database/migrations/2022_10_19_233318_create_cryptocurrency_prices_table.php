<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptocurrency_prices', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('cryptocurrency_id');
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrencies');
            $table->index('cryptocurrency_id');

            $table->string('price');
            $table->string('supply');
            $table->string('max_supply');
            $table->string('market_cap_usd');
            $table->string('volume_usd_24_hours');
            $table->string('change_percent_24_hours');
            $table->string('change_percent_prev_price')->nullable();

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
        Schema::dropIfExists('cryptocurrency_prices');
    }
};
