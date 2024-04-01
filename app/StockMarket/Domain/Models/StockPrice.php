<?php

declare(strict_types=1);

namespace App\StockMarket\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockPrice extends Model
{
    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
