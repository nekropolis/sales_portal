<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Elasticsearch;
use Modules\Prices\Models\LinkPrices;

class IndexPriceLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:price-links';

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
        $models = LinkPrices::all();

        foreach ($models as $model) {
            try {
                Elasticsearch::index([
                    'id'    => $model->id,
                    'index' => 'price-links',
                    'body'  => [
                        'price_model_name'     => $model->price_model_name,
                        'price_model_name_md5' => $model->price_model_name_md5,

                    ],
                ]);
            } catch (\Exception $e) {
                $this->info($e->getMessage());
            }
        }

        $this->info("Prices were successfully indexed");
    }
}
