<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey = new Survey();
        $survey->user_id = 1;
        $survey->list_name = 'Een raar lijstje';
        $survey->save();
    }
}
