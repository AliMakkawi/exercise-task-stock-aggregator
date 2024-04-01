<?php

declare(strict_types=1);

namespace App\StockMarket\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $fillable = [
        'name',
        'symbol',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(StockPrice::class);
    }
}
