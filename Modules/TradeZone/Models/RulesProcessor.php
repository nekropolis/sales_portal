<?php

namespace Modules\TradeZone\Models;

class RulesProcessor
{
    static    $_instance       = null;
    protected $_rules;
    protected $_fieldCache     = [];
    protected $_affectedFields = [
        'price_min',
        'price_max',
        'categories',
        'brands',
        'price_uploaded',
    ];

    public function __construct()
    {
        $this->prepareRules();
    }

    protected function prepareRules()
    {
        $this->_rules = Rules::where('is_active', 1)
            ->with('categories')
            ->with('brands')
            ->with('price_uploaded')
            ->orderBy('sort')
            ->orderBy('id')
            ->get();
    }


    protected function cacheField($rule, $field)
    {
        if (!$rule->$field) {
            return [];
        }
        if (!isset($this->_fieldCache[$field][$rule->id])) {
            foreach ($rule->$field as $item) {
                $this->_fieldCache[$field][$rule->id][] = $item->id;
            }
        }

        return $this->_fieldCache[$field][$rule->id] ?? [];
    }

    public function calculatePrice($product)
    {
        foreach ($this->_rules as $rule) {
            $ruleApplied = true;
            foreach ($this->_affectedFields as $affectedField) {
                $methodName = 'validate'.implode('', array_map('ucfirst', explode('_', $affectedField)));
                if (is_callable([$this, $methodName])) {
                    switch ($affectedField) {
                        case 'categories':
                        case 'brands':
                        case 'price_uploaded':
                            $value = $this->cacheField($rule, $affectedField);
                            break;
                        default:
                            $value = $rule->$affectedField;
                    }
                    if (!call_user_func_array([$this, $methodName],
                        [$product, $value]
                    )) {
                        $ruleApplied = false;
                        break;
                    }
                }
            }
            if ($ruleApplied) {
                if (strpos($rule->trade_margin, '%')) {
                    $percent = str_replace('%', '', $rule->trade_margin);
                    return round($product['price'] + $product['price'] / 100 * $percent);
                } else {
                    return $product['price'] + $rule->trade_margin;
                }
            }
        }
        if ($this->_rules->count() == 0) {
            return false;
        } else {
            return $product['price'];
        }
    }

    public function validatePriceMin($product, $value)
    {
        if ($value == 0) {
            return true;
        }
        if ($product['price'] >= $value) {
            return true;
        }

        return false;
    }

    public function validatePriceMax($product, $value)
    {
        if ($value == 0) {
            return true;
        }
        if ($product['price'] <= $value) {
            return true;
        }

        return false;
    }

    public function validateCategories($product, $categoryIds)
    {
        if (!count($categoryIds)) {
            return true;
        }
        if (in_array($product['category_id'], $categoryIds)) {
            return true;
        }

        return false;
    }

    public function validateBrands($product, $brandsIds)
    {
        if (!count($brandsIds)) {
            return true;
        }
        if (in_array($product['brand_id'], $brandsIds)) {
            return true;
        }

        return false;
    }

    public function validatePriceUploaded($product, $priceUploadedIds)
    {
        if (!count($priceUploadedIds)) {
            return true;
        }
        if (in_array($product['price_uploaded_id'], $priceUploadedIds)) {
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
