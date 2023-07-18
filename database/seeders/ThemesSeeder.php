<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
                [
                    'id' => 1, 
                    'path' => 'New Waves',
                    'font_regular' => '/fonts/Custom-Serif-By-Ayaka-Ito-Regular.ttf',
                    'font_italic' => '/fonts/Custom-Serif-By-Ayaka-Ito-Italic.ttf',
                    'background' => 'rgb(251, 246, 238)', 
                    'color' => 'rgb(65, 37, 29)',
                ],

                [
                    'id' => 2, 
                    'path' => 'Old Knowledge',
                    'font_regular' => '/fonts/Custom-Serif-By-Ayaka-Ito-Regular.ttf',
                    'font_italic' => '/fonts/Custom-Serif-By-Ayaka-Ito-Italic.ttf',
                    'background' => '#f8f5f1', 
                    'color' => 'rgb(0, 0, 0)',
                ],
        ];


        foreach ($themes as $theme) {

            Theme::updateOrCreate(
                ['id' =>  $theme['id']],
                $theme, 
            );
        }
    }
}
