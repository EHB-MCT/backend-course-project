<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $number = random_int(10, 20);

        User::factory($number)->create();
        Survey::factory(random_int(User::all()->count()*2,User::all()->count()*3))->create();
        Question::factory(random_int(Survey::all()->count()*2,Survey::all()->count()*3))->create();

        $user = new User();
        $user->name = 'Some User';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('password');
        $user->save();

        $survey = new Survey();
        $survey->user_id = 1;
        $survey->list_name = 'Lijstje 1';
        $survey->save();

        $question = new Question();
        $question->survey_id = 2;
        $question->question = 'Een vraag aan u...';
        $question->save();
    }
}
