<?php

namespace App\Repositories;

use App\Models\Cryptocurrency;

class CryptocurrencyRepository
{
    public function byId(string $id): ?Cryptocurrency
    {
        return Cryptocurrency::find($id);
    }

    public function bySymbol(string $symbol): ?Cryptocurrency
    {
        return Cryptocurrency::where('symbol', $symbol)->first();
    }

    public function save(array $data): Cryptocurrency
    {
        return Cryptocurrency::create($data);
    }

    public function update(Cryptocurrency $cryptocurrency, array $data): bool
    {
        return $cryptocurrency->update($data);
    }

    public function getLastPrices(Cryptocurrency $cryptocurrency, int $qtyRecords = 10)
    {
        return $cryptocurrency->prices()->orderBy('id', 'DESC')->limit($qtyRecords)->get();
    }
}
