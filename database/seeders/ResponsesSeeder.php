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
            ['user_id' => 1, 'question_id' => 2, 'parent_id' => null, 'body' => 'Response TEST 1', 'upvotes' => 3, 'downvotes' => 1, 'image' => 'https://placeholdit.com/300x300/dddddd/999999?text=USER+IMAGE'],
            ['user_id' => 1, 'question_id' => 2, 'parent_id' => null, 'body' => 'Response TEST 11', 'upvotes' => 3, 'downvotes' => 1, 'image' => null],
            ['user_id' => 1, 'question_id' => 1, 'parent_id' => null, 'body' => 'Response TEST 0', 'upvotes' => 3, 'downvotes' => 1, 'image' => null],
            ['user_id' => 1, 'question_id' => 2, 'parent_id' => 1, 'body' => 'Response TEST 2 Comment', 'upvotes' => 0, 'downvotes' => 2, 'image' => null],
            ['user_id' => 1, 'question_id' => 2, 'parent_id' => 1, 'body' => 'Response TEST 22 Comment', 'upvotes' => 0, 'downvotes' => 2, 'image' => null],
        ]);
    }
}
