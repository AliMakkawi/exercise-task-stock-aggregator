<?php

use App\StockMarket\Domain\Models\Stock;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    public function up(): void
    {
        $stocks = [
            ['symbol' => 'AAPL', 'name' => 'Apple Inc.'],
            ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.'],
            ['symbol' => 'MSFT', 'name' => 'Microsoft Corporation'],
            ['symbol' => 'NVDA', 'name' => 'NVIDIA Corporation'],
            ['symbol' => 'AMZN', 'name' => 'Amazon.com Inc.'],
            ['symbol' => 'META', 'name' => 'Meta Platforms Inc.'],
            ['symbol' => 'JPM', 'name' => 'JPMorgan Chase & Co.'],
            ['symbol' => 'TSLA', 'name' => 'Tesla Inc.'],
            ['symbol' => 'V', 'name' => 'Visa Inc.'],
            ['symbol' => 'MA', 'name' => 'Mastercard Incorporated']
        ];

        foreach ($stocks as $stock) {
            Stock::create($stock);
        }
    }
};
