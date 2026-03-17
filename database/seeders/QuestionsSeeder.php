<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'user_id' => 1,
                'title' => 'How to implement a binary search algorithm in Python?',
                'body' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
                'views' => 0,
                'upvotes' => 0,
                'downvotes' => 0,
                'answers' => 1,
                'created_at' => now()->copy()->subYears(50),
                'updated_at' => now()->copy()->subYears(50),
            ],

            [
                'user_id' => 1,
                'title' => 'How to implement a binary search algorithm in C#?',
                'body' => 'I am trying to implement a binary search algorithm in C#, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
                'views' => 0,
                'upvotes' => 0,
                'downvotes' => 0,
                'answers' => 4,
                'created_at' => now()->copy()->subDays(3),
                'updated_at' => now()->copy()->subDays(3),
            ],

        ]);
    }
}
