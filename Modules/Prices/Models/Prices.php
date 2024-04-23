<?php

namespace Modules\Prices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prices extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_uploaded_id',
        'model',
        'price',
        'quantity',
        'additional',
    ];

    //protected $primaryKey = 'model';
    protected $keyType = 'string';
    public $incrementing = false;

    public function link(): hasOne
    {
        return $this->hasOne(LinkPrices::class, 'price_id', 'id');
    }
}
