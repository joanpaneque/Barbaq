<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use App\Models\Barbecue;

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

        for ($i = 0; $i < 30; $i++) {
            $random_user = User::inRandomOrder()->first();
        
            $barbecue = Barbecue::create([
                'user_id' => $random_user->id,
                'latitude' => random_float(40, 42),
                'longitude' => random_float(1, 3),
                'address' => "Adreça de la barbacoa nº$i",
                'title' => "Barbacoa nº$i",
                'content' => "<p>Benvinguts a la barbacoa nº$i, en aquet lloc podreu gaudir de la millor barbacoa de la ciutat. Us esperem a tots!</p>"
            ]);

            $random_images = rand(1, 4);

            if ($random_images === 4) {
                $random_images += rand(1, 4);
            }

            for ($j = 0; $j < $random_images; $j++) {
                $randomX = rand(450, 500);
                $randomY = rand(450, 500);
                $barbecue->images()->create([
                    'path' => 'https://random.imagecdn.app/' . $randomX . '/' . $randomY
                ]);
            }

            $random_comments = rand(0, 5);

            for ($j = 0; $j < $random_comments; $j++) {
                $random_user = User::inRandomOrder()->first();
                $barbecue->comments()->create([
                    'user_id' => $random_user->id,
                    'comment' => "Comentari de prova nº$j"
                ]);

                $random_replies = rand(0, 5);

                for ($k = 0; $k < $random_replies; $k++) {
                    $random_user = User::inRandomOrder()->first();
                    $comment = $barbecue->comments()->inRandomOrder()->first();
                    $comment->replies()->create([
                        'user_id' => $random_user->id,
                        'comment' => "Resposta de prova nº$k"
                    ]);
                    $comment->update([
                        'created_at' => now()
                    ]);

                    $random_replies2 = rand(0, 2);

                    for ($l = 0; $l < $random_replies2; $l++) {
                        $random_user = User::inRandomOrder()->first();
                        $comment = $comment->replies()->inRandomOrder()->first();
                        $comment->replies()->create([
                            'user_id' => $random_user->id,
                            'comment' => "Resposta de prova nº$l"
                        ]);
                        $comment->update([
                            'created_at' => now()
                        ]);
                    }
                }
            }

            $barbecue->update([
                'created_at' => now()->subDays(rand(0, 30))
            ]);
        }
    }
}