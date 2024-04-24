<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Elasticsearch;
use Modules\Prices\Models\PriceParse;

class IndexPriceParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:price-parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prices = PriceParse::all();

        foreach ($prices as $price) {
            try {
                Elasticsearch::index([
                    'id'    => $price->id,
                    'index' => 'price-parse',
                    'body'  => [
                        'model'      => $price->model,
                        'additional' => $price->additional,

                    ],
                ]);
            } catch (\Exception $e) {
                $this->info($e->getMessage());
            }
        }

        $this->info("Prices were successfully indexed");
    }
}
