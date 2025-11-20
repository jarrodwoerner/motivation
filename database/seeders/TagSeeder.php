<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Motivational', 'slug' => 'motivational'],
            ['name' => 'Success', 'slug' => 'success'],
            ['name' => 'Inspirational', 'slug' => 'inspirational'],
            ['name' => 'Wisdom', 'slug' => 'wisdom'],
            ['name' => 'Happiness', 'slug' => 'happiness'],
            ['name' => 'Life', 'slug' => 'life'],
            ['name' => 'Leadership', 'slug' => 'leadership'],
            ['name' => 'Perseverance', 'slug' => 'perseverance'],
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::create($tag);
        }
    }
}
