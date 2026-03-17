<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class ResponsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('responses')->insert([
            [
                'user_id' => 1,
                'question_id' => 2,
                'parent_id' => null,
                'body' => 'Response TEST 1',
                'upvotes' => 3,
                'downvotes' => 0,
                'image' => 'https://placeholdit.com/300x300/dddddd/999999?text=USER+IMAGE',
                'is_accepted' => false,
                'created_at' => now()->copy()->addDays(3),
                'updated_at' => now()->copy()->addDays(3),
            ],
            [
                'user_id' => 1,
                'question_id' => 2,
                'parent_id' => null,
                'body' => 'Response TEST 11',
                'upvotes' => 1,
                'downvotes' => 4,
                'image' => null,
                'is_accepted' => false,
                'created_at' => now()->copy()->subDays(7),
                'updated_at' => now()->copy()->subDays(7),
            ],
            [
                'user_id' => 1,
                'question_id' => 1,
                'parent_id' => null,
                'body' => 'Response TEST 00-00',
                'upvotes' => 2,
                'downvotes' => 2,
                'image' => null,
                'is_accepted' => false,
                'created_at' => now()->copy()->subDays(5),
                'updated_at' => now()->copy()->subDays(5),
            ],
            [
                'user_id' => 1,
                'question_id' => 1,
                'parent_id' => null,
                'body' => 'Response TEST 0',
                'upvotes' => 2,
                'downvotes' => 2,
                'image' => null,
                'is_accepted' => true,
                'created_at' => now()->copy()->subDays(5),
                'updated_at' => now()->copy()->subDays(5),
            ],
            [
                'user_id' => 1,
                'question_id' => 2,
                'parent_id' => 1,
                'body' => 'Response TEST 2 Comment',
                'upvotes' => 0,
                'downvotes' => 2,
                'image' => null,
                'is_accepted' => false,
                'created_at' => now()->copy()->subDays(3),
                'updated_at' => now()->copy()->subDays(3),
            ],
            [
                'user_id' => 1,
                'question_id' => 2,
                'parent_id' => 1,
                'body' => 'Response TEST 22 Comment',
                'upvotes' => 0,
                'downvotes' => 2,
                'image' => null,
                'is_accepted' => false,
                'created_at' => now()->copy()->subDays(1),
                'updated_at' => now()->copy()->subDays(1),
            ],
        ]);
    }
}
