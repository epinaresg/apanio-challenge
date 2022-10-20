<?php

namespace App\Jobs;

use App\UseCases\Crypto\GetAssetPriceUseCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GetBitcoinPriceJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $useCase;
    private $sleep;

    public function __construct(int $sleep)
    {
        $this->sleep = $sleep;
        $this->useCase = new GetAssetPriceUseCase();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep($this->sleep);
        $this->useCase->__invoke('bitcoin');
    }
}
