<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Prices\Models\PricesUploaded;

class PriceModelsInProduct extends Model
{
    /**
     * @property int product_id
     * @property int price_parse_id
     */

    use HasFactory;

    public const TABLE    = 'price_models_in_product';
    protected $table      = self::TABLE;
    public $timestamps    = false;

    protected $fillable = [
        'product_id',
        'price_parse_id'
    ];

    public function priceUploaded(): belongsTo
    {
        return $this->belongsTo(PricesUploaded::class, 'price_parse_id', 'id');
    }
}
