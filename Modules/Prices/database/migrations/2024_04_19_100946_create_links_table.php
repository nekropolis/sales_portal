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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->integer('price_model_id');
            $table->string('price_model_name_md5');
            $table->string('price_model_name');
            $table->integer('is_link')->default(0);
            $table->integer('is_exist')->default(1);
            $table->integer('inventory_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
