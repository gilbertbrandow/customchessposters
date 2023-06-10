<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $players = [
            [
                'name' => 'Fischer, Robert James',
                'country' => 'USA',
            ],
            [
                'name' => 'Spassky, Boris V',
                'country' => 'USSR',
            ],
            [
                'name' => 'Polgar, Judit',
                'country' => 'Hungary',
            ],
            [
                'name' => 'Mamedyarov, Shakhriyar',
                'country' => 'Azerbaijan',
            ],

            [
                'name' => 'Liren, Ding',
                'country' => 'China',
            ],

            [
                'name' => 'Nepomniachtchi, Ian',
                'country' => 'Russia',
            ],

            [
                'name' => 'Botvinnik, Mikhail',
                'country' => 'USSR',
            ],

            [
                'name' => 'Tal, Mikhail',
                'country' => 'USSR',
            ],

            [
                'name' => 'Byrne, Donald',
                'country' => 'USA',
            ],

            [
                'name' => 'Cramling, Pia',
                'country' => 'Sweden',
            ],

            [
                'name' => 'Galliamova, Alia',
                'country' => 'Russia',
            ],


            [
                'name' => 'Sznapik, Aleksander',
                'country' => 'Poland',
            ],

            [
                'name' => 'Gaprindashvili, Nona',
                'country' => 'Georgia',
            ],

            [
                'name' => 'Short, Nigel',
                'country' => 'England',
            ],


            [
                'name' => 'Timman, Jan',
                'country' => 'Netherlands',
            ],

            [
                'name' => 'Gelfand, Boris',
                'country' => 'Israel',
            ],

            [
                'name' => 'Nakamura, Hikaru',
                'country' => 'USA',
            ],

            [
                'name' => 'Capablanca, Jose R',
                'country' => 'Cuba',
            ],

            [
                'name' => 'Marshall, Frank J',
                'country' => 'USA',
            ],


            [
                'name' => 'Aronian, Levon',
                'country' => 'Armenia',
            ],

            [
                'name' => 'Carlsen, Magnus',
                'country' => 'Norway',
            ],


            [
                'name' => 'Koneru, Humpy',
                'country' => 'India',
            ],

            [
                'name' => 'Miroshnichenko, Evgenij',
                'country' => 'Ukraine',
            ],


            [
                'name' => 'Kasparov, Garry',
                'country' => 'Russia',
            ],

            [
                'name' => 'Topalov, Veselin',
                'country' => 'Bulgaria',
            ],

            [
                'name' => 'Ivanchuk, Vasyl',
                'country' => 'Ukraine',
            ],

            [
                'name' => 'Viswanathan, Anand',
                'country' => 'India',
            ],

            [
                'name' => 'Glucksberg',
                'country' => 'Poland',
            ],

            [
                'name' => 'Najdorf, Miguel',
                'country' => 'Poland',
            ],

            [
                'name' => 'Anderssen, Adolf',
                'country' => 'Germany',
            ],

            [
                'name' => 'Dufresne, Jean',
                'country' => 'France',
            ],

            [
                'name' => 'Yifan, Hou',
                'country' => 'China',
            ],

            [
                'name' => 'Navara, David',
                'country' => 'Czech Republic',
            ],

            [
                'name' => 'Dubov, Daniil',
                'country' => 'Russia',
            ],

            [
                'name' => 'Svane, Rasmus',
                'country' => 'Denmark',
            ],

            [
                'name' => 'Karjakin, Sergey',
                'country' => 'Russia',
            ],

            [
                'name' => 'Morphy, Paul',
                'country' => 'USA',
            ],

            [
                'name' => 'Duke Karl / Count Isouard',
                'country' => 'France',
            ],


            [
                'name' => 'Larsen, Jørgen Bent',
                'country' => 'Denmark',
            ],

            [
                'name' => 'Panno, Oscar',
                'country' => 'Argentina',
            ],

            [
                'name' => 'Eliskases, Erich',
                'country' => 'Austria',
            ],

            [
                'name' => 'Fawzy, Adham',
                'country' => 'Egypt',
            ],

            [
                'name' => 'Makolli, Perparim',
                'country' => 'Kosovo',
            ],

            [
                'name' => 'Georgiev, Kiril',
                'country' => 'North Macedonia',
            ],

            [
                'name' => 'Nisipeanu, Liviu-Dieter',
                'country' => 'Romania',
            ],

            [
                'name' => 'Supi, Luis Paulo',
                'country' => 'Brazil',
            ],

            [
                'name' => 'Euwe, Max',
                'country' => 'Netherlands',
            ],

            [
                'name' => 'Alekhine, Alexander',
                'country' => 'France',
            ],

            [
                'name' => 'Deep Blue',
                'country' => 'USA',
                'computer' => true, 
            ],

        ]; 

        foreach($players as $player) {
            Player::create($player); 
        }
    }
}
