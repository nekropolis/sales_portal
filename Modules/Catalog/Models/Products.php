<?php

namespace Modules\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Prices\Models\LinkPrices;

class Products extends Model
{
    use HasFactory;

    protected $table   = 'products';

    protected $fillable = ['model', 'brand_id', 'category_id'];

    public function brand(): belongsTo
    {
        return $this->belongsTo(Brands::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function link(): hasOne
    {
        return $this->hasOne(LinkPrices::class, 'product_id', 'id');
    }
}
