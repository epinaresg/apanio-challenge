<?php

namespace Database\Seeders;

use App\Models\Cryptocurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CryptocurrecySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cryptocurrency::create([
            'name' => 'Bitcoin',
            'symbol' => 'BTC',
            'currency' => 'USD',
            'price' => '0.00',
            'supply' => '0.00',
            'market_cap_usd' => '0.00',
            'volume_usd_24_hours' => '0.00',
            'change_percent_24_hours' => '0.00',
            'change_percent_prev_price' => '0.00',
            'price_changed' => 0
        ]);
    }
}
