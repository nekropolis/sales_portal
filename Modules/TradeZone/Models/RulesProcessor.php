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

class RulesProcessor
{
    static $_instance = null;
    protected $_rules;
    protected $_affectedFields =[
        'price_min',
        'price_max'
    ];

    public function __construct()
    {
        $this->prepareRules();
    }

    protected function prepareRules()
    {
        $this->_rules = Rules::where('is_active', 1)
            ->orderBy('sort')
            ->orderBy('id')
            ->get();
    }

    public function calculatePrice($product)
    {
        foreach ($this->_rules as $rule){
            $ruleApplied = true;
            foreach ($this->_affectedFields as $affectedField) {
                $methodName = 'validate' . implode('', array_map('ucfirst', explode('_', $affectedField)));
                if (is_callable([$this, $methodName])) {
                    if (!call_user_func_array([$this, $methodName],
                        [$product, $rule->$affectedField]
                    )) {
                        $ruleApplied  = false;
                      break;
                    }
                }
            }
            if($ruleApplied){
                return $product['price'] + $rule->trade_margin;
            }
        }
        return $product['price'];
    }

    public function validatePriceMin($product, $value)
    {
        if($value==0){
            return true;
        }
        if($product['price']>=$value){
            return true;
        }
        return false;
    }

    public function validatePriceMax($product, $value)
    {
        if($value==0){
            return true;
        }
        if($product['price']<=$value){
            return true;
        }
        return false;
    }

    public static function processed($product)
    {
        if (self::$_instance === null) {
            $_instance = new self();
        }
        return $_instance->calculatePrice($product);
    }
}
