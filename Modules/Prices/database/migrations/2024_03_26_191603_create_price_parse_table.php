<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_parse', function (Blueprint $table) {
            $table->id();
            $table->integer('price_uploaded_id')->unsigned()->index();
            $table->string('model');
            $table->float('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->longText('additional')->nullable();
            $table->integer('currency_id')->default(0)->unsigned()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_parse');
    }
};
