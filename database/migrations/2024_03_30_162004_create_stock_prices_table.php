<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('stock_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->references('id')->on('stocks')->cascadeOnDelete();
            $table->decimal('price', 10, 4);
            $table->dateTime('date_and_time_of_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_prices');
    }
};
