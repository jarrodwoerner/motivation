<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quotes = [
            [
                'quote' => 'The only way to do great work is to love what you do.',
                'author' => 'Steve Jobs',
                'source' => 'Stanford Commencement Speech, 2005',
                'tags' => ['Success', 'Motivational', 'Life']
            ],
            [
                'quote' => 'Innovation distinguishes between a leader and a follower.',
                'author' => 'Steve Jobs',
                'source' => null,
                'tags' => ['Leadership', 'Success']
            ],
            [
                'quote' => 'Success is not final, failure is not fatal: it is the courage to continue that counts.',
                'author' => 'Winston Churchill',
                'source' => null,
                'tags' => ['Success', 'Perseverance', 'Motivational']
            ],
            [
                'quote' => 'The future belongs to those who believe in the beauty of their dreams.',
                'author' => 'Eleanor Roosevelt',
                'source' => null,
                'tags' => ['Inspirational', 'Life', 'Success']
            ],
            [
                'quote' => 'It does not matter how slowly you go as long as you do not stop.',
                'author' => 'Confucius',
                'source' => null,
                'tags' => ['Perseverance', 'Wisdom', 'Motivational']
            ],
            [
                'quote' => 'Everything you\'ve ever wanted is on the other side of fear.',
                'author' => 'George Addair',
                'source' => null,
                'tags' => ['Inspirational', 'Motivational', 'Success']
            ],
            [
                'quote' => 'Believe you can and you\'re halfway there.',
                'author' => 'Theodore Roosevelt',
                'source' => null,
                'tags' => ['Inspirational', 'Success', 'Motivational']
            ],
            [
                'quote' => 'The only impossible journey is the one you never begin.',
                'author' => 'Tony Robbins',
                'source' => null,
                'tags' => ['Motivational', 'Inspirational', 'Life']
            ],
            [
                'quote' => 'Your time is limited, don\'t waste it living someone else\'s life.',
                'author' => 'Steve Jobs',
                'source' => 'Stanford Commencement Speech, 2005',
                'tags' => ['Life', 'Wisdom', 'Inspirational']
            ],
            [
                'quote' => 'The way to get started is to quit talking and begin doing.',
                'author' => 'Walt Disney',
                'source' => null,
                'tags' => ['Motivational', 'Success', 'Leadership']
            ],
            [
                'quote' => 'Don\'t watch the clock; do what it does. Keep going.',
                'author' => 'Sam Levenson',
                'source' => null,
                'tags' => ['Perseverance', 'Motivational', 'Success']
            ],
            [
                'quote' => 'The pessimist sees difficulty in every opportunity. The optimist sees opportunity in every difficulty.',
                'author' => 'Winston Churchill',
                'source' => null,
                'tags' => ['Wisdom', 'Inspirational', 'Life']
            ],
            [
                'quote' => 'You miss 100% of the shots you don\'t take.',
                'author' => 'Wayne Gretzky',
                'source' => null,
                'tags' => ['Motivational', 'Success', 'Inspirational']
            ],
            [
                'quote' => 'Whether you think you can or you think you can\'t, you\'re right.',
                'author' => 'Henry Ford',
                'source' => null,
                'tags' => ['Wisdom', 'Success', 'Motivational']
            ],
            [
                'quote' => 'The greatest glory in living lies not in never falling, but in rising every time we fall.',
                'author' => 'Nelson Mandela',
                'source' => null,
                'tags' => ['Perseverance', 'Inspirational', 'Life']
            ],
            [
                'quote' => 'The best time to plant a tree was 20 years ago. The second best time is now.',
                'author' => 'Chinese Proverb',
                'source' => null,
                'tags' => ['Wisdom', 'Motivational', 'Life']
            ],
            [
                'quote' => 'Happiness is not something ready made. It comes from your own actions.',
                'author' => 'Dalai Lama',
                'source' => null,
                'tags' => ['Happiness', 'Wisdom', 'Life']
            ],
            [
                'quote' => 'If you want to lift yourself up, lift up someone else.',
                'author' => 'Booker T. Washington',
                'source' => null,
                'tags' => ['Leadership', 'Inspirational', 'Wisdom']
            ],
            [
                'quote' => 'I have not failed. I\'ve just found 10,000 ways that won\'t work.',
                'author' => 'Thomas Edison',
                'source' => null,
                'tags' => ['Perseverance', 'Success', 'Wisdom']
            ],
            [
                'quote' => 'A person who never made a mistake never tried anything new.',
                'author' => 'Albert Einstein',
                'source' => null,
                'tags' => ['Wisdom', 'Inspirational', 'Success']
            ],
        ];

        foreach ($quotes as $quoteData) {
            $tagNames = $quoteData['tags'];
            unset($quoteData['tags']);

            $quote = \App\Models\Quote::create($quoteData);

            $tagIds = \App\Models\Tag::whereIn('name', $tagNames)->pluck('id');
            $quote->tags()->attach($tagIds);
        }
    }
}
