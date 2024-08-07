<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quizzes')->insert([
            ['course_id' => 1, 'title' => ' Kuizi ne Gjuhe Shqipe'],
            ['course_id' => 2, 'title' => ' Kuizi ne Gjuhe Angleze'],
            ['course_id' => 3, 'title' => ' Kuizi ne Matematike'],
        ]);
    }
}
