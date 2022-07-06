<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $user = new User();
        $user->name = 'Some User';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
    }
}
