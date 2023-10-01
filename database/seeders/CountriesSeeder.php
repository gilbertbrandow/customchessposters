<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
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
        $response = Http::get('https://api.printful.com/countries')->json();

        foreach($response['result'] as $country) {

            $record = Country::create([
                'name' => $country['name'], 
                'code' => $country['code'], 
                'region' => $country['region'],
            ]); 

            if(!$country['states']) continue; 
            
            foreach($country['states'] as $state) {
                State::create([
                    'name' => $state['name'], 
                    'code' => $state['code'], 
                    'country_id' => $record->id,
                ]); 
            }
        }

        return; 
    }
}
