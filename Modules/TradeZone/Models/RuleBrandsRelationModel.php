<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int rule_id
 * @property int brand_id
 */
class RuleBrandsRelationModel extends Model
{
    use HasFactory;

    public const TABLE    = 'rule_brands_relation';
    protected $table      = self::TABLE;
    public $timestamps    = false;
}
