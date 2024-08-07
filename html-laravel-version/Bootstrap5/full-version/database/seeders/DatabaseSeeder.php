<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create users
        \App\Models\User::factory(10)->create();
    

        // Seed courses
        $this->call(CoursesSeeder::class);
        
        // Seed quizzes after courses
        $this->call(QuizzesSeeder::class);
        
        // Seed questions after quizzes
        $this->call(QuestionsSeeder::class);
        
        // Seed answers last
        $this->call(AnswersSeeder::class);
    }
}
