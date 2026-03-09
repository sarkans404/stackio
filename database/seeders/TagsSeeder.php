<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'php', 'slug' => 'php'],
            ['name' => 'laravel', 'slug' => 'laravel'],
            ['name' => 'javascript', 'slug' => 'javascript'],
            ['name' => 'mysql', 'slug' => 'mysql'],
            ['name' => 'html', 'slug' => 'html'],
            ['name' => 'css', 'slug' => 'css'],
        ]);
    }
}
