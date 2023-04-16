<?php

namespace Database\Seeders;

use App\Models\Poster;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'simon@0100.se',
            'password' => env('ADMIN_PASS'), 
            'admin' => true,
        ]);

        $posters = Poster::All()->pluck('id')->toArray();

        $user->savedPosters()->sync($posters);
    }
}
