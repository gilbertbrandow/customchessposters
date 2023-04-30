<?php

namespace Database\Seeders;

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
        $this->call(FaqsSeeder::class);
        $this->call(PostersSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OpeningsSeeder::class);
        $this->call(PlayersSeeder::class);
        $this->call(GamesSeeder::class);
    }
}
