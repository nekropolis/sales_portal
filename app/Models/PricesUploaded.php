<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PricesUploaded extends Model
{
    use HasFactory;

    protected $table   = 'prices_uploaded';

    protected $fillable = [
        'name',
        'orig_name',
        'file_path'
    ];


    public function seller(): BelongsTo
    {
        return $this->belongsTo(Sellers::class);
    }

    public function price(): hasOne
    {
        return $this->hasOne(Prices::class, 'price_uploaded_id');
    }
}
