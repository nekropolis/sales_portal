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
        Schema::create('price_parse', function (Blueprint $table) {
            $table->id();
            $table->integer('price_uploaded_id');
            $table->string('model');
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('additional')->nullable();
            $table->integer('currency_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_parse');
    }
};
