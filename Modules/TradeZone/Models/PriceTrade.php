<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Prices\Models\LinkPrices;
use Modules\Prices\Models\PricesUploaded;

class PriceTrade extends Model
{
    use HasFactory;

    protected $table   = 'price_trade';
    protected $fillable = [
        'price_uploaded_id',
        'model',
        'price',
        'quantity',
        'additional',
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    public function link(): hasOne
    {
        return $this->hasOne(LinkPrices::class, 'price_model_id', 'id');
    }

    public function priceUploaded(): belongsTo
    {
        return $this->belongsTo(PricesUploaded::class);
    }
}
