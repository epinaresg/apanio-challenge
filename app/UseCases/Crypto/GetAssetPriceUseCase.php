<?php

namespace App\UseCases\Crypto;

use App\Libraries\GuzzleLibrary;
use App\Repositories\CryptocurrencyPriceRepository;
use App\Repositories\CryptocurrencyRepository;

class GetAssetPriceUseCase
{
    private $guzzleLibrary;
    private $cryptocurrencyRepository;
    private $cryptocurrencyPriceRepository;
    public function __construct()
    {
        $this->guzzleLibrary = new GuzzleLibrary();
        $this->cryptocurrencyRepository = new CryptocurrencyRepository();
        $this->cryptocurrencyPriceRepository = new CryptocurrencyPriceRepository();
    }

    public function __invoke(string $cryptoName): void
    {
        $this->guzzleLibrary->setBaseUri('https://api.coincap.io');

        $data = $this->guzzleLibrary->call(
            'GET',
            '/v2/assets/' . strtolower($cryptoName),
        );

        if ($data->status_code !== 200) {
            throw new \Exception("Error Processing Request", 500);
        }

        $cryptoData = $data->response_formatted->data;

        $priceData = [
            'price' => $cryptoData->priceUsd,
            'change_percent_24_hours' => $cryptoData->changePercent24Hr,
            'supply' => $cryptoData->supply,
            'max_supply' => $cryptoData->maxSupply,
            'market_cap_usd' => $cryptoData->marketCapUsd,
            'volume_usd_24_hours' => $cryptoData->volumeUsd24Hr,
        ];

        $priceChanged = 1;
        $cryptocurrency = $this->cryptocurrencyRepository->bySymbol($cryptoData->symbol);
        if (!$cryptocurrency) {
            $saveData = $priceData;
            $saveData['name'] = $cryptoData->name;
            $saveData['symbol'] = $cryptoData->symbol;
            $saveData['currency'] = 'USD';
            $saveData['price_changed'] = 1;

            $cryptocurrency = $this->cryptocurrencyRepository->save($saveData);
        } else {
            $updateData = $priceData;
            $updateData['price_changed'] = $updateData['price'] !== $cryptocurrency->getRawOriginal('price') ? 1 : 0;

            $priceChanged = $updateData['price_changed'];

            $this->cryptocurrencyRepository->update($cryptocurrency, $updateData);
        }



        if ($priceChanged === 1) {
            $lastPrice = $this->cryptocurrencyPriceRepository->getLasPrice($cryptocurrency->id);

            if ($lastPrice) {
                $variation = (($priceData['price'] - $lastPrice->getRawOriginal('price'))/$cryptocurrency->getRawOriginal('price')) * 100;

                $this->cryptocurrencyRepository->update($cryptocurrency, ['change_percent_prev_price' => $variation]);

                $priceData['change_percent_prev_price'] = $variation;
            }

            $priceData['cryptocurrency_id'] = $cryptocurrency->id;
            $this->cryptocurrencyPriceRepository->save($priceData);
        }
    }
}
