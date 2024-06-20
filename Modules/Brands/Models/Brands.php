<?php

namespace Modules\Brands\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Products\Models\Products;
use Modules\TradeZone\Models\Rules;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';

    public function products(): HasMany
    {
        return $this->hasMany(Products::class);
    }

    public function rule(): BelongsTo
    {
        return $this->belongsTo(Rules::class);
    }
}
