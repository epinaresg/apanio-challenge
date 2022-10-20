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
        Schema::create('cryptocurrencies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('symbol');

            $table->string('currency');
            $table->string('price');

            $table->string('supply');
            $table->string('market_cap_usd');
            $table->string('volume_usd_24_hours');

            $table->string('change_percent_24_hours');
            $table->string('change_percent_prev_price')->nullable();

            $table->integer('price_changed')->default(0);

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
        Schema::dropIfExists('cryptocurrencies');
    }
};
