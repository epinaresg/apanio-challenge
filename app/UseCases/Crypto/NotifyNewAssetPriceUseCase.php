<?php

namespace App\UseCases\Crypto;

use App\Events\NotifyNewAssetPriceEvent;
use App\Models\Cryptocurrency;
use App\Repositories\CryptocurrencyRepository;

class NotifyNewAssetPriceUseCase
{
    private $cryptocurrencyRepository;
    public function __construct()
    {
        $this->cryptocurrencyRepository = new CryptocurrencyRepository();
    }

    public function __invoke(Cryptocurrency $cryptocurrency): void
    {
        if ($cryptocurrency->price_changed) {
            $this->cryptocurrencyRepository->update($cryptocurrency, ['price_changed' => 0]);

            NotifyNewAssetPriceEvent::dispatch([
                'symbol' => $cryptocurrency->symbol,
                'price' => $cryptocurrency->price,
                'supply' => $cryptocurrency->supply,
                'market_cap_usd' => $cryptocurrency->market_cap_usd,
                'change_percent_24_hours' => $cryptocurrency->change_percent_24_hours,
                'change_percent_prev_price' => $cryptocurrency->change_percent_prev_price,
                'volume_usd_24_hours' => $cryptocurrency->volume_usd_24_hours,
            ]);
        }
    }
}
