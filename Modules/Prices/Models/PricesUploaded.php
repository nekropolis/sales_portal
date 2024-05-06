<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Catalog\Models\Currency;
use Modules\Sellers\Models\Sellers;

class PricesUploaded extends Model
{
    use HasFactory;

    protected $table   = 'prices_uploaded';

    protected $fillable = [
        'name',
        'orig_name',
        'file_path',
        'currency_id'
    ];


    public function seller(): BelongsTo
    {
        return $this->belongsTo(Sellers::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function priceParse(): hasMany
    {
        return $this->hasMany(PriceParse::class, 'price_uploaded_id', 'id');
    }
}
