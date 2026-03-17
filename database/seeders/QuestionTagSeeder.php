<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('question_tags')->insert([
            [
                'question_id' => 1,
                'tag_id' => 1,
            ],
            [
                'question_id' => 1,
                'tag_id' => 2,
            ],
            [
                'question_id' => 1,
                'tag_id' => 3,
            ],
        ]);
    }
}
