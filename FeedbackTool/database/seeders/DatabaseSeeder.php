<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Session;
use App\Models\SurveySurvlist;
use App\Models\Survey;
use App\Models\Survlist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
         * Create permissions
         */
        // only admin
        Permission::create(["name" => "admin"]);

        // Only moderator and up
        Permission::create(["name" => "moderate"]);

        // Only caretaker and up
        Permission::create(["name" => "caretaker"]);

        // Only client and up
        Permission::create(["name" => "client"]);

        /*
         * Create Roles
         */
        // Admin
        $admin = Role::create(["name" => "admin"])
            ->givePermissionTo(Permission::all());

        // Moderator
        $moderator = Role::create(["name" => "moderator"])
            ->givePermissionTo("moderate", "caretaker", "client");

        // Caretaker
        $caretaker = Role::create(["name" => "caretaker"])
            ->givePermissionTo("caretaker", "client");

        // Client
        $client = Role::create(["name" => "client"])
            ->givePermissionTo("client");


        User::create([
            'name' => 'Some User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole($admin);

        User::factory() -> create([
            'name' => 'Mike Derycke',
            'email' => 'mike.derycke@ehb.be',
            'password' => Hash::make('backendisawesome')
        ])->assignRole($admin);

        User::factory() -> create([
            'name' => 'Almighty Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole($admin);

        User::factory() -> create([
            'name' => 'Powerful Mod',
            'email' => 'mod@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole($moderator);

        User::factory() -> create([
                'name' => 'Mr. Caretaker',
                'email' => 'mrcare@gmail.com',
                'password' => Hash::make('password')
        ])->assignRole($caretaker);

        User::factory() -> create([
                'name' => 'Mrs. Caretaker',
                'email' => 'mrscare@gmail.com',
                'password' => Hash::make('password')
        ])->assignRole($caretaker);

        User::factory() -> create([
            'name' => 'Client a',
            'email' => 'clienta@gmail.com',
            'password' => Hash::make('password'),
            'caretaker_id' => 5,
        ])->assignRole($client);

        User::factory() -> create([
            'name' => 'Client b',
            'email' => 'clientb@gmail.com',
            'password' => Hash::make('password'),
            'caretaker_id' => 6,
        ])->assignRole($client);

        User::factory() -> create([
            'name' => 'Client c',
            'email' => 'clientc@gmail.com',
            'password' => Hash::make('password'),
            'caretaker_id' => 5,
        ])->assignRole($client);

        User::factory() -> create([
            'name' => 'Client d',
            'email' => 'clientd@gmail.com',
            'password' => Hash::make('password'),
            'caretaker_id' => 6,
        ])->assignRole($client);

        Survey::factory(random_int(User::all()->count()*2,User::all()->count()*4))->create();
        Question::factory(random_int(Survey::all()->count()*2,Survey::all()->count()*3))->create();

        Survlist::create([
            'user_id' => 5,
            'list_name' => 'survey list 1',
            'description' => 'Een uitleg',
        ]);

        SurveySurvlist::create([
            'survey_id' => 5,
            'survlist_id' => 1,
        ]);

        SurveySurvlist::create([
            'survey_id' => 8,
            'survlist_id' => 1,
        ]);

        Survlist::create([
            'user_id' => 6,
            'list_name' => 'survey list 2',
            'description' => 'Een uitleg',
        ]);

        SurveySurvlist::create([
            'survey_id' => 3,
            'survlist_id' => 2,
        ]);

        SurveySurvlist::create([
            'survey_id' => 6,
            'survlist_id' => 2,
        ]);

        SurveySurvlist::create([
            'survey_id' => 10,
            'survlist_id' => 2,
        ]);

        Session::create([
            'caretaker_id' => 5,
            'client_id' => 7,
            'survlist_id' => 1,
            'duration_time' => now(),
        ]);

        Session::create([
            'caretaker_id' => 6,
            'client_id' => 8,
            'survlist_id' => 2,
            'duration_time' => now(),
        ]);

        Session::create([
            'caretaker_id' => 5,
            'client_id' => 7,
            'survlist_id' => 1,
            'duration_time' => now(),
        ]);
    }
}
