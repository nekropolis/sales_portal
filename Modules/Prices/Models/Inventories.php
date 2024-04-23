<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Catalog\Models\Currency;
use Modules\Catalog\Models\Margin;

class Inventories extends Model
{
    use HasFactory;

    protected $table   = 'inventories';

    public function margin(): BelongsTo
    {
        return $this->belongsTo(Margin::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

}
