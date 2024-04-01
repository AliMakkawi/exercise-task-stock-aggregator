<?php

use App\Console\Commands\FetchStockPrices;
use Illuminate\Support\Facades\Schedule;

Schedule::command(FetchStockPrices::class)->everyMinute();
