<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Modules\Catalog\Models\Brands;
use Modules\Catalog\Models\Categories;
use Modules\Catalog\Models\Products;

class LinkPrices extends Model
{
    use HasFactory;

    protected $table   = 'links';
    protected $fillable = [
        'product_id',
        'price_model_id',
        'price_model_name_md5',
        'price_model_name',
        'is_link',
        'is_exist',
    ];

    //protected $primaryKey = 'model';
    protected $keyType = 'string';
    public $incrementing = false;

    public function priceParse(): belongsTo
    {
        return $this->belongsTo(PriceParse::class, 'price_model_id', 'id');
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Products::class);
    }

    public function brandName() : hasManyThrough
    {
        return $this->hasManyThrough(Products::class, Brands::class);
    }

    public function categoryName() : hasManyThrough
    {
        return $this->hasManyThrough(Products::class, Categories::class);
    }

    public function priceUploaded() : hasOneThrough
    {
        return $this->hasOneThrough(PriceParse::class, PricesUploaded::class);
    }
}
