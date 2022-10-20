<?php

namespace App\Repositories;

use App\Models\CryptocurrencyPrice;

class CryptocurrencyPriceRepository
{
    public function save(array $data): CryptocurrencyPrice
    {
        return CryptocurrencyPrice::create($data);
    }

    public function getLasPrice(int $cryptocurrencyId): ?CryptocurrencyPrice
    {
        return CryptocurrencyPrice::where('cryptocurrency_id', $cryptocurrencyId)->orderBy('id', 'DESC')->first();
    }
}
