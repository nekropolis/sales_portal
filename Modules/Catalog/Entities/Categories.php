<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $table   = 'categories';

    public function products(): HasMany
    {
        return $this->hasMany(Products::class);
    }
}
