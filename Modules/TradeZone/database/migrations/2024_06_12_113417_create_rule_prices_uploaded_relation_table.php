<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('rule_prices_uploaded_relation', function (Blueprint $table) {
            $table->unsignedBigInteger('rule_id')->default(0)->unsigned()->index();
            $table->unsignedBigInteger('price_uploaded_id')->default(0)->unsigned()->index();
            $table->foreign('price_uploaded_id')
                ->references('id')
                ->on('prices_uploaded')
                ->onDelete('cascade');
            $table->foreign('rule_id')
                ->references('id')
                ->on('rules')
                ->onDelete('cascade');
            $table->unique(['rule_id', 'price_uploaded_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules_price_uploaded_relation');
    }
};
