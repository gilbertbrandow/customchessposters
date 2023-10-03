<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\State;
use Http;
use Illuminate\Console\Command;
use Schema;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches all available countries with states from Printful and loads them into database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Fetch current list of supported countries and states
        $response = Http::get('https://api.printful.com/countries')->json();
 
        //Deletes all countries and states in database
        Schema::disableForeignKeyConstraints();
        State::truncate(); 
        Country::truncate(); 
        Schema::enableForeignKeyConstraints();

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

        return Command::SUCCESS;
    }
}
