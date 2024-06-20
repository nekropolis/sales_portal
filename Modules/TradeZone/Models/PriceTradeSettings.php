<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Currency\Models\Currency;

class PriceTradeSettings extends Model
{
    use HasFactory;

    protected $table   = 'trade_settings';
    protected $fillable = [
        'currency_id',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    public function currency(): belongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
