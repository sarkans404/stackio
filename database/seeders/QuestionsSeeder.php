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
            ['user_id' => 1, 'title' => 'How to implement a binary search algorithm in Python?', 'body' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?', 'views' => 20, 'upvotes' => 15, 'downvotes' => 2, 'answers' => 11],
            ['user_id' => 1, 'title' => 'How to implement a binary search algorithm in C#?', 'body' => 'I am trying to implement a binary search algorithm in C#, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?', 'views' => 243, 'upvotes' => 165, 'downvotes' => 19, 'answers' => 1],
        ]);
    }
}
