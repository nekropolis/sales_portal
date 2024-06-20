<?php

namespace Modules\Currency\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\PriceParse;
use Modules\Prices\Models\PricesUploaded;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currency';

    protected $fillable = ['name', 'code'];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventories::class);
    }

    public function priceParse(): HasMany
    {
        return $this->hasMany(PriceParse::class);
    }

    public function uploadedPrice(): HasMany
    {
        return $this->HasMany(PricesUploaded::class);
    }
}
