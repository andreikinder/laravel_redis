<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Lesson;
use Database\Factories\LessonFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Article::factory(10)->create();

        Lesson::factory(10)->create();
        // \App\Models\User::factory(10)->create();
    }
}
