<?php

namespace Modules\Products\Observers;

use Modules\Products\Jobs\IndexProductElasticsearchJob;
use Modules\Products\Jobs\RemoveProductElasticsearchJob;
use Modules\Products\Models\Products;

class ProductObserver
{
    public function created(Products $product)
    {
        dispatch(new IndexProductElasticsearchJob($product));
    }

    public function updated(Products $product)
    {
        dispatch(new IndexProductElasticsearchJob($product));
    }

    public function deleted(Products $product)
    {
        dispatch(new RemoveProductElasticsearchJob($product->id));
    }
}