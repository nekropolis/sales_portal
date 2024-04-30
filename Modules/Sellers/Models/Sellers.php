<?php

namespace Modules\Sellers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Prices\Models\PricesUploaded;

class Sellers extends Model
{
    use HasFactory;

    public function pricesUploaded(): HasMany
    {
        return $this->hasMany(PricesUploaded::class);
    }
}
