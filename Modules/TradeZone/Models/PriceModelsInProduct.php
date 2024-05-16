<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Catalog\Models\Currency;
use Modules\Catalog\Models\Products;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\PriceParse;
use Modules\Prices\Models\PricesUploaded;

class PriceModelsInProduct extends Model
{
    use HasFactory;

    protected $table   = 'price_models_in_product';
    protected $fillable = [
        'product_id',
        'price_parse_id'
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    public function product(): hasOne
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

    public function priceParse(): HasMany
    {
        return $this->HasMany(PriceParse::class, 'id', 'price_parse_id');
    }
}
