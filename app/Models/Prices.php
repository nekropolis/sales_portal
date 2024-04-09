<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $primaryKey = 'model';
    protected $keyType = 'string';
    public $incrementing = false;
}
