<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Artisan;
use Http;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('import:countries');
        return; 
    }
}
