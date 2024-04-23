<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Catalog\Models\Brands;
use Modules\Catalog\Models\Categories;
use Modules\Catalog\Models\Products;

class LinkPrices extends Model
{
    use HasFactory;

    protected $table   = 'links';
    protected $fillable = [
        'product_id',
        'price_id',
        'price_model_name_md5',
        'price_model_name',
        'is_link',
        'is_exist',
    ];

    //protected $primaryKey = 'model';
    protected $keyType = 'string';
    public $incrementing = false;

    public function price(): belongsTo
    {
        return $this->belongsTo(Prices::class);
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Products::class);
    }

    public function categoryName() : hasManyThrough
    {
        return $this->hasManyThrough(Products::class, Brands::class);
    }
}
