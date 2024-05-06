<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use App\Models\Barbecue;
use App\Models\BasketProduct;
use App\Models\Basket;
use App\Models\Product;
use App\Models\BarbecueFriendship;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_joan = User::create([
            'name' => 'Joan',
            'surnames' => 'Paneque Domingo',
            'email' => 'jpaneque@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        $user_roman = User::create([
            'name' => 'Roman',
            'surnames' => 'Mysyura',
            'email' => 'rmysyura@cendrassos.net',
            'password' => bcrypt('123456'),
            'image' => '/assets/img/roman.jpg'
        ]);

        $user_emma = User::create([
            'name' => 'Emma',
            'surnames' => 'Cardosa',
            'email' => 'ecardosa@cendrassos.net',
            'password' => bcrypt('123456'),
            'image' => '/assets/img/emma.jpg'
        ]);

        $user_aniol = User::create([
            'name' => 'Aniol',
            'surnames' => 'Moreno',
            'email' => 'amoreno@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        $user_marcos = User::create([
            'name' => 'Marcos',
            'surnames' => 'Muñoz',
            'email' => 'mmunoz@cendrassos.net',
            'password' => bcrypt('123456')
        ]);

        $user_roman->sendFriendRequest($user_emma);
        $user_joan->sendFriendRequest($user_emma);

        // joan
        $user_joan->sendFriendRequest($user_roman);
        $user_roman->acceptFriendRequest($user_joan);

        $user_joan->sendFriendRequest($user_emma);
        $user_emma->acceptFriendRequest($user_joan);

        $user_joan->sendFriendRequest($user_aniol);
        $user_aniol->acceptFriendRequest($user_joan);

        $user_joan->sendFriendRequest($user_marcos);
        $user_marcos->acceptFriendRequest($user_joan);

        // roman
        $user_roman->sendFriendRequest($user_emma);
        $user_emma->acceptFriendRequest($user_roman);

        $user_roman->sendFriendRequest($user_aniol);
        $user_aniol->acceptFriendRequest($user_roman);

        $user_roman->sendFriendRequest($user_marcos);
        $user_marcos->acceptFriendRequest($user_roman);

        // emma
        $user_emma->sendFriendRequest($user_aniol);
        $user_aniol->acceptFriendRequest($user_emma);

        $user_emma->sendFriendRequest($user_marcos);
        $user_marcos->acceptFriendRequest($user_emma);

        // aniol
        $user_aniol->sendFriendRequest($user_marcos);
        $user_marcos->acceptFriendRequest($user_aniol);

        function random_float($min, $max): float
        {
            return $min + lcg_value() * abs($max - $min);
        }

        for ($i = 0; $i < 300; $i++) {
            $random_user = User::inRandomOrder()->first();
        
            Barbecue::create([
                'user_id' => $random_user->id,
                'latitude' => random_float(40, 42),
                'longitude' => random_float(1, 3),
                'address' => "Adreça de la barbacoa nº$i",
                'title' => "Barbacoa nº$i",
                'content' => "<h1>Barbacoa nº$i</h1><p>Benvinguts a la barbacoa nº$i, en aquet lloc podreu gaudir de la millor barbacoa de la ciutat. Us esperem a tots!</p>"
            ]);

            Product::create([
                'user_id' => $random_user->id,
                'name' => "Producte nº$i",
                'price' => random_float(1, 100),
                'is_deleted' => false
            ]);

            Basket::create([
              
                'barbecue_id' => $random_user->barbecues()->inRandomOrder()->first()->id
            ]);

            BasketProduct::create([
                'basket_id' => $random_user->barbecues()->inRandomOrder()->first()->id,
                'product_id' => $random_user->barbecues()->inRandomOrder()->first()->id,
                'user_id' => $random_user->id,
                'quantity' => random_int(1, 10),
                'price' => random_float(1, 100)
            ]);

        }

        Barbecue::create([
            'user_id' => $user_joan->id,
            'latitude' => 41.385063,
            'longitude' => 2.173404,
            'address' => 'Barcelona',
            'title' => 'Barbacoa a barcelona',
            'content' => '<h1>Barbacoa a barcelona</h1><>Benvinguts a la barbacoa a barcelona, en aquet lloc podreu gaudir de la millor barbacoa de la ciutat. Us esperem a tots!</p>'
        ]);

        Barbecue::create([
            'user_id' => $user_roman->id,
            'latitude' => 42.2666,
            'longitude' => 2.9591,
            'address' => 'Figueres, Girona',
            'title' => 'Barbacoa a figueres, girona',
            'content' => '<h1>Barbacoa a figueres, girona</h1><p>Benvinguts a la barbacoa a figueres, en aquet lloc podreu gaudir de la millor barbacoa de la ciutat. Us esperem a tots!</p>'
        ]);

        Barbecue::create([
            'user_id' => $user_emma->id,
            'latitude' => 42.2632,
            'longitude' => 3.1600,
            'address' => 'Roses, Girona',
            'title' => 'Barbacoa a roses, girona',
            'content' => '<h1>Barbacoa a roses, girona</h1><p>Benvinguts a la barbacoa a roses, en aquet lloc podreu gaudir de la millor barbacoa de la ciutat. Us esperem a tots!</p>'
        ]);

        Barbecue::create([
            'user_id' => $user_aniol->id,
            'latitude' => 42.0451,
            'longitude' => 3.1856,
            'address' => 'L\'Estartit, Girona',
            'title' => 'Barbacoa a l\'estartit, girona',
            'content' => '<h1>Barbacoa a l\'estartit, girona</h1><p>Benvinguts a la barbacoa a l\'estartit, en aquet lloc podreu gaudir de la millor barbacoa de la ciutat. Us esperem a tots!</p>'
        ]);

        BarbecueFriendship::create([
            'barbecue_id' => 1,
            'user_id' => 1,
            'guest_id' => 2,
            'is_admin' => false,
            'accepted' => true
        ]);
    }
}