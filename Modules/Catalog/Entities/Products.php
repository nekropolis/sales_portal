<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $table   = 'products';

    public function brand(): belongsTo
    {
        return $this->belongsTo(Brands::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Categories::class);
    }
}
