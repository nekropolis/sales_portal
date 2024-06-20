<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Currency\Models\Currency;
use Modules\Products\Models\Products;

class Inventories extends Model
{
    use HasFactory;

    protected $table   = 'inventories';

    protected $fillable = [
        'product_id',
        'price_model_id',
        'price',
        'currency_id',
        'qty',
    ];

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
