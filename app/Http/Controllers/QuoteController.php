<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;
use Inertia\Inertia;

class QuoteController extends Controller
{
    protected $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function index()
    {
        $quote = $this->quoteService->getDailyQuote();

        return Inertia::render('Home', [
            'quote' => $quote,
        ]);
    }

    public function daily()
    {
        $quote = $this->quoteService->getDailyQuote();

        return response()->json([
            'quote' => $quote?->quote,
            'author' => $quote?->author,
            'source' => $quote?->source,
            'tags' => $quote?->tags->pluck('name'),
            'date' => now()->toDateString(),
        ]);
    }
}
