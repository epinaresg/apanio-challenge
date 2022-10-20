<?php

namespace App\Console\Commands;

use App\UseCases\Crypto\GetAssetBySymbolUseCase;
use App\UseCases\Crypto\GetAssetPriceUseCase;
use App\UseCases\Crypto\NotifyNewAssetPriceUseCase;
use Illuminate\Console\Command;

class GetBitcoinPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:bitcoin.price {sleep}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get bitcoin price from coincap.io';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        sleep($this->argument('sleep'));

        (new GetAssetPriceUseCase())->__invoke('bitcoin');

        $cryptocurrency = (new GetAssetBySymbolUseCase())->__invoke('BTC');

        if ($cryptocurrency) {
            (new NotifyNewAssetPriceUseCase())->__invoke($cryptocurrency);
            dump($this->description);
        } else {
            dump('Currency not found');
        }


        return Command::SUCCESS;
    }
}
