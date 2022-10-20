<?php

namespace App\UseCases\Crypto;

use App\Models\Cryptocurrency;
use App\Repositories\CryptocurrencyRepository;
use Illuminate\Database\Eloquent\Collection;

class GetLasPricesUseCase
{
    private $cryptocurrencyRepository;
    public function __construct()
    {
        $this->cryptocurrencyRepository = new CryptocurrencyRepository();
    }

    public function __invoke(Cryptocurrency $cryptocurrency): Collection
    {
        return $this->cryptocurrencyRepository->getLastPrices($cryptocurrency, 10);
    }
}
