<?php

namespace App\Models;

use App\Casts\BillionCast;
use App\Casts\MillionCast;
use App\Casts\PercentCast;
use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptocurrencyPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'cryptocurrency_id',
        'price',
        'supply',
        'max_supply',
        'market_cap_usd',
        'volume_usd_24_hours',
        'change_percent_24_hours',
        'change_percent_prev_price'
    ];

    protected $casts = [
        'price_changed' => 'boolean',
        'price' => PriceCast::class,
        'market_cap_usd' => BillionCast::class,
        'volume_usd_24_hours' => BillionCast::class,
        'supply' => MillionCast::class,
        'max_supply' => MillionCast::class,
        'change_percent_24_hours' => PercentCast::class,
        'change_percent_prev_price' => PercentCast::class,
        'created_at' => 'datetime'
    ];
}
