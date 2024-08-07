<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['quiz_id' => 1, 'question' => 'Cili eshte libri i pare i shkruar ne gjuhen shqipe?'],
            ['quiz_id' => 2, 'question' => 'Which number  is greater than 7 ?'],
            ['quiz_id' => 3, 'question' => 'Sa është 2 + 2?'],
        ]);
    }
}
