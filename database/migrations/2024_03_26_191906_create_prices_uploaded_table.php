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
        Schema::create('prices_uploaded', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->string('orig_name')->nullable();
            $table->string('name');
            $table->string('file_path')->nullable();
            $table->integer('status')->nullable();
            $table->string('sheet_name')->nullable();
            $table->string('numeration_started')->default(0);
            $table->string('model_name')->nullable();
            $table->string('price_name')->nullable();
            $table->string('qty_name')->nullable();
            $table->string('additional')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices_uploaded');
    }
};
