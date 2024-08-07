<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            ['id' => 1, 'title' => 'Gjuhe Shqipe','description' => 'Ketu mund te testoni njohurit nga lenda e gjuhes shqipe'],
            ['id' => 2, 'title' => 'Gjuhe Angleze','description' => 'Ketu mund te testoni njohurit nga lenda e gjuhes angleze'],
            ['id' => 3, 'title' => 'Matematike','description' => 'Ketu mund te testoni njohurit nga lenda e matematikes'],
        ]);
    }
}
