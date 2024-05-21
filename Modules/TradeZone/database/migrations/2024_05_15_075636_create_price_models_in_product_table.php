<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('price_models_in_product', function (Blueprint $table) {
            $table->integer('product_id')->nullable()->default(0)->unsigned()->index();
            $table->integer('price_parse_id')->nullable()->default(0)->unsigned()->index();
            $table->foreign('price_parse_id')
                ->references('id')
                ->on('price_parse')
                ->onDelete('cascade');
            $table->unique(['price_parse_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_models_in_product');
    }
};
