<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Catalog\Models\Currency;
use Modules\Catalog\Models\Margin;
use Modules\Catalog\Models\Products;

class Inventories extends Model
{
    use HasFactory;

    protected $table   = 'inventories';

    protected $fillable = [
        'product_id',
        'price_model_id',
        'price',
        'margin_id',
        'currency_id',
        'qty',
    ];

    public function margin(): BelongsTo
    {
        return $this->belongsTo(Margin::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function priceParse(): belongsTo
    {
        return $this->belongsTo(PriceParse::class, 'price_model_id', 'id');
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
