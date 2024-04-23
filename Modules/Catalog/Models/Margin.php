<?php

namespace Modules\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Prices\Models\Inventories;

class Margin extends Model
{
    use HasFactory;

    protected $table = 'margin';

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventories::class);
    }
}
