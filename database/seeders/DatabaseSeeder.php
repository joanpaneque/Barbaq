<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Joan',
            'surnames' => 'Paneque Domingo',
            'email' => 'jpaneque@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Roman',
            'surnames' => 'Mysyura',
            'email' => 'rmysyura@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Emma',
            'surnames' => 'Cardosa',
            'email' => 'ecardosa@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Aniol',
            'surnames' => 'Moreno',
            'email' => 'amoreno@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Marcos',
            'surnames' => 'Muñoz',
            'email' => 'mmunoz@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

    
    }
}
