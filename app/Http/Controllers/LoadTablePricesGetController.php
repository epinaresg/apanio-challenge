<?php

namespace App\Http\Controllers;

use App\UseCases\Crypto\GetAssetBySymbolUseCase;
use App\UseCases\Crypto\GetLasPricesUseCase;
use Illuminate\Contracts\View\View;

class LoadTablePricesGetController
{
    public function __invoke(): View
    {
        $cryptocurrency = (new GetAssetBySymbolUseCase())->__invoke('BTC');

        $lastPrices = (new GetLasPricesUseCase())->__invoke($cryptocurrency);

        return view('load-table', [
            'lastPrices' => $lastPrices
        ]);
    }
}
