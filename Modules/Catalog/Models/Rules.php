<?php

namespace Modules\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\PricesUploaded;

class Rules extends Model
{
    use HasFactory;

    protected $table = 'rules';

    protected $fillable = ['is_active'];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventories::class);
    }

    public function priceUploaded(): HasMany
    {
        return $this->hasMany(PricesUploaded::class, 'id', 'price_uploaded_id');
    }
}
