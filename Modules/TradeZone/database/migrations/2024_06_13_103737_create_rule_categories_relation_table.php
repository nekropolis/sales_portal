<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('rule_categories_relation', function (Blueprint $table) {
            $table->unsignedBigInteger('rule_id')->nullable()->default(0)->unsigned()->index();
            $table->unsignedBigInteger('category_id')->default(0)->unsigned()->index();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
                ->onDelete('cascade');
            $table->unique(['rule_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rule_categories_relation');
    }
};
