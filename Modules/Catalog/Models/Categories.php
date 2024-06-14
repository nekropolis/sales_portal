<?php

namespace Modules\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\TradeZone\Models\Rules;

class Categories extends Model
{
    use HasFactory;

    protected $table   = 'categories';

    public function products(): HasMany
    {
        return $this->hasMany(Products::class);
    }

    public function rule(): BelongsTo
    {
        return $this->belongsTo(Rules::class);
    }
}
