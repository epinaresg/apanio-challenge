<?php

namespace App\Models;

use App\Casts\BillionCast;
use App\Casts\MillionCast;
use App\Casts\PercentCast;
use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cryptocurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'currency',
        'price',
        'supply',
        'market_cap_usd',
        'change_percent_24_hours',
        'change_percent_prev_price',
        'volume_usd_24_hours',
        'price_changed',
    ];

    protected $casts = [
        'price_changed' => 'boolean',
        'price' => PriceCast::class,
        'market_cap_usd' => BillionCast::class,
        'volume_usd_24_hours' => BillionCast::class,
        'supply' => MillionCast::class,
        'change_percent_24_hours' => PercentCast::class,
        'change_percent_prev_price' => PercentCast::class
    ];

    public function prices()
    {
        return $this->hasMany(CryptocurrencyPrice::class);
    }
}
