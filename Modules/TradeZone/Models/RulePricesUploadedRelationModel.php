<?php

namespace Modules\TradeZone\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int rule_id
 * @property int price_uploaded_id
 */
class RulePricesUploadedRelationModel extends Model
{
    use HasFactory;

    public const TABLE    = 'rule_prices_uploaded_relation';
    protected $table      = self::TABLE;
    public $timestamps    = false;
}
