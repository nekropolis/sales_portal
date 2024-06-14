<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int rule_id
 * @property int category_id
 */
class RuleCategoriesRelationModel extends Model
{
    use HasFactory;

    public const TABLE    = 'rule_categories_relation';
    protected $table      = self::TABLE;
    public $timestamps    = false;
}
