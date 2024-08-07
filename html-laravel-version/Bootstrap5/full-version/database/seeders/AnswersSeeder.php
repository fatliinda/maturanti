<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('answers')->insert([
            // Answers for the first question
            ['question_id' => 1, 'answer' => 'Meshari', 'is_correct' => true],
            ['question_id' => 1, 'answer' => 'Kanuni i Lekë Dukagjinit', 'is_correct' => false],
            ['question_id' => 1, 'answer' => 'Historia e Skënderbeut', 'is_correct' => false],
            ['question_id' => 1, 'answer' => 'Buzuku', 'is_correct' => false],
            
            // Answers for the second question
            ['question_id' => 2, 'answer' => '5', 'is_correct' => false],
            ['question_id' => 2, 'answer' => '6', 'is_correct' => false],
            ['question_id' => 2, 'answer' => '8', 'is_correct' => true],
            ['question_id' => 2, 'answer' => '7', 'is_correct' => false],
            
            // Answers for the third question
            ['question_id' => 3, 'answer' => '3', 'is_correct' => false],
            ['question_id' => 3, 'answer' => '4', 'is_correct' => true],
            ['question_id' => 3, 'answer' => '5', 'is_correct' => false],
            ['question_id' => 3, 'answer' => '6', 'is_correct' => false],
        ]);
    }
}
