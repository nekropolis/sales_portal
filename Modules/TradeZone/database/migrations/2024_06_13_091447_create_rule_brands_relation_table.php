<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('rule_brands_relation', function (Blueprint $table) {
            $table->unsignedBigInteger('rule_id')->nullable()->default(0)->unsigned()->index();
            $table->unsignedBigInteger('brand_id')->default(0)->unsigned()->index();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
                ->onDelete('cascade');
            $table->unique(['rule_id', 'brand_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rule_brands_relation');
    }
};
