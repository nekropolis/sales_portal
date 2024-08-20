<?php

namespace Modules\Products\Models;

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Brands\Models\Brands;
use Modules\Categories\Models\Categories;
use Modules\Localizations\Models\Localizations;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\PriceParse;
use Modules\TradeZone\Models\PriceModelsInProduct;

class Products extends Model
{
    use HasFactory;

    protected $table   = 'products';

    protected $fillable = ['model', 'brand_id', 'category_id'];

    public static function createIndex()
    {
        $client = ClientBuilder::create()->setHosts(config('database.connections.elasticsearch.hosts'))->build();
        $params = [
            'index' => 'products',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'brand_id' => ['type' => 'integer'],
                        'model'    => ['type' => 'text'],
                    ],
                ]
            ],
        ];

        try {
            $client->indices()->create($params);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error or display a user-friendly message)
        }
    }

    public function brand(): belongsTo
    {
        return $this->belongsTo(Brands::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function localization(): belongsTo
    {
        return $this->belongsTo(Localizations::class);
    }

    public function link(): hasOne
    {
        return $this->hasOne(LinkPrices::class, 'product_id', 'id');
    }

    public function parseModels(): BelongsToMany
    {
        return $this->belongsToMany(
            PriceParse::class,
            PriceModelsInProduct::TABLE,
            'product_id',
            'price_parse_id',
        );
    }
}
