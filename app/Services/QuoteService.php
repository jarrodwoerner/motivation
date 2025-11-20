<?php

namespace App\Services;

use App\Models\Quote;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class QuoteService
{
    public function getDailyQuote()
    {
        $today = Carbon::today()->toDateString();
        $cacheKey = "quote:daily:{$today}";

        return Cache::remember($cacheKey, Carbon::tomorrow()->startOfDay()->diffInSeconds(), function () use ($today) {
            $quoteCount = Quote::count();

            if ($quoteCount === 0) {
                return null;
            }

            $seed = strtotime($today);
            mt_srand($seed);
            $randomIndex = mt_rand(1, $quoteCount);

            return Quote::with('tags')
                ->skip($randomIndex - 1)
                ->first();
        });
    }
}
