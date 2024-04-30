<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PriceParse extends Model
{
    use HasFactory;

    protected $table   = 'price_parse';
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
}
