<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Tag;
use App\Services\QuoteService;
use Illuminate\Http\Request;
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

    public function create()
    {
        $tags = Tag::orderBy('name')->get();

        return Inertia::render('AddQuote', [
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quote' => 'required|string',
            'author' => 'required|string|max:255',
            'source' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $quote = Quote::create([
            'quote' => $validated['quote'],
            'author' => $validated['author'],
            'source' => $validated['source'] ?? null,
        ]);

        if (!empty($validated['tags'])) {
            $quote->tags()->attach($validated['tags']);
        }

        return redirect()->back()->with('success', 'Quote added successfully!');
    }
}
