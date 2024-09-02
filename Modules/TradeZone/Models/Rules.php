<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Brands\Models\Brands;
use Modules\Categories\Models\Categories;
use Modules\Prices\Models\Inventories;
use Modules\Prices\Models\PricesUploaded;

class Rules extends Model
{
    use HasFactory;

    protected $table = 'rules';

    protected $fillable = ['is_active'];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventories::class);
    }

    public function priceUploaded(): HasMany
    {
        return $this->hasMany(PricesUploaded::class, 'id', 'price_uploaded_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Categories::class,
            RuleCategoriesRelationModel::TABLE,
            'rule_id',
            'category_id',
        );
    }

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(
            Brands::class,
            RuleBrandsRelationModel::TABLE,
            'rule_id',
            'brand_id',
        );
    }

    public function price_uploaded(): BelongsToMany
    {
        return $this->belongsToMany(
            PricesUploaded::class,
            RulePricesUploadedRelationModel::TABLE,
            'rule_id',
            'price_uploaded_id',
        );
    }
}
