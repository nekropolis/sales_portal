<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->integer('is_active')->default(0);
            $table->integer('price_min')->default(0);
            $table->integer('price_max')->default(0);
            $table->integer('price_uploaded_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('brand_id')->default(0);
            $table->integer('trade_margin')->default(0);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};