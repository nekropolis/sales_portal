<?php

namespace App\Console\Commands;

use Elasticsearch;
use Illuminate\Console\Command;
use Modules\Products\Models\Products;

class IndexProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:products';

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
        $products = Products::with('brand:id,name')->get();

        foreach ($products as $product) {
            try {
                Elasticsearch::index([
                    'id'    => $product->id,
                    'index' => 'products',
                    'body'  => [
                        'brand' => $product->brand ? $product->brand->name : '',
                        'model' => $product->model,
                    ],
                ]);
            } catch (\Exception $e) {
                $this->info($e->getMessage());
            }
        }

        $this->info("Products were successfully indexed");
    }
}
