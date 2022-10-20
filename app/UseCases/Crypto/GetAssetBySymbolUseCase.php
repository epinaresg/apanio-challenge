<?php

namespace App\UseCases\Crypto;

use App\Models\Cryptocurrency;
use App\Repositories\CryptocurrencyRepository;

class GetAssetBySymbolUseCase
{
    private $cryptocurrencyRepository;
    public function __construct()
    {
        $this->cryptocurrencyRepository = new CryptocurrencyRepository();
    }

    public function __invoke(string $symbol): ?Cryptocurrency
    {
        return $this->cryptocurrencyRepository->bySymbol($symbol);
    }
}
