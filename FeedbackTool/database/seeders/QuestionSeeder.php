<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question = new Question();
        $question->survey_id = 1;
        $question->question = 'Een random vraag';
        $question->save();
    }
}
