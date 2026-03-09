<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('question_images')->insert([
            ['question_id' => 1, 'image' => 'https://placeholdit.com/600x400/dddddd/999999?text=Placeholder&font=inter'],
        ]);
    }
}
