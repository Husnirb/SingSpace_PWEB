<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Husni',
                'email' => 'husni@gmail.com',
                'foto_profil' => 'profile_photos/g8jOxVaJ4q9KIsQzWHuhLG6vP2sqsqjyfyfNsJA2.jpg',
                'email_verified_at' => NULL,
                'password' => '$2y$12$C77i/YzO.KgWtJgqGWADoeCy14yVc5DNeLPBUE9fI/DPXLRJaGqA6',
                'role' => 'admin',
                'remember_token' => NULL,
                'created_at' => '2026-05-19 13:49:50',
                'updated_at' => '2026-06-09 19:29:27',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Husni Rasyid Bachrie',
                'email' => 'husnirasyid10@gmail.com',
                'foto_profil' => 'profile_photos/YAIW1uuof8DfAfU2hQWvInHewvFxXoQa6thxoKMd.jpg',
                'email_verified_at' => NULL,
                'password' => '$2y$12$1vTo4QHGYzwO9/90RoCwoenkOUXCOgWBvb/trB95s/pXIJNLN2UAW',
                'role' => 'user',
                'remember_token' => 'cUPaMpaNprrtLHL7phutTM5iy3YYNbhsqotgVIGYwGmLO3R822ngBqW8jDuc',
                'created_at' => '2026-05-19 13:53:22',
                'updated_at' => '2026-06-10 05:50:24',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Fabyan',
                'email' => 'yastikafabyan2005@gmail.com',
                'foto_profil' => 'profile_photos/5x9HSw6LK9UyImfZEi1odmA8mgNc9H1UvzaD9xQ4.jpg',
                'email_verified_at' => NULL,
                'password' => '$2y$12$t8XBfAexTXVB0iMQn0ixmOskPAeq.dQSmW5kyxQVUgRHn5Woe83UK',
                'role' => 'user',
                'remember_token' => NULL,
                'created_at' => '2026-06-10 04:18:30',
                'updated_at' => '2026-06-10 04:22:08',
            ),
        ));
        
        
    }
}